<?php
App::uses( 'AppController', 'Controller' );
/**
 * Videos Controller
 *
 * @property Video              $Video
 * @property PaginatorComponent $Paginator
 */
class VideosController extends AppController {

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
		$this->Video->recursive = 0;
		$this->set( 'videos', $this->Paginator->paginate() );
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
		if ( !$this->Video->exists( $id ) ) {
			throw new NotFoundException( __( 'Invalid video' ) );
		}
		$options = array( 'conditions' => array( 'Video.' . $this->Video->primaryKey => $id ) );
		$this->set( 'video', $this->Video->find( 'first', $options ) );
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ( $this->request->is( 'post' ) ) {
			$this->Video->create();
			if ( $this->Video->save( $this->request->data ) ) {
				$this->Session->setFlash( __( 'The video has been saved.' ) );

				return $this->redirect( array( 'action' => 'index' ) );
			}
			else {
				$this->Session->setFlash( __( 'The video could not be saved. Please, try again.' ) );
			}
		}
		$assets = $this->Video->Asset->find( 'list' );
		$this->set( compact( 'assets' ) );
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
		if ( !$this->Video->exists( $id ) ) {
			throw new NotFoundException( __( 'Invalid video' ) );
		}
		if ( $this->request->is( array( 'post', 'put' ) ) ) {
			if ( $this->Video->save( $this->request->data ) ) {
				$this->Session->setFlash( __( 'The video has been saved.' ) );

				return $this->redirect( array( 'action' => 'index' ) );
			}
			else {
				$this->Session->setFlash( __( 'The video could not be saved. Please, try again.' ) );
			}
		}
		else {
			$options             = array( 'conditions' => array( 'Video.' . $this->Video->primaryKey => $id ) );
			$this->request->data = $this->Video->find( 'first', $options );
		}
		$assets = $this->Video->Asset->find( 'list' );
		$this->set( compact( 'assets' ) );
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
		$this->Video->id = $id;
		if ( !$this->Video->exists() ) {
			throw new NotFoundException( __( 'Invalid video' ) );
		}
		$this->request->onlyAllow( 'post', 'delete' );
		if ( $this->Video->delete() ) {
			$this->Session->setFlash( __( 'The video has been deleted.' ) );
		}
		else {
			$this->Session->setFlash( __( 'The video could not be deleted. Please, try again.' ) );
		}

		return $this->redirect( array( 'action' => 'index' ) );
	}
}
