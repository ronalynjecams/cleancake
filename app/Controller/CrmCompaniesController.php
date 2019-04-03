<?php
App::uses('AppController', 'Controller');
/**
 * CrmCompanies Controller
 *
 * @property CrmCompany $CrmCompany
 * @property PaginatorComponent $Paginator
 */
class CrmCompaniesController extends AppController {

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
		$this->CrmCompany->recursive = 0;
		$this->set('crmCompanies', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CrmCompany->exists($id)) {
			throw new NotFoundException(__('Invalid crm company'));
		}
		$options = array('conditions' => array('CrmCompany.' . $this->CrmCompany->primaryKey => $id));
		$this->set('crmCompany', $this->CrmCompany->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CrmCompany->create();
			if ($this->CrmCompany->save($this->request->data)) {
				$this->Session->setFlash(__('The crm company has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm company could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$admins = $this->CrmCompany->Admin->find('list');
		$this->set(compact('admins'));
	}
	
	public function addCompany(){
    	$this->autoRender = false;
        $this->response->type('json');
        $dd = $this->request->data; 

        if ($this->request->is(array('post', 'put'))) {

            $this->CrmCompany->create();
            if ($this->CrmCompany->save($this->request->data)) {
                return (json_encode($this->request->data));
            }
            return "error";
        }
        exit;
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CrmCompany->exists($id)) {
			throw new NotFoundException(__('Invalid crm company'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CrmCompany->save($this->request->data)) {
				$this->Session->setFlash(__('The crm company has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm company could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('CrmCompany.' . $this->CrmCompany->primaryKey => $id));
			$this->request->data = $this->CrmCompany->find('first', $options);
		}
		$admins = $this->CrmCompany->Admin->find('list');
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
		$this->CrmCompany->id = $id;
		if (!$this->CrmCompany->exists()) {
			throw new NotFoundException(__('Invalid crm company'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CrmCompany->delete()) {
			$this->Session->setFlash(__('The crm company has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The crm company could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function all_list() {
        $type = $this->params['url']['type'];

        if ($this->Auth->user('job_title') == 'admin') {
            $companies = $this->CrmCompany->findAllByType($this->params['url']['type']);
        } else {
            $companies = $this->CrmCompany->find('all', [
                'conditions' => [
                    'CrmCompany.type' => $type,
                    'CrmCompany.admin_id' => $this->Auth->user('id')
                ]
            ]);
        }
 
        $this->set(compact('companies'));
    }
    
    public function get_company_info() {

        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $id = $this->request->query['id'];
            $this->CrmCompany->recursive = -1;
            $lead = $this->CrmCompany->findById($id);
            return (json_encode($lead['CrmCompany']));
            exit;
        }
    }
    
    public function update_company_process(){ 
        $this->autoRender = false;
        $this->response->type('json');
        $dd = $this->request->data;
        $id = $dd['id'];

        if ($this->request->is(array('post', 'put'))) {
        	$this->CrmCompany->id = $id;
            if ($this->CrmCompany->save($this->request->data)) {
                return (json_encode($this->request->data));
            } else {
                return (json_encode($this->request->data));
            }
        } else {
            return (json_encode($this->request->data));
        }
        exit;
    }
}
