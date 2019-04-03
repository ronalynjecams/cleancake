<?php
App::uses('AppController', 'Controller');
/**
 * ProductVariants Controller
 *
 * @property ProductVariant $ProductVariant
 * @property PaginatorComponent $Paginator
 */
class ProductVariantsController extends AppController {

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
		$this->ProductVariant->recursive = 0;
		$this->set('productVariants', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductVariant->exists($id)) {
			throw new NotFoundException(__('Invalid product variant'));
		}
		$options = array('conditions' => array('ProductVariant.' . $this->ProductVariant->primaryKey => $id));
		$this->set('productVariant', $this->ProductVariant->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductVariant->create();
			if ($this->ProductVariant->save($this->request->data)) {
				$this->Session->setFlash(__('The product variant has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product variant could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$products = $this->ProductVariant->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProductVariant->exists($id)) {
			throw new NotFoundException(__('Invalid product variant'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductVariant->save($this->request->data)) {
				$this->Session->setFlash(__('The product variant has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product variant could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ProductVariant.' . $this->ProductVariant->primaryKey => $id));
			$this->request->data = $this->ProductVariant->find('first', $options);
		}
		$products = $this->ProductVariant->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProductVariant->id = $id;
		if (!$this->ProductVariant->exists()) {
			throw new NotFoundException(__('Invalid product variant'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductVariant->delete()) {
			$this->Session->setFlash(__('The product variant has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The product variant could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
