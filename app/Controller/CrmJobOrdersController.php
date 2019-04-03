<?php
App::uses('AppController', 'Controller');
/**
 * CrmJobOrders Controller
 *
 * @property CrmJobOrder $CrmJobOrder
 * @property PaginatorComponent $Paginator
 */
class CrmJobOrdersController extends AppController {

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
		$this->CrmJobOrder->recursive = 0;
		$this->set('crmJobOrders', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CrmJobOrder->exists($id)) {
			throw new NotFoundException(__('Invalid crm job order'));
		}
		$options = array('conditions' => array('CrmJobOrder.' . $this->CrmJobOrder->primaryKey => $id));
		$this->set('crmJobOrder', $this->CrmJobOrder->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CrmJobOrder->create();
			if ($this->CrmJobOrder->save($this->request->data)) {
				$this->Session->setFlash(__('The crm job order has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm job order could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$admins = $this->CrmJobOrder->Admin->find('list');
		$crmQuotations = $this->CrmJobOrder->CrmQuotation->find('list');
		$this->set(compact('admins', 'crmQuotations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CrmJobOrder->exists($id)) {
			throw new NotFoundException(__('Invalid crm job order'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CrmJobOrder->save($this->request->data)) {
				$this->Session->setFlash(__('The crm job order has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm job order could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('CrmJobOrder.' . $this->CrmJobOrder->primaryKey => $id));
			$this->request->data = $this->CrmJobOrder->find('first', $options);
		}
		$admins = $this->CrmJobOrder->Admin->find('list');
		$crmQuotations = $this->CrmJobOrder->CrmQuotation->find('list');
		$this->set(compact('admins', 'crmQuotations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CrmJobOrder->id = $id;
		if (!$this->CrmJobOrder->exists()) {
			throw new NotFoundException(__('Invalid crm job order'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CrmJobOrder->delete()) {
			$this->Session->setFlash(__('The crm job order has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The crm job order could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function joSent($quote_id){
		$this->autoRender = false;
        
        $DS_JO = $this->CrmJobOrder->getDataSource();
        $this->CrmJobOrder->recursive = -1;
        $jo = $this->CrmJobOrder->findByCrmQuotationId($quote_id);
        
        $this->CrmJobOrder->id = $jo['CrmJobOrder']['id'];
        
        $this->CrmJobOrder->set(['sent_date' => date('Y-m-d')]);
        if($this->CrmJobOrder->save()) {
            $DS_JO->commit();
        }
        else {
            $DS_JO->rollback();
        }
        
        return json_encode($quote_id);
        exit;
	}
}
