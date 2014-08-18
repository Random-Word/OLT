<?php
App::uses( 'AppController', 'Controller' );
/**
 * Labs Controller
 *
 * @property Lab                $Lab
 * @property PaginatorComponent $Paginator
 */
class LabsController extends AppController {
	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array( 'Paginator' );
	private $empty_nav = array( "nav_current" => 0, "nav_request" => null, "nav_target" => null );

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
		if ( !$this->Lab->exists( $id ) ) {
			throw new NotFoundException( __( 'Invalid lab' ) );
		}
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
		if ( !$this->Lab->exists( $id ) ) {
			throw new NotFoundException( __( 'Invalid lab' ) );
		}
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
		$this->Lab->id = $id;
		if ( !$this->Lab->exists() ) {
			throw new NotFoundException( __( 'Invalid lab' ) );
		}
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
		                                                                                  "`rset`.`user_id`"   => $this->Auth->user('id'),
		                                                                                  "`rset`.`completed`" => false ),
		                                                           "order by"   => array( "modified" => "desc" ),
		                                                           "recursive"  => -1 )
		);
		if ( !empty( $partial_completed ) ) {
			if ( count( $partial_completed ) > 3
			) { // NOTE: that "3" is just set for convenience, should be 2 post-development
				$this->Session->setFlash( "Whooah there—seems like we have too many copies of this lab already in progress. Let's settle on just one..." );
				$this->redirect( AppController::cakUrl( "rsets", "prune", array( $id, $user_id ) ) );
			}
			else {
				$rset_id = $partial_completed[ 0 ][ 'Rset' ][ 'id' ];
			}
		}
		else {
			$rset_id = $this->requestAction( ___cakeUrl( "rsets", "create", array($this->Auth->user('id'), $id )));
			if (!is_int($rset_id) ) {
				//todo: find out why this error gets thrown when it shouldn;t....
				//$this->Session->setFlash("Error: Couldn't launch that lab. The reason is unknown; please contact an administrator.");
			}
		}
		$this->Session->write( "lab", array( "id" => $id, "launched" => true ) );

		$this->redirect( ___cakeUrl( "labs", "run", $rset_id ) );
	}


	/**
	 * run method
	 *
	 * @param $rset_id
	 */
	public function run($rset_id = null) {
		/* todo: authenticate; make sure rset.user_id = Auth.user.id */
		if (!$this->Lab->Rset->exists( $rset_id ) ) {
			$this->Session->setFlash("There was a problem recovering your answers from your previous attempt. Please contact an administrator.");
			$this->redirect(___cakeUrl("users","home"));
		}
		$rset                     = $this->Lab->Rset->findAllById( $rset_id, array( '`rset`.`id`', '`rset`.`lab_id`',
		                                                                            '`rset`.`user_id`',
		                                                                            '`rset`.`data`' ), null, 1, null, -1
		);

		// prepare slide vars
		$rset                     = $rset[ 0 ][ 'Rset' ];
		if (!$rset['user_id'] == $this->Session->read("Auth.User.id") ) {
			$this->Session->setFlash("There was a problem recovering your answers from your previous attempt. Please contact an administrator.");
			$this->redirect(___cakeUrl("users","home"));
		}
		$this->Lab->id            = $rset[ 'lab_id' ];
		$rset[ 'data' ]           = json_decode( $rset[ 'data' ], true );
		if (!array_key_exists('params', $rset['data'])) $rset['data']['params'] = array();
		if (!array_key_exists('response', $rset['data'])) $rset['data']['response'] = array();
		$this->Lab->LabScheme->id = $this->Lab->field( 'lab_scheme_id' );
		$scheme                   = $this->Lab->LabScheme->read();
		$scheme                   = json_decode( $scheme[ 'LabScheme' ][ 'scheme' ], true );
		$data                     = $this->request->is( "post" ) ? $this->request->data[ 'Lab' ] : $this->empty_nav;
		$slide_data               = $this->fetch_slide_data( $scheme, $rset, $data[ 'nav_current' ], $data[ 'nav_request' ], $data[ 'nav_target' ] );
		$sections                 = $slide_data['sections'];
		$lab_title                = $scheme[ 'title' ];
		$nav                      = $slide_data[ 'nav' ];
		$params_scheme            = $scheme[ 'params' ];
		$assets                   = $slide_data[ 'assets' ];
		$slide                    = $slide_data[ 'slide' ];
		$infobar                  = $slide['infobar'];
		$rFields = $slide['fields']['response'];
		$config                   = $scheme['config'];
		$this->set( compact("lab_title", "nav", "infobar","sections","slide", "rset", "assets", "params_scheme","rFields", "config" ) );

		// render slide
		$view_uri = "/Slides" . DS . "lab_" . str_pad( $this->Lab->id, 3, 0, STR_PAD_LEFT ) . DS . $slide_data[ 'source' ];
		$this->render( $view_uri, "lab" );
	}


	/**
	 * fetch_slide method
	 *
	 * @param $scheme
	 * @param $rset
	 * @param $current
	 * @param $request
	 * @param $target: <this is to be implemented later and is for non-sequential nav (ie. jumping)>
	 *
	 * @return array
	 */
	private function fetch_slide_data($scheme, $rset, $current, $request, $target) {
		//todo: in the strange case of only one slide, a  "next" button is still produced
		// apply nav instructions, if any, or set current_slide to the first slide
		if ( $request == "next" || $request == "previous" ) {
			$request == "next" ? $current++ : $current--;
		}
		$sections = array("slide-title" => true);
		// fetch the slide this request is being directed **TO***
		$slide          = $current < count ($scheme['slides']) && count($scheme['slides'] > 1) ? $scheme[ 'slides' ][ $scheme[ 'toc' ][ $current ] ] : false;
		$nav            = array( "next"          => ($current + 1 < count( $scheme[ 'slides' ] )),
		                         "previous"      => $current !== 0,
		                         "jump"          => true,
		                         "branch"        => false,
		                         "toc"           => $scheme[ 'toc' ],
		                         "slide_count"   => count( $scheme[ 'slides' ] ),
		                         "current_slide" => $current );
		if ($slide) {
			// put nav together
			$nav = array_key_exists( "nav", $slide ) ? array_merge( $nav, $slide[ 'nav' ] ) : $nav;
			$nav['last_slide'] =  false;

			//put slide sections together
			$sections["slide-instructions"] = !empty($slide['text']['instructions']);
			foreach ($slide['fields'] as $f) {
				foreach ($f as $i => $rf) {
					if ($rf['section']) $sections[$rf['name']] = true;
				}
			}
			foreach($slide['content_sections'] as $section) {
				$sections[$section] = true;
			}
		} else {
			$nav['last_slide'] = true;
		}

		$source         = $slide[ 'source' ] == "toc" ? $scheme[ 'toc' ][ $current ] : $slide[ 'source' ];
		$asset_manifest = $this->asset_manifest( $slide );

		$assets         = $this->prepare_assets( $slide['name'], $asset_manifest, $scheme, $rset );

		 // TODO: You've added "required_to_advance" and "required_to_load" keys to slide.params

		return compact( "nav", "slide", "source", "assets", "sections" );
	}

	/**
	 * @param $slide
	 *
	 * @return array|bool
	 */
	private function asset_manifest($slide) {
		$assets = array();
		foreach ( $slide[ 'assets' ] as $media_type => $manifest ) {
			if ( count( $manifest ) > 0 ) {
				$assets[ $media_type ] = $manifest;
			}
		}
		return count( $assets ) === 0 ? false : $assets;
	}


	/**
	 * prepare_assets method
	 * @param $slideName
	 * @param $assetManifest
	 * @param $scheme
	 * @param $rset
	 *
	 * @throws NotFoundException
	 * @desc  Uses $scheme to identify global parameters that require assets; uses $rset to select from among parameterized
	 *        assets (ie. 'aliases'); uses $asset_list to get actual file names.
	 * @return array
	 */
	private function prepare_assets($slideName, $assetManifest, $scheme, $rset) {
		$assetManifest = is_array( $assetManifest ) ? $assetManifest : array();
		$assets     = array();
		foreach ( $assetManifest as $mediaType => $manifest ) {
			// for every expected asset by alias, go find the real asset
			foreach ( $manifest as $alias ) {
				foreach ( $scheme[ 'assets' ][ $mediaType ] as $asset ) {
					// only include assets whose alias key matches the one listed in the manifest
					if ( $asset[ 'alias' ] === $alias ) {
						// if asset is bound to a param & set, and the param option to which it's bound = current param val, add asset formats
						if ( array_key_exists( "bind_to_param", $asset ) && !empty($asset['bind_to_param']) ) {
							$bound_to    = $asset[ 'bind_to_param' ][ 'param' ];
							$bound_as    = $asset[ 'bind_to_param' ][ 'option' ];
							$param_value = $rset[ 'data' ][ 'params' ][ $bound_to ]; // I think I have to check for scope, not sure
							if ( $param_value === $bound_as ) {
								try {
									$assets[ $alias ] = $this->__locateAsset($asset, $mediaType);
								} catch (NotFoundException $e ) {
									//todo: uhh... something about this apparently lost file
								}
							}
						}
						// whereas, if it is not bound, the alias is just a wrapper for the file name; add all available formats
						else {
							try {
								$assets[ $alias ] = $this->__locateAsset($asset, $mediaType);
							} catch (NotFoundException $e ) {
								//todo: uhh... something about this apparently lost file
							}
						}
					}
				}
			}
		}
		return $assets;
	}


	private function __locateAsset($asset, $mediaType) {

		foreach ( $asset[ 'file_formats' ] as $format ) {
			$relative_path = "files" . DS . $mediaType . DS . $asset[ 'file_base_name' ] .
			                 "." . strtolower( $format );
			$abs_path      = WWW_ROOT . $relative_path;
			$public_path   = DS . "olt" . DS . $relative_path;
			if ( file_exists( $abs_path ) ) {
				return array("path" => $public_path, "properties" => $asset['properties']);
			}
			else {
				throw new NotFoundException( "no can has found", 412 );
			}
		}
	}

	/**
	 * @param $lab_id
	 */
	public function schemer($lab_id) {
		$this->exists( $lab_id );
		$scheme_ob = $this->Lab->LabScheme->field( 'scheme' );
		$scheme    = json_decode( $scheme_ob, true );
		$this->set( compact( 'scheme', 'scheme_ob' ) );
		$this->render( 'schemer', 'schemer' );
	}

	public function demo() {
		$this->render( 'demo', 'templatefu' );
	}

	private function branch() {
		//mmm... functions; this is intended to be used for navigating with a jump() command
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
}
