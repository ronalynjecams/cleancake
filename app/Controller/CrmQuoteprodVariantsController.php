<?php
App::uses('AppController', 'Controller');
/**
 * CrmQuoteprodVariants Controller
 *
 * @property CrmQuoteprodVariant $CrmQuoteprodVariant
 * @property PaginatorComponent $Paginator
 */
class CrmQuoteprodVariantsController extends AppController {

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
		$this->CrmQuoteprodVariant->recursive = 0;
		$this->set('crmQuoteprodVariants', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CrmQuoteprodVariant->exists($id)) {
			throw new NotFoundException(__('Invalid crm quoteprod variant'));
		}
		$options = array('conditions' => array('CrmQuoteprodVariant.' . $this->CrmQuoteprodVariant->primaryKey => $id));
		$this->set('crmQuoteprodVariant', $this->CrmQuoteprodVariant->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CrmQuoteprodVariant->create();
			if ($this->CrmQuoteprodVariant->save($this->request->data)) {
				$this->Session->setFlash(__('The crm quoteprod variant has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm quoteprod variant could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productVariants = $this->CrmQuoteprodVariant->ProductVariant->find('list');
		$crmQuotationProducts = $this->CrmQuoteprodVariant->CrmQuotationProduct->find('list');
		$this->set(compact('productVariants', 'crmQuotationProducts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CrmQuoteprodVariant->exists($id)) {
			throw new NotFoundException(__('Invalid crm quoteprod variant'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CrmQuoteprodVariant->save($this->request->data)) {
				$this->Session->setFlash(__('The crm quoteprod variant has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm quoteprod variant could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('CrmQuoteprodVariant.' . $this->CrmQuoteprodVariant->primaryKey => $id));
			$this->request->data = $this->CrmQuoteprodVariant->find('first', $options);
		}
		$productVariants = $this->CrmQuoteprodVariant->ProductVariant->find('list');
		$crmQuotationProducts = $this->CrmQuoteprodVariant->CrmQuotationProduct->find('list');
		$this->set(compact('productVariants', 'crmQuotationProducts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CrmQuoteprodVariant->id = $id;
		if (!$this->CrmQuoteprodVariant->exists()) {
			throw new NotFoundException(__('Invalid crm quoteprod variant'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CrmQuoteprodVariant->delete()) {
			$this->Session->setFlash(__('The crm quoteprod variant has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The crm quoteprod variant could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
