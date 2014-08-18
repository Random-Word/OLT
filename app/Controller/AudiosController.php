<?php
App::uses( 'AppController', 'Controller' );
/**
 * Audios Controller
 *
 * @property Audio              $Audio
 * @property PaginatorComponent $Paginator
 */
class AudiosController extends AppController {

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
		$this->Audio->recursive = 0;
		$this->set( 'audios', $this->Paginator->paginate() );
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
		if ( !$this->Audio->exists( $id ) ) {
			throw new NotFoundException( __( 'Invalid audio' ) );
		}
		$options = array( 'conditions' => array( 'Audio.' . $this->Audio->primaryKey => $id ) );
		$this->set( 'audio', $this->Audio->find( 'first', $options ) );
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ( $this->request->is( 'post' ) ) {
			$this->Audio->create();
			if ( $this->Audio->save( $this->request->data ) ) {
				$this->Session->setFlash( __( 'The audio has been saved.' ) );

				return $this->redirect( array( 'action' => 'index' ) );
			}
			else {
				$this->Session->setFlash( __( 'The audio could not be saved. Please, try again.' ) );
			}
		}
		$assets = $this->Audio->Asset->find( 'list' );
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
		if ( !$this->Audio->exists( $id ) ) {
			throw new NotFoundException( __( 'Invalid audio' ) );
		}
		if ( $this->request->is( array( 'post', 'put' ) ) ) {
			if ( $this->Audio->save( $this->request->data ) ) {
				$this->Session->setFlash( __( 'The audio has been saved.' ) );

				return $this->redirect( array( 'action' => 'index' ) );
			}
			else {
				$this->Session->setFlash( __( 'The audio could not be saved. Please, try again.' ) );
			}
		}
		else {
			$options             = array( 'conditions' => array( 'Audio.' . $this->Audio->primaryKey => $id ) );
			$this->request->data = $this->Audio->find( 'first', $options );
		}
		$assets = $this->Audio->Asset->find( 'list' );
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
		$this->Audio->id = $id;
		if ( !$this->Audio->exists() ) {
			throw new NotFoundException( __( 'Invalid audio' ) );
		}
		$this->request->onlyAllow( 'post', 'delete' );
		if ( $this->Audio->delete() ) {
			$this->Session->setFlash( __( 'The audio has been deleted.' ) );
		}
		else {
			$this->Session->setFlash( __( 'The audio could not be deleted. Please, try again.' ) );
		}

		return $this->redirect( array( 'action' => 'index' ) );
	}
}
