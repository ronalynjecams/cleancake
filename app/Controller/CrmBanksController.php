<?php
App::uses('AppController', 'Controller');
/**
 * CrmBanks Controller
 *
 * @property CrmBank $CrmBank
 * @property PaginatorComponent $Paginator
 */
class CrmBanksController extends AppController {

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
		$this->CrmBank->recursive = 0;
		$this->set('crmBanks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CrmBank->exists($id)) {
			throw new NotFoundException(__('Invalid crm bank'));
		}
		$options = array('conditions' => array('CrmBank.' . $this->CrmBank->primaryKey => $id));
		$this->set('crmBank', $this->CrmBank->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CrmBank->create();
			if ($this->CrmBank->save($this->request->data)) {
				$this->Session->setFlash(__('The crm bank has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm bank could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CrmBank->exists($id)) {
			throw new NotFoundException(__('Invalid crm bank'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CrmBank->save($this->request->data)) {
				$this->Session->setFlash(__('The crm bank has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm bank could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('CrmBank.' . $this->CrmBank->primaryKey => $id));
			$this->request->data = $this->CrmBank->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CrmBank->id = $id;
		if (!$this->CrmBank->exists()) {
			throw new NotFoundException(__('Invalid crm bank'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CrmBank->delete()) {
			$this->Session->setFlash(__('The crm bank has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The crm bank could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
