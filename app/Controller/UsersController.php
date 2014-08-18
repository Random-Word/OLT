<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}


	public function signup() {
		if ($this->request->is('post')) {
			$studentsGroup = $this->User->Group->field('id', array('name' => 'students'));
			 $this->request->data['User']['group_id'] = $studentsGroup;
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__("Congratulations, you're all set."));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__("Hrmm, something went wrong there.  You'll need to ask an administrator about this."));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	public function home() {
		// jon—this hur be set up entirely for the ethogram lab, fix it one day
		$labs = $this->User->Rset->Lab->find('list');

		$rsets = $this->User->Rset->find('all', array("conditions" => array("`rset`.`user_id`" => $this->Auth->user('id'))));

		foreach($rsets as $rset) {
			if (isset($labs[$rset['Rset']['lab_id']])) {
				unset($labs[$rset['Rset']['lab_id']]);
			}
		}
		$this->set(compact('labs', 'rsets'));
	}






/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function login() {
	    if ($this->Session->read('Auth.User')) {
	        $this->Session->setFlash('Great news!You are already logged in!');
	        return $this->redirect(___cakeUrl("users","home"));
	    }

	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
		        return $this->redirect(___cakeUrl("users","home"));
	        }
	        $this->Session->setFlash(__('Your username or password was incorrect.'));
	    }

	}


	public function logout() {
		$this->Session->setFlash("You've been safely logged out. See you next time.");
		$this->redirect($this->Auth->logout());
	}

	public function beforeFilter() {
	    parent::beforeFilter();
		$this->Auth->allow(array("signup","initDB"));
	}

	public function initDB() {
	    $group = $this->User->Group;

	    // Allow admins to everything
	    $group->id = 4;
	    $this->Acl->allow($group, 'controllers');

	    // allow managers to posts and widgets
	    $group->id = 5;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers/Labs');
	    $this->Acl->allow($group, 'controllers/Rsets');

	    // allow users to only add and edit on posts and widgets
	    $group->id = 6;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers/Users/home');
	    $this->Acl->allow($group, 'controllers/Users/logout');
		$this->Acl->allow($group, 'controllers/Labs/run');
		$this->Acl->allow($group, 'controllers/Labs/launch');

	    // allow basic users to log out
	    $this->Acl->allow($group, 'controllers/Rsets/create');
	    $this->Acl->allow($group, 'controllers/Rsets/read');
	    $this->Acl->allow($group, 'controllers/Rsets/save');
	    $this->Acl->allow($group, 'controllers/Rsets/live_update');


	    // we add an exit to avoid an ugly "missing views" error message
	    echo "all done";
	    exit;
	}
}
