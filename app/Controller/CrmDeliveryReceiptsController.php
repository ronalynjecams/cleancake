<?php
App::uses('AppController', 'Controller');
/**
 * CrmDeliveryReceipts Controller
 *
 * @property CrmDeliveryReceipt $CrmDeliveryReceipt
 * @property PaginatorComponent $Paginator
 */
class CrmDeliveryReceiptsController extends AppController {

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
		$this->CrmDeliveryReceipt->recursive = 0;
		$this->set('crmDeliveryReceipts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CrmDeliveryReceipt->exists($id)) {
			throw new NotFoundException(__('Invalid crm delivery receipt'));
		}
		$options = array('conditions' => array('CrmDeliveryReceipt.' . $this->CrmDeliveryReceipt->primaryKey => $id));
		$this->set('crmDeliveryReceipt', $this->CrmDeliveryReceipt->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$quotation = "";
		$status = "";
		if(!empty($this->params['url'])){
			$quotation = $this->params['url']['id'];
			$status = $this->params['url']['status'];
			$type = $this->params['url']['type'];
		}
		if ($this->request->is('post')) {
			$this->CrmDeliveryReceipt->create();
			if ($this->CrmDeliveryReceipt->save($this->request->data)) {
				$this->Session->setFlash(__('The crm delivery receipt has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm delivery receipt could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$crmQuotations = $this->CrmDeliveryReceipt->CrmQuotation->find('list');
		$admins = $this->CrmDeliveryReceipt->Admin->find('list');
		$this->set(compact('crmQuotations', 'admins', 'quotation','status', 'type'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CrmDeliveryReceipt->exists($id)) {
			throw new NotFoundException(__('Invalid crm delivery receipt'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CrmDeliveryReceipt->save($this->request->data)) {
				$this->Session->setFlash(__('The crm delivery receipt has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm delivery receipt could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('CrmDeliveryReceipt.' . $this->CrmDeliveryReceipt->primaryKey => $id));
			$this->request->data = $this->CrmDeliveryReceipt->find('first', $options);
		}
		$crmQuotations = $this->CrmDeliveryReceipt->CrmQuotation->find('list');
		$admins = $this->CrmDeliveryReceipt->Admin->find('list');
		$this->set(compact('crmQuotations', 'admins'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CrmDeliveryReceipt->id = $id;
		if (!$this->CrmDeliveryReceipt->exists()) {
			throw new NotFoundException(__('Invalid crm delivery receipt'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CrmDeliveryReceipt->delete()) {
			$this->Session->setFlash(__('The crm delivery receipt has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The crm delivery receipt could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function all_list() {
		$this->loadModel('CrmQuotation');
		
		$status = $this->params['url']['status'];
		$drs = $this->CrmDeliveryReceipt->find('all',
			['conditions'=>['CrmDeliveryReceipt.status'=>$status]]);
		
		$companies = [];
		foreach($drs as $dr_obj) {
			$dr = $dr_obj['CrmDeliveryReceipt'];
			$dr_quotation_id = $dr['crm_quotation_id'];
			
			$companies[$dr_quotation_id] = $this->CrmQuotation->findById($dr_quotation_id);
		}	
		
		$this->set(compact('status', 'drs', 'companies'));
	}
	
	public function create() {
		$this->autoRender = false;
		$data = $this->request->data;
		$quotation_id = $data['quotation'];
		$date = $data['date'];
		$type = $data['type'];
		$amount = $data['amount'];
		$status = $data['status'];
		$booking_code_tmp = $data['booking_code'];
		$userin = $this->Auth->user('id');
		$time = date("YmdHmi");
		$dr_number = $this->active_company.$time;
		
		$delivery_receipts_set = ['crm_quotation_id'=>$quotation_id,
								  'dr_number'=>$dr_number,
								  'delivery_date'=>$date,
								  'admin_id'=>$userin,
								  'status'=>'pending',
								  'dr_type'=>$type,
								  'amount'=>$amount,
								  'booking_code'=>$booking_code_tmp];
		
		$DS_DeliveryReceipts = $this->CrmDeliveryReceipt->getDataSource();
		$DS_DeliveryReceipts->begin();
		
		$this->CrmDeliveryReceipt->create();
		$this->CrmDeliveryReceipt->set($delivery_receipts_set);
		
		if($this->CrmDeliveryReceipt->save()) {
			if($status != 'processed' || $status != "collected"){
				$this->loadModel('CrmQuotation');
				$this->CrmQuotation->id = $quotation_id;
				$this->CrmQuotation->set(['status' => 'PROCESSED']);
				$this->CrmQuotation->save();
			}
			echo json_encode("DeliveryReceipt saved");
			$DS_DeliveryReceipts->commit();
		}
		else {
			return json_encode();
			exit;
		}
		
		return json_encode($dr_number);
		exit;
	}
	
	public function get_info() {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $id = $this->request->query['id'];
            $this->CrmDeliveryReceipt->recursive = -1;
            $lead = $this->CrmDeliveryReceipt->findById($id);
            return (json_encode($lead['CrmDeliveryReceipt']));
            exit;
        }
    }
    
    public function update_booking_process(){
        
        $this->autoRender = false;
        $this->response->type('json');
        $dd = $this->request->data;
        $id = $dd['dr_id'];
        $booking_code = $dd['ubooking_code']; 
        $amount = $dd['uamount']; 
        $udate = $dd['udate'];
        $dr_type = $dd['utype']; 
         
        $this->CrmDeliveryReceipt->id = $id;
        $this->CrmDeliveryReceipt->set(array(
            'booking_code'=>$booking_code,
            'amount'=>$amount,
            'dr_type'=>$dr_type,
            'delivery_date' => $udate
            ));
        if($this->CrmDeliveryReceipt->save()) { 
            return json_encode($id);
        } 
        exit;
    }
    
    public function action() {
        $this->autoRender = false;
        $id = $this->request->data['id'];
        $action = $this->request->data['action'];
        
        $DS_DeliveryReceipt= $this->CrmDeliveryReceipt->getDataSource();
        $this->CrmDeliveryReceipt->id = $id;
        $this->CrmDeliveryReceipt->set(['status'=>$action]);
        if($this->CrmDeliveryReceipt->save()) {
            $DS_DeliveryReceipt->commit();
        }
        else {
            $DS_DeliveryReceipt->rollback();
        }
        
        return json_encode($id);
        exit;
    }
}
