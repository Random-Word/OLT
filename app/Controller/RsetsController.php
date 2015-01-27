<?php
App::uses( 'AppController', 'Controller' );
/**
 * Rsets Controller
 *
 * @property Rset               $Rset
 * @property PaginatorComponent $Paginator
 */
class RsetsController extends AppController {

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array( 'Paginator' );

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Rset->recursive = 0;
		$this->set( 'rsets', $this->Paginator->paginate() );
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 *
	 * @param string $id
	 *
	 * @return void
	 */
	public function view($id = null) {
		if ( !$this->Rset->exists( $id ) ) {
			throw new NotFoundException( __( 'Invalid rset' ) );
		}
		$options = array( 'conditions' => array( 'Rset.' . $this->Rset->primaryKey => $id ) );
		$this->set( 'rset', $this->Rset->find( 'first', $options ) );
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ( $this->request->is( 'post' ) ) {
			$this->Rset->create();
			if ( $this->Rset->save( $this->request->data ) ) {
				$this->Session->setFlash( __( 'The rset has been saved.' ) );

				return $this->redirect( array( 'action' => 'index' ) );
			}
			else {
				$this->Session->setFlash( __( 'The rset could not be saved. Please, try again.' ) );
			}
		}
		$users = $this->Rset->User->find( 'list' );
		$labs  = $this->Rset->Lab->find( 'list' );
		$this->set( compact( 'users', 'labs' ) );
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 *
	 * @param string $id
	 *
	 * @return void
	 */
	public function edit($id = null) {
		if ( !$this->Rset->exists( $id ) ) {
			throw new NotFoundException( __( 'Invalid rset' ) );
		}
		if ( $this->request->is( array( 'post', 'put' ) ) ) {
			if ( $this->Rset->save( $this->request->data ) ) {
				$this->Session->setFlash( __( 'The rset has been saved.' ) );

				return $this->redirect( array( 'action' => 'index' ) );
			}
			else {
				$this->Session->setFlash( __( 'The rset could not be saved. Please, try again.' ) );
			}
		}
		else {
			$options             = array( 'conditions' => array( 'Rset.' . $this->Rset->primaryKey => $id ) );
			$this->request->data = $this->Rset->find( 'first', $options );
		}
		$users = $this->Rset->User->find( 'list' );
		$labs  = $this->Rset->Lab->find( 'list' );
		$this->set( compact( 'users', 'labs' ) );
	}


	/**
	 * live_update method
	 *
	 * @desc AJAX only; this function is a streamlined sibling of edit() that only serves labs in progress
	 *
	 * @param $id
	 * @param $createKeys
	 * @param $createAfterDepth
	 *
	 * @return mixed
	 */
	public function live_update($id, $createKeys = false, $createAfterDepth = 0) {
		if ($createKeys === 1) $createKeys = true;
		$this->autorender = false;
		$originalRset     = null;
		$exists           = false;

		try {
			if ( $this->Rset->exists( $id ) ) {
				$exists = true;
				if ( $this->request->is( "ajax" ) || true ) {
					$this->Rset->id = $id;
					$rset           = json_decode( $this->Rset->field( 'data' ), true );
					$originalRset   = $rset;
					$mergeResult    = $this->merge_rset_data( $rset, $this->request->data, 0, $createKeys, $createAfterDepth );
					if ( $mergeResult[ 'message' ] ) {
						// if there's a message, it's an error; send it home
						echo json_encode( $mergeResult );
					}
					else {
						$this->Rset->set( 'data', json_encode( $mergeResult[ 'rset' ] ) );
						if ( $this->Rset->save() ) {
							echo json_encode( array( "success" => true,
							                         "rset"    => json_decode( $this->Rset->field( 'data' ), true ) )
							);
						}
						else {
							try {
								$this->Rset->set( 'data', json_encode( $originalRset ) );
								$this->Rset->save();
								echo json_encode( array( "saved" => false, "corrupted" => false,
								                         "error" => pr( $this->Rset->validationErrors, true ) )
								);
							} catch ( Exception $e ) {
								echo json_encode( array( "saved" => false, "corrupted" => true,
								                         "error" => pr( $this->Rset->validationErrors, true ) )
								);
							}
						}
					}
				}
			}
		} catch ( Exception $e ) {
			$corrupted = false;
			if ( $exists ) {
				try {
					$this->Rset->id = $id;
					$this->Rset->set( 'data', json_encode( $originalRset ) );
					$this->Rset->save();
				} catch ( Exception $e ) {
					$corrupted = $e;
				}
			}
			else {
				$corrupted = "Bad id; no such rset found!";
			}
			echo json_encode( array( 'saved' => false, "corrupted" => $corrupted, "message" => $e ) );
		}

		return $this->render( 'ajax', 'ajax' );
	}


	private function merge_rset_data($rset, $data, $depth, $createKeys = false, $createAfterDepth = 0, $in_recursion = false) {
		if ( !$depth ) $depth = 0;

		try {
			foreach ( $data as $key => $val ) {
				if ( is_array($rset) && !array_key_exists( $key, $rset ) ) {
					if ( !$createKeys || $depth < $createAfterDepth ) {
						// this should be impossible, but throw an error I guess?
						throw new Exception( "The key, '$key', was not found in the current Rset." );
					}
					$rset[ $key ] = null;
				}
				$depth++;
				$recursionResult = is_array( $val ) ? $this->merge_rset_data( $rset[ $key ], $val, $depth, $createKeys, $createAfterDepth, true ) : $val;
				if ( is_array( $recursionResult ) ) {
					$rset[ $key ] = $recursionResult[ 'rset' ] ===
					                false ? $recursionResult[ 'message' ] : $recursionResult[ 'rset' ];
				}
				else {
					$rset[ $key ] = $recursionResult;
				}
			}
		} catch ( Exception $e ) {
			if ( $in_recursion ) {

				db( array( 'rset' => "alas", 'message' => $e->getMessage() ));
			}
			else {
				return array( "rset" => $rset, "message" => $e[ 'message' ] );
			}
		}

		return array( "rset" => $rset, "message" => false );
	}

	public function save_response($id, $slide_name, $response_key, $value) {
		$data = $this->__ajax_data( $id );
		if ( array_key_exists( $slide_name, $data ) ) {
			if ( array_key_exists( $response_key, $data[ $slide_name ] ) ) {
				$data[ $slide_name ][ $response_key ] = $value;
				$this->Rset->set( 'data', json_encode( $data ) );
				if ( $this->Rset->save() ) {
					return json_encode( array( "saved" => true ) );
				}
				else {
					return json_encode( array( "saved" => false,
					                           "error" => pr( $this->Rset->validationErrors, true ) )
					);
				}
			}
			else {
				return json_encode( array( "saved" => false, "error" => "Bad response key." ) );
			}
		}
		else {
			return json_encode( array( "saved" => false, "error" => "Bad slide name." ) );
		}
	}

	// note: this function not currently in use; need to figure out how the fuck to make AJAX work how I wanted with Rset
	public function read($id) {
		$this->layout = 'ajax';
		if ( $this->Rset->exists( $id ) ) {
			if ( $this->request->is( "ajax" ) ) {
				$this->layout     = 'ajax';
				$this->Rset->id   = $id;
				$this->autoRender = false;

				return $this->Rset->field( "data" );
			}
			else {
				$this->redirect( AppController::cakeUrl( "users", "home" ) );
			}
		}
		else {
			throw new NotFoundException( "Invalid Rset" );
		}
	}


	private function __ajax_data($id) {
		if ( $this->Rset->exists( $id ) ) {
			if ( $this->request->is( "ajax" ) || 2 > 1 ) {
				$this->Rset->id = $id;

				$data = $this->Rset->field( "data" );

				return json_decode( $data, true );
			}
			else {
				return false;
			}
		}
		else {
			throw new NotFoundException( "Invalid Rset" );
		}
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 *
	 * @param string $id
	 *
	 * @return void
	 */
	public function delete($id = null) {
		$this->Rset->id = $id;
		if ( !$this->Rset->exists() ) {
			throw new NotFoundException( __( 'Invalid rset' ) );
		}
		$this->request->onlyAllow( 'post', 'delete' );
		if ( $this->Rset->delete() ) {
			$this->Session->setFlash( __( 'The rset has been deleted.' ) );
		}
		else {
			$this->Session->setFlash( __( 'The rset could not be deleted. Please, try again.' ) );
		}

		return $this->redirect( array( 'action' => 'index' ) );
	}

	public function finalize($id) {
		if ($this->Session->read("Auth.User.id") ) {
			if ($this->Rset->exists($id) ) {
				$this->Rset->id = $id;
				if ($this->Rset->saveField("completed", true, false) ) {
					if ($this->Rset->saveField("completedOn", date('Y-m-d H:i:s'), false)) {
						$this->Session->setFlash("Congratulations, your lab has been finalized and saved. All done!");
					}
					else {
						$this->Session->setFlash("Hrmm... Something went wrong finalizing your lab. Your answers have been saved, but you should contact an educator or lab administrator about this.");
					}
				} else {
					$this->Session->setFlash("Hrmm... Something went wrong finalizing your lab. Your answers have been saved, but you should contact an educator or lab administrator about this.");
				}
				$this->redirect(___cakeUrl("users", "home"));
			}
		}
	}

	public function create($userId, $labId) {
		$this->autorender = false;
		$labSchemeId      = $this->Rset->Lab->field( 'lab_scheme_id', array( 'id' => $labId ) );
		$labScheme        = json_decode( $this->Rset->Lab->LabScheme->field( 'scheme', array( 'id' => $labSchemeId ) ), true );
		$scheme           = json_encode( $labScheme[ 'rset' ] );
		$rset             = array( 'Rset' => array( 'user_id' => $userId, 'lab_id' => $labId, 'completed' => false,
		                                            'data'    => $scheme ) );
		$this->Rset->create();
		if ( $this->Rset->save( $rset ) ) {
			return $this->Rset->id;
		}
	}
}
