<?php
class Template {
	private $structure;

	public function __construct($content) {
		$this->structure = json_decode( $content, true );
	}

	public function key_exists($key, $search_arrays = false, $start_path = false, $greedy = false) {
		$remaining_path = $this->structure;
		if ( $start_path ) {
			$start_path = is_array( $start_path ) ? $start_path : explode( "/", $start_path );

			for ( $i = 0; $i < count( $start_path ) - 1; $i++ ) {
				if ( array_key_exists( $start_path[ $i ], $remaining_path ) ) {
					$remaining_path = $remaining_path[ $start_path[ $i ] ];
				}
				else {
					throw new NotFoundException( "The provided path does not exist in this template." );
				}
			}
		}

		return $this->recursive_key_search( $key, $remaining_path, $start_path, $search_arrays, $greedy );
	}

	public function pr() {
		pr( $this->structure );

		return true;
	}

	private function recursive_key_search($key, $search_array, $path, $search_arrays, $greedy) {
		$found = $greedy ? array() : false;
		foreach ( $search_array as $index => $value ) {
			if ( $found === false || is_array( $found ) ) {
				if ( is_array( $value ) ) {
					if ( !is_int( $index ) || $search_arrays ) {
						if ( array_key_exists( $key, $value ) ) {
							if ( $greedy ) {
								$found++;
							}
							else {
								return implode( DS, $path ) . DS;
							}
						}
					}
					else {
						$found = $key == $value;
					}
				}
				elseif ( $greedy ) {
					$found = implode( DS, $path );
				}
				else {
					return true;
				}
			}
		}

		return $found;
	}

	public function slide($slide_number) {
		if ( array_key_exists( $slide_number, $this->structure[ 'slides' ] ) ) {
			return $this->structure[ 'slides' ][ $slide_number ];
		}
		else {
			return false;
		}
	}
}


App::uses( 'AppController', 'Controller' );
/**
 * Labs Controller
 *
 * @property Lab                $Lab
 * @property PaginatorComponent $Paginator
 */
class LabsController extends AppController {
	public $autorender = false;

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array( 'Paginator', 'LabTemplate' );

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Lab->recursive = 0;
		$this->set( 'labs', $this->Paginator->paginate() );
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
		$this->exists( $id );
		$options = array( 'conditions' => array( 'Lab.' . $this->Lab->primaryKey => $id ) );
		$this->set( 'lab', $this->Lab->find( 'first', $options ) );
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ( $this->request->is( 'post' ) ) {
			$this->Lab->create();
			if ( $this->Lab->save( $this->request->data ) ) {
				$this->Session->setFlash( __( 'The lab has been saved.' ) );

				return $this->redirect( array( 'action' => 'index' ) );
			}
			else {
				$this->Session->setFlash( __( 'The lab could not be saved. Please, try again.' ) );
			}
		}
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
		$this->exists( $id );
		if ( $this->request->is( array( 'post', 'put' ) ) ) {
			if ( $this->Lab->save( $this->request->data ) ) {
				$this->Session->setFlash( __( 'The lab has been saved.' ) );

				return $this->redirect( array( 'action' => 'index' ) );
			}
			else {
				$this->Session->setFlash( __( 'The lab could not be saved. Please, try again.' ) );
			}
		}
		else {
			$options             = array( 'conditions' => array( 'Lab.' . $this->Lab->primaryKey => $id ) );
			$this->request->data = $this->Lab->find( 'first', $options );
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
		$this->exists( $id );
		$this->request->onlyAllow( 'post', 'delete' );
		if ( $this->Lab->delete() ) {
			$this->Session->setFlash( __( 'The lab has been deleted.' ) );
		}
		else {
			$this->Session->setFlash( __( 'The lab could not be deleted. Please, try again.' ) );
		}

		return $this->redirect( array( 'action' => 'index' ) );
	}

	/**
	 * launch method
	 *
	 * @param $id
	 *
	 * @return mixed
	 */
	public function launch($id) {
		$this->autorender = false;
		$this->exists( $id );
		$user_id           = 1;
		$partial_completed = $this->Lab->Rset->find( "all", array( 'conditions' => array( "`rset`.`lab_id`"    => $id,
		                                                                                  "`rset`.`user_id`"   => $user_id,
		                                                                                  "`rset`.`completed`" => false ),
		                                                           "order by"   => array( "modified" => "desc" ),
		                                                           "recursive"  => -1 )
		);
		if ( !empty( $partial_completed ) ) {
			if ( count( $partial_completed ) > 3 ) {
				$this->Session->setFlash( "Whooah there—seems like we have too many copies of this lab already in progress. Let's settle on just one..." );
				$this->redirect( AppController::cakUrl( "rsets", "prune", array( $id, $user_id ) ) );
			}
			else {
				$rset_id = $partial_completed[ 0 ][ 'Rset' ][ 'id' ];
			}
		}
		else {
			$rset_id = $this->requestAction( AppController::cakeUrl( "rsets", "new" ) );
		}
		$this->Session->write( "lab", array( "id" => $id, "launched" => true ) );

		$this->redirect( AppController::cakeUrl( "labs", "run", $rset_id ) );
	}


	/**
	 * run method
	 *
	 * @param $rset_id
	 */
	public function run($rset_id = null) {
		/* todo: authenticate; make sure rset.user_id = Auth.user.id */
		$this->exists( $rset_id );

		/*DEV*/
		$data          = $this->request->data;
		$results       = $this->Lab->Rset->findAllById( $rset_id );
		$rset          = $results[ 0 ];
		$this->Lab->id = $rset[ 'Rset' ][ 'lab_id' ];
		/* todo: templates should be PHP class objects, yo, so as to add custom methods */
		$template = new Template( $this->Lab->field( 'template' ) );
		echo $template->key_exists( "elephants" );
		$data      = $this->request->is( "post" ) ? $this->request->data : array();
		$slide     = $this->render_slide( $template, $data );
		$lab_title = $template[ 'lab_title' ];
		$this->set( compact( "lab_title", "slide", "rset", "data" ) );
		$this->render( "run", "lab" );
	}

	/**
	 * render slide method
	 *
	 * @param $template
	 * @param $nav_data
	 *
	 * @return mixed
	 */
	private function render_slide($template, $nav_data) {
		$_nav_data = array( "next"          => null,
		                    "previous"      => null,
		                    "jump"          => true,
		                    "branch"        => false,
		                    "toc"           => null,
		                    "slide_count"   => null,
		                    "current_slide" => null );
		$nav_data  = array_merge( $_nav_data, $nav_data );

		//  branch & allow_jump are just placeholders until the logic that will actually provide them exists
		$branch_map    = false;
		$allow_jump    = false;
		$current_slide = null;
		// apply nav instructions, if any, or set current_slide to the first slide
		switch ( $nav_data[ 'current_slide' ] ) {
			case "jump":
				$current_slide = $nav_data[ 'target' ];
				break;
			case "next":
				$current_slide = $nav_data[ 'current_slide' ] + 1;
				break;
			case "previous":
				$current_slide = $nav_data[ 'current_slide' ] - 1;
				break;
			case "branch":
				//implement this bitch someday
				break;
			default:
				$current_slide = 0;
				break;
		}

		$slide = $template[ 'slides' ][ $current_slide ];
		// todo: either in fetch_slide_content() or here, apply lab params (ie. global-to-lab params)
		$slide[ 'slide_content' ] = $this->fetch_slide_content( $template[ 'lab_title' ], $slide[ 'slide_source' ] );

		/*
		 * a note on this array: previous/next/jump/branch are booleans—they determine whether these buttons are shown
		 */
		$slide[ 'slide_nav' ] = array( "previous"      => $current_slide !== 0,
		                               "next"          => $current_slide !== count( $template[ 'slides' ] ),
		                               "jump"          => $allow_jump,
		                               "branch"        => $branch_map,
		                               "toc"           => $template[ 'toc' ],
		                               "slide_count"   => count( $template[ 'slides' ] ),
		                               "current_slide" => $current_slide );

		return $slide;
	}


	private function fetch_slide_content($lab_title, $source) {
		/* $source  follows the CakePHP convention of paths commencing with a forward slash indicate an absolute path from
		    source (in this case the lib/Labs directory) and all other paths indicating an absolute path from
		    source-by-convention (in this case, lib/Labs/<lab_title>/slides/<slide_title>.php */
		$absolute        = substr( $source, 0, 1 ) == "/";
		$source          = explode( "/", $source );
		$source_elements = $absolute ? array_slice( $source, 1 ) : $source;
		$source_path     =
			count( $source_elements ) > 1 ? DS . implode( DS, $source ) . PHP : DS . "slides" . DS . $source[ 0 ] . PHP;
		$lab_title       = AppController::as_file_name( $lab_title );

		return file_get_contents( ROOT . DS . LAB_ROOT . DS . $lab_title . $source_path );
	}

	private function exists($id, $setId = true) {
		if ( $setId ) {
			$this->Lab->id = $id;
		}
		if ( !$this->Lab->exists( $id ) ) {
			throw new NotFoundException( __( $this->Error->e( "notFound", array( 'Lab' ) ) ) );
		}

		return true;
	}

	public function templatefu($lab_id) {
		$this->exists( $lab_id );
		$template_ob = $this->Lab->field( 'template' );
		$template    = json_decode( $template_ob, true );
		$task_types  = $this->Lab->Response->Tasktype->find( 'list' );
		$this->set( compact( 'template', 'task_types', 'template_ob' ) );
		$this->render( 'templatefu', 'templatefu' );
	}

	public function demo() {
		$this->render( 'demo', 'templatefu' );
	}
}