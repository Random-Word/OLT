<?php
App::uses( 'AppController', 'Controller' );
/**
 * LabSchemes Controller
 *
 * @property LabScheme          $LabScheme
 * @property PaginatorComponent $Paginator
 */
class LabSchemesController extends AppController {

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
		$this->LabScheme->recursive = 0;
		$this->set( 'labSchemes', $this->Paginator->paginate() );
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
		if ( !$this->LabScheme->exists( $id ) ) {
			throw new NotFoundException( __( 'Invalid lab scheme' ) );
		}
		$options = array( 'conditions' => array( 'LabScheme.' . $this->LabScheme->primaryKey => $id ) );
		$this->set( 'labScheme', $this->LabScheme->find( 'first', $options ) );
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ( $this->request->is( 'post' ) ) {
			$this->LabScheme->create();
			if ( $this->LabScheme->save( $this->request->data ) ) {
				$this->Session->setFlash( __( 'The lab scheme has been saved.' ) );

				return $this->redirect( array( 'action' => 'index' ) );
			}
			else {
				$this->Session->setFlash( __( 'The lab scheme could not be saved. Please, try again.' ) );
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
		if ( !$this->LabScheme->exists( $id ) ) {
			throw new NotFoundException( __( 'Invalid lab scheme' ) );
		}
		if ( $this->request->is( array( 'post', 'put' ) ) ) {
			if ( $this->LabScheme->save( $this->request->data ) ) {
				$this->Session->setFlash( __( 'The lab scheme has been saved.' ) );

				return $this->redirect( array( 'action' => 'index' ) );
			}
			else {
				$this->Session->setFlash( __( 'The lab scheme could not be saved. Please, try again.' ) );
			}
		}
		else {
			$options             = array( 'conditions' => array( 'LabScheme.' . $this->LabScheme->primaryKey => $id ) );
			$this->request->data = $this->LabScheme->find( 'first', $options );
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
		$this->LabScheme->id = $id;
		if ( !$this->LabScheme->exists() ) {
			throw new NotFoundException( __( 'Invalid lab scheme' ) );
		}
		$this->request->onlyAllow( 'post', 'delete' );
		if ( $this->LabScheme->delete() ) {
			$this->Session->setFlash( __( 'The lab scheme has been deleted.' ) );
		}
		else {
			$this->Session->setFlash( __( 'The lab scheme could not be deleted. Please, try again.' ) );
		}

		return $this->redirect( array( 'action' => 'index' ) );
	}
}
