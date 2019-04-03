<?php
App::uses('AppController', 'Controller');
/**
 * CrmEmployeeDetails Controller
 *
 * @property CrmEmployeeDetail $CrmEmployeeDetail
 * @property PaginatorComponent $Paginator
 */
class CrmEmployeeDetailsController extends AppController {

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
		$this->CrmEmployeeDetail->recursive = 0;
		$this->set('crmEmployeeDetails', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CrmEmployeeDetail->exists($id)) {
			throw new NotFoundException(__('Invalid crm employee detail'));
		}
		$options = array('conditions' => array('CrmEmployeeDetail.' . $this->CrmEmployeeDetail->primaryKey => $id));
		$this->set('crmEmployeeDetail', $this->CrmEmployeeDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CrmEmployeeDetail->create();
			if ($this->CrmEmployeeDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The crm employee detail has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm employee detail could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$admins = $this->CrmEmployeeDetail->Admin->find('list');
		$this->set(compact('admins'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CrmEmployeeDetail->exists($id)) {
			throw new NotFoundException(__('Invalid crm employee detail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CrmEmployeeDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The crm employee detail has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm employee detail could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('CrmEmployeeDetail.' . $this->CrmEmployeeDetail->primaryKey => $id));
			$this->request->data = $this->CrmEmployeeDetail->find('first', $options);
		}
		$admins = $this->CrmEmployeeDetail->Admin->find('list');
		$this->set(compact('admins'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CrmEmployeeDetail->id = $id;
		if (!$this->CrmEmployeeDetail->exists()) {
			throw new NotFoundException(__('Invalid crm employee detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CrmEmployeeDetail->delete()) {
			$this->Session->setFlash(__('The crm employee detail has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The crm employee detail could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
