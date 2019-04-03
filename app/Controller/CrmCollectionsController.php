<?php
App::uses('AppController', 'Controller');
/**
 * CrmCollections Controller
 *
 * @property CrmCollection $CrmCollection
 * @property PaginatorComponent $Paginator
 */
class CrmCollectionsController extends AppController {

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
		$this->CrmCollection->recursive = 0;
		$this->set('crmCollections', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	// public function view($id = null) {
	// 	if (!$this->CrmCollection->exists($id)) {
	// 		throw new NotFoundException(__('Invalid crm collection'));
	// 	}
	// 	$options = array('conditions' => array('CrmCollection.' . $this->CrmCollection->primaryKey => $id));
	// 	$this->set('crmCollection', $this->CrmCollection->find('first', $options));
	// }
	
	public function view(){
		$quote_id = $this->params['url']['id'];
		
		$this->loadModel('CrmQuotation');
		$this->loadModel('CrmQuotationProduct');
		$this->loadModel('CrmDeliveryReceipt');
		
		$quotes_obj = $this->CrmQuotation->findById($quote_id);
		$quote_prods = $this->getQuotationProducts($quote_id);
		$drs_obj = $this->CrmDeliveryReceipt->findById($quote_id);
		
		$this->set(compact('quotes_obj', 'drs_obj', 'quote_prods'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CrmCollection->create();
			if ($this->CrmCollection->save($this->request->data)) {
				$this->Session->setFlash(__('The crm collection has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm collection could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$crmQuotations = $this->CrmCollection->CrmQuotation->find('list');
		$crmBanks = $this->CrmCollection->CrmBank->find('list');
		$this->set(compact('crmQuotations', 'crmBanks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CrmCollection->exists($id)) {
			throw new NotFoundException(__('Invalid crm collection'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CrmCollection->save($this->request->data)) {
				$this->Session->setFlash(__('The crm collection has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm collection could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('CrmCollection.' . $this->CrmCollection->primaryKey => $id));
			$this->request->data = $this->CrmCollection->find('first', $options);
		}
		$crmQuotations = $this->CrmCollection->CrmQuotation->find('list');
		$crmBanks = $this->CrmCollection->CrmBank->find('list');
		$this->set(compact('crmQuotations', 'crmBanks'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CrmCollection->id = $id;
		if (!$this->CrmCollection->exists()) {
			throw new NotFoundException(__('Invalid crm collection'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CrmCollection->delete()) {
			$this->Session->setFlash(__('The crm collection has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The crm collection could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function update(){
		$id = $this->params['url']['id'];
		$this->loadModel('CrmQuotation');
		$this->loadModel('CrmBank');
		
		
		$quote_data = $this->CrmQuotation->findById($id); 
		
		
		$collection_data = $this->CrmCollection->findAllByCrmQuotationId($id); 
		
		$banks = $this->CrmBank->find('all');
		
		
		
		
		$this->set(compact('quote_data', 'collection_data', 'banks'));
	}
	
	public function processpayment(){
		
		$data = $this->request->data;
		$this->autoRender = false;
		
		$paid_amount = $data['paid_amount'];
        $ewt_amount = $data['ewt_amount'];
        $other_amount = $data['other_amount'];
        $cheque_date = $data['cheque_date'];
        $cheque_number = $data['cheque_number'];  
        $bank_id = $data['bank_id']; 
        $type = $data['type'];
        $quotation_id = $data['quotation_id'];
        $contract_amount = $data['contract_amount'];
        
        $this->CrmCollection->recursive = 0;
        $check_payment = $this->CrmCollection->findAllByCrmQuotationId($quotation_id);
        $date = date('Y-m-d h:m:i');
        
        if($this->Auth->user('job_title') == 'sales_executive' ){
	        if(count($check_payment) == 0){
	        	$status = 'newest';
	        } else{
	        	$status = 'unverified';
	        }
        } else{
        	$status = 'verified';
        }
        
        if($type == 'cash'){
        	$this->CrmCollection->create();
        	$this->CrmCollection->set(array('crm_quotation_id' => $quotation_id, 'type' => $type, 'paid_amount' => $paid_amount, 'ewt_amount' => $ewt_amount, 'other_amount' => $other_amount, 'status' => $status, 'created' => $date, 'modified' => $date));
        }
        
        if($type == 'cheque'){
        	$this->CrmCollection->create();
        	$this->CrmCollection->set(array('crm_quotation_id' => $quotation_id, 'type' => $type, 'paid_amount' => $paid_amount, 'cheque_date', $cheque_date, 'cheque_number' => $cheque_number, 'bank_id' => $bank_id, 'status' => $status, 'created' => $date, 'modified' => $date));
        }
        if($type == 'online'){
        	$this->CrmCollection->create();
        	$this->CrmCollection->set(array('crm_quotation_id' => $quotation_id, 'type' => $type, 'paid_amount' => $paid_amount, 'ewt_amount' => $ewt_amount, 'other_amount' => $other_amount, 'bank_id' => $bank_id, 'status' => $status, 'created' => $date, 'modified' => $date));
        }
        
        if ($this->CrmCollection->save()){
        	$sum = $this->CrmCollection->find('all', array(
		    'conditions' => array(
		    'CrmCollection.crm_quotation_id' => $quotation_id),
		    'fields' => array('sum(CrmCollection.paid_amount + CrmCollection.ewt_amount + CrmCollection.other_amount) as total_sum'
		            )
		        )
		    );
		    
		    
            if($this->Auth->user('role') == 'sales_executive'){
                $quotation_status = 'MOVED';
            }else{
            	if($sum[0][0]['total_sum'] >= $contract_amount){
		    		$quotation_status = 'COLLECTED';
		    		$data['collection_date'] = date('Y-m-d');
		    	}else{
	                $quotation_status = 'PROCESSED';
		    	}
            }
            
            $data['status'] = $quotation_status;
        	// if($status == 'newest'){
    		$this->loadModel('CrmQuotation');
    		$this->CrmQuotation->id=$quotation_id;
    		$this->CrmQuotation->set($data);
    		if($this->CrmQuotation->save()){
				return 'success';
    		}else{
    			return 'error';
    		}

       // 	}else{
    			// return 'success';
       // 	}/
    	} else{
    		return 'error';	
    	}
	}
	
	public function all_list() {
		$this->loadModel('CrmQuotation');
		$this->loadModel('CrmCompany');
		
		$status = $this->params['url']['status'];
		$undefined = "";
		
		$quotations = $this->CrmQuotation->CrmCollection->find('all',
		['conditions'=>['CrmCollection.status'=>'verified'],
		 'fields' => ['DISTINCT CrmQuotation.id', 'CrmQuotation.grand_total']
		]);
		
		$col_pending = [];
		$col_accom = [];
		foreach($quotations as $quote_obj) {
			$quote = $quote_obj['CrmQuotation'];
			$quote_grand_total = $quote['grand_total'];
			$quote_id = $quote['id'];
			
			$get_collections = $this->CrmCollection->find('all',
				['conditions'=>['CrmCollection.crm_quotation_id'=>$quote_id],
								'fields'=>
								['CrmCollection.id',
								 'CrmCollection.paid_amount']]);
			$col_paid_amount = 0.000000;
			foreach($get_collections as $ret_col) {
				$col = $ret_col['CrmCollection'];
				$col_id = $col['id'];
				$col_paid_amount += $col['paid_amount'];

				if($quote_grand_total!=$col_paid_amount) {
					$col_pending[] = $col_id;
				}
				else {
					$col_accom[] = $col_id;
				}
			}
		}
		
		if($status == "pending") {
			$cols = $this->CrmCollection->find('all', ['conditions'=>
				['CrmCollection.id'=>$col_pending]]);
		}
		elseif($status == "accomplished") {
			$cols = $this->CrmCollection->find('all', ['conditions'=>
				['CrmCollection.id'=>$col_accom]]);
		}
		else {
			$undefined = "Invalid Status.";
		}
		
		$clients = [];
		foreach($cols as $col_obj) {
			$quote_ent = $col_obj['CrmQuotation'];
			$quote_id = $quote_ent['id'];
			$cli_id = $quote_ent['crm_company_id'];
			
			$this->CrmCompany->recursive = -1;
			$clients[$quote_id] = $this->CrmCompany->findById($cli_id,
				'CrmCompany.name');
		}
		
		$this->set(compact('status', 'undefined', 'cols', 'clients'));
	}
	
	public function action($col_id = null, $action = null) {
        $this->autoRender = false;
        
        if(!empty($this->request->data)){
	        $col_id = $this->request->data['id'];
	        $action = $this->request->data['action'];
        }
        $DS_Collection = $this->CrmCollection->getDataSource();
        $this->CrmCollection->id = $col_id;
        $this->CrmCollection->set(['status'=>$action]);
        if($this->CrmCollection->save()) {
            $DS_Collection->commit();
        }
        else {
            $DS_Collection->rollback();
        }
        
        if(!empty($this->request->data)){
	        return json_encode($quote_id);
	        exit;
        }
    }
}
