<?php
App::uses( 'AppController', 'Controller' );
/**
 * TaskTypes Controller
 *
 * @property TaskType           $TaskType
 * @property PaginatorComponent $Paginator
 */
class TaskTypesController extends AppController {

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
		$this->TaskType->recursive = 0;
		$this->set( 'taskTypes', $this->Paginator->paginate() );
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
		if ( !$this->TaskType->exists( $id ) ) {
			throw new NotFoundException( __( 'Invalid task type' ) );
		}
		$options = array( 'conditions' => array( 'TaskType.' . $this->TaskType->primaryKey => $id ) );
		$this->set( 'taskType', $this->TaskType->find( 'first', $options ) );
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ( $this->request->is( 'post' ) ) {
			$this->TaskType->create();
			if ( $this->TaskType->save( $this->request->data ) ) {
				$this->Session->setFlash( __( 'The task type has been saved.' ) );

				return $this->redirect( array( 'action' => 'index' ) );
			}
			else {
				$this->Session->setFlash( __( 'The task type could not be saved. Please, try again.' ) );
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
		if ( !$this->TaskType->exists( $id ) ) {
			throw new NotFoundException( __( 'Invalid task type' ) );
		}
		if ( $this->request->is( array( 'post', 'put' ) ) ) {
			if ( $this->TaskType->save( $this->request->data ) ) {
				$this->Session->setFlash( __( 'The task type has been saved.' ) );

				return $this->redirect( array( 'action' => 'index' ) );
			}
			else {
				$this->Session->setFlash( __( 'The task type could not be saved. Please, try again.' ) );
			}
		}
		else {
			$options             = array( 'conditions' => array( 'TaskType.' . $this->TaskType->primaryKey => $id ) );
			$this->request->data = $this->TaskType->find( 'first', $options );
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
		$this->TaskType->id = $id;
		if ( !$this->TaskType->exists() ) {
			throw new NotFoundException( __( 'Invalid task type' ) );
		}
		$this->request->onlyAllow( 'post', 'delete' );
		if ( $this->TaskType->delete() ) {
			$this->Session->setFlash( __( 'The task type has been deleted.' ) );
		}
		else {
			$this->Session->setFlash( __( 'The task type could not be deleted. Please, try again.' ) );
		}

		return $this->redirect( array( 'action' => 'index' ) );
	}
}
