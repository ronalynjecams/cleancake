<?php
App::uses('AppController', 'Controller');
/**
 * CrmQuotations Controller
 *
 * @property CrmQuotation $CrmQuotation
 * @property PaginatorComponent $Paginator
 */
class CrmQuotationsController extends AppController {

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
		$this->CrmQuotation->recursive = 0;
		$this->set('crmQuotations', $this->Paginator->paginate());
	}

    public function all_list() {
        $status = $this->params['url']['status'];
        $type = $this->params['url']['type'];
        $role = $this->Auth->user('job_title');
        $user_id = $this->Auth->user('id');
        
        $this->loadModel('CrmCollection');
        
        if($role!="sales_executive") {
            $options = ['conditions'=>
                ['status'=>$status]];
        }
        else {
            $options = ['conditions'=>
                ['CrmQuotation.status'=>$status,
                 'CrmQuotation.admin_id'=>$user_id]];
        }
        
        $inq_condition = ($type == 0) ? 'CrmQuotation.inquiry_id' : 'CrmQuotation.inquiry_id !=';
        
        $options['conditions'][$inq_condition] = 0; 
        
        $quotations = $this->CrmQuotation->find('all', $options);
        // pr($quotations); exit;
        $cols_obj = [];
        foreach($quotations as $quotation_obj) {
            $quotation = $quotation_obj['CrmQuotation'];
            $quote_id = $quotation['id'];

            $this->CrmCollection->recursive = -1;
            $cols_obj[$quote_id] = $this->CrmCollection->find('all',
                ['conditions'=>['crm_quotation_id'=>$quote_id,
                                'status'=>'verified'],
                                'fields'=>['paid_amount', 'ewt_amount', 'other_amount']]);
        }
        $this->set(compact('status','quotations', 'cols_obj'));
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CrmQuotation->exists($id)) {
			throw new NotFoundException(__('Invalid crm quotation'));
		}
		$options = array('conditions' => array('CrmQuotation.' . $this->CrmQuotation->primaryKey => $id));
		$this->set('crmQuotation', $this->CrmQuotation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CrmQuotation->create();
			if ($this->CrmQuotation->save($this->request->data)) {
				$this->Session->setFlash(__('The crm quotation has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm quotation could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$crmCompanies = $this->CrmQuotation->CrmCompany->find('list');
		$admins = $this->CrmQuotation->Admin->find('list');
		$inquiries = $this->CrmQuotation->Inquiry->find('list');
		$this->set(compact('crmCompanies', 'admins', 'inquiries'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CrmQuotation->exists($id)) {
			throw new NotFoundException(__('Invalid crm quotation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CrmQuotation->save($this->request->data)) {
				$this->Session->setFlash(__('The crm quotation has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm quotation could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('CrmQuotation.' . $this->CrmQuotation->primaryKey => $id));
			$this->request->data = $this->CrmQuotation->find('first', $options);
		}
		$crmCompanies = $this->CrmQuotation->CrmCompany->find('list');
		$admins = $this->CrmQuotation->Admin->find('list');
		$inquiries = $this->CrmQuotation->Inquiry->find('list');
		$this->set(compact('crmCompanies', 'admins', 'inquiries'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CrmQuotation->id = $id;
		if (!$this->CrmQuotation->exists()) {
			throw new NotFoundException(__('Invalid crm quotation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CrmQuotation->delete()) {
			$this->Session->setFlash(__('The crm quotation has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The crm quotation could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function quote($status = null, $id = null) {
        //check if user has an ongoing create quotation
        if($status == 'create') {
        $ongoing = $this->CrmQuotation->find('first', array(
            'conditions' => array( 
                'CrmQuotation.admin_id' => $this->Auth->user('id'),
                'CrmQuotation.status' => 'ONGOING'
        )));
        
        
        if(count($ongoing)!=0){
            //meaning meron syang ongoing na ginagawang quotation
            $quote_data = $ongoing; //retrieved data from existing ongoing quotation
        }else{
            //walang existing so data magcreate na ng data 
            $terms_information = '<h3>I. PAYMENT</h3>
                                            <ol>
                                            <li>
                                            <p>A<strong> FIFTY PERCENT (50%)</strong> downpayment shall be required unless Raeas Marketing and the Client shall otherwise agree, balance upon completion of delivery as per agreement.</p>
                                            </li>
                                            <li>
                                            <p>Payment will be accepted in Dated Company Check, Manager’s Check, thru Bank Transfer or Cash.</p>
                                            </li>
                                            <li>
                                            <p>All check is payable to Raeas Marketing.</p>
                                            </li>
                                            </ol>
                                            <h3>II. DELIVERY</h3>
                                            <ol>
                                            <li>
                                            <p>Delivery is FREE for purchases above Php3, 000.00 within Metro Manila. </p>
                                            </li>
                                            <li>
                                            <p>Delivery outside Metro Manila may be charged to client.</p>
                                            </li>
                                            </ol>
                                            <h3>III. Validity</h3> 
                                            <ol>
                                            <li>
                                            <p>10 Days from the date of proposal.</p>
                                            </li>
                                            <li>
                                            <p>Prices may vary without prior notice and shall not be considered final unless and until this Quotation Proposal has been signed and accepted.</p>
                                            </li>
                                            </ol>
                                            <h3>IV. Warranty</h3> 
                                            <ol>
                                            <li>
                                            <p>One (1) year warranty against factory defect upon normal operating condition.</p>
                                            </li>
                                            </ol>
                                            <h3>V. Cancellation of orders</h3> 
                                            <ol>
                                            <li>
                                            <p>All cancellation of orders will be charged a cancellation fee of 30% of the order value.</p>
                                            </li>
                                            </ol>';
            $dateToday = date("Hymds");
            $milliseconds = round(microtime(true) * 1000);
            $newstring = substr($milliseconds, -3);
            $quote_number = $newstring . '' . $dateToday;
             
            $quote_exist = $this->CrmQuotation->find('count', array(
                'conditions' => array(
                    'CrmQuotation.quote_number' => $quote_number
            )));

            if ($quote_exist == 0) {
                $quote_no = $quote_number;
            } else {
                $news = substr($milliseconds, -4);
                $quote_no = $news . '' . $dateToday;
            }
            $this->CrmQuotation->create();
            $this->CrmQuotation->set(array(
                'quote_number' => $quote_no,
                'admin_id' => $this->Auth->user('id'),
                'status' => 'ONGOING',
                'terms' => $terms_information, 
            ));
            $this->CrmQuotation->save();
            $id = $this->CrmQuotation->getLastInsertID(); 
            $quote_data = $this->CrmQuotation->find('first', array(
                'conditions' => array('CrmQuotation.admin_id' => $this->Auth->user('id'), 'CrmQuotation.status' => 'ONGOING')
            )); 
        }
        } else{
            $quote_data = $this->CrmQuotation->findById($id);    
        }
        
        $this->set(compact('quote_data'));
         
        
        $companies = $this->getCompanies();
            // pr($quote_data);
        $quote_prods = $this->getQuotationProducts($quote_data['CrmQuotation']['id']);
       
        $product_lists = $this->getProducts();
        
        $this->set(compact('status','companies', 'quote_prods', 'product_lists'));
        

    }
    
    public function saveCreateQuotation() {
        $this->autoRender = false;
        $data = $this->request->data;
        $id = $data['id'];
        $Qfield = $data['Qfield'];
        $value = $data['value'];

        if($Qfield != 'terms'){  
        
            if($Qfield == 'crm_company_id'){ 
                $this->loadModel('CrmCompany');
                
                // $this->Company->recursive=-1;
                $address = $this->CrmCompany->find('first',[
                    'conditions'=>['CrmCompany.id' =>$value],
                    'fields'=>['CrmCompany.address']
                    ]); 
                $shipping_address = $address['CrmCompany']['address'];
                $billing_address = $address['CrmCompany']['address'];
                
                        $this->CrmQuotation->id = $id;
                        $this->CrmQuotation->set(array(
                            $Qfield => $value,
                            'shipping_address' => $shipping_address,
                            'billing_address' => $billing_address 
                        ));
                        if ($this->CrmQuotation->save()) {
                            echo json_encode($data); 
                        } else {
                            echo json_encode('invalid dataa');
                        }
            }else{ 
               

                    $this->CrmQuotation->id = $id;
                    $this->CrmQuotation->set(array(
                        $Qfield => $value, 
                    ));
                    if ($this->CrmQuotation->save()) {
                        echo json_encode($data); 
                    } else {
                        echo json_encode('invalid dataq');
                    }
            }
        }else{  
            $today = date("Y-m-d H:m:s");
            $this->CrmQuotation->id = $id;
            $this->CrmQuotation->set(array(
                $Qfield => $value,
                'status' => 'PENDING', 
                'shipping_address' => $data['shipping_address'],
                'billing_address' => $data['billing_address'],
                'created'=>$today
            ));
            if ($this->CrmQuotation->save()) {
                echo json_encode($data); 
            } else {
                echo json_encode('invalid data');
            }
        }
        exit;
    }
    
    public function saveProductQuotation() {
        $this->loadModel('CrmQuotationProduct');
        $this->loadModel('CrmQuoteprodVariant');
        $this->autoRender = false;
        $data = $this->request->data;
        $product_id = $data['product_id'];
        $qty = $data['qty'];
        $list_price = $data['list_price'];
        $description = $data['description'];
        $quotation_id = $data['quotation_id'];
        $variant_product_id = $data['variant_product_id'];

        $tol_price = $list_price * $qty;

        $this->CrmQuotationProduct->create();
        $this->CrmQuotationProduct->set([
            "crm_quotation_id" => $quotation_id,
            "product_id" => $product_id,
            "qty" => $qty,
            "list_price" => $list_price,
            "description" => $description,
            "total_price" => $tol_price,
            "admin_id" => $this->Auth->user('id'),
        ]);
        if ($this->CrmQuotationProduct->save()) { 
            $this->CrmQuotationProduct->recursive =-1;
            
            $quoteprod_id = $this->CrmQuotationProduct->getLastInsertID();
            $this->CrmQuoteprodVariant->create();
            $this->CrmQuoteprodVariant->set([
                'crm_quotation_product_id' => $quoteprod_id,
                'product_variant_id' => $variant_product_id
            ]);
            $this->CrmQuoteprodVariant->save();
                
            $total = $this->CrmQuotationProduct->find('first', array( 'fields' => array('sum(CrmQuotationProduct.total_price) AS sub_total'),
                'conditions'=>array('CrmQuotationProduct.crm_quotation_id'=>$quotation_id)));
                
            $quotedata = $this->CrmQuotation->findById($quotation_id);
            $delivery_amount = $quotedata['CrmQuotation']['delivery_amount'];
            $installation_amount = $quotedata['CrmQuotation']['installation_amount'];
            $discount = $quotedata['CrmQuotation']['discount'];
            
            $grand_total = ($total[0]['sub_total'] - $discount)+$delivery_amount+$installation_amount;
            
            $this->CrmQuotation->id = $quotation_id;
            $this->CrmQuotation->set([
                'sub_total' => $total[0]['sub_total'],
                'grand_total' =>$grand_total
                ]);
            if($this->CrmQuotation->save()){
                echo json_encode($data); 
            }
        }
        exit;
    }
    
    public function delete_product(){
        $this->loadModel('CrmQuotationProduct');
        $this->autoRender = false;
        $data = $this->request->data;
        
        $quotation_product_id = $data['quotation_product_id'];
        $quotation_id = $data['quotation_id'];
         
        if($this->CrmQuotationProduct->delete($quotation_product_id)){ 
            
            $this->CrmQuotationProduct->recursive =-1;
            $total = $this->CrmQuotationProduct->find('first', array( 'fields' => array('sum(CrmQuotationProduct.total_price) AS sub_total'),
                'conditions'=>array('CrmQuotationProduct.crm_quotation_id'=>$quotation_id)));
                
            $quotedata = $this->CrmQuotation->findById($quotation_id);
            $delivery_amount = $quotedata['CrmQuotation']['delivery_amount'];
            $installation_amount = $quotedata['CrmQuotation']['installation_amount'];
            $discount = $quotedata['CrmQuotation']['discount'];
            
            $grand_total = ($total[0]['sub_total'] - $discount)+$delivery_amount+$installation_amount;
            
            $this->CrmQuotation->id = $quotation_id;
            $this->CrmQuotation->set([
                'sub_total' => $total[0]['sub_total'],
                'grand_total' =>$grand_total
                ]);
            if($this->CrmQuotation->save()){ 
                echo json_encode($data);
                // return json_encode($data);
            }
            
            
            
            
        }
        
    }
    
    public function saveComputeQuotationProcess(){
        $this->loadModel('CrmQuotationProduct');
        $this->autoRender = false;
        $data = $this->request->data;
        
        $quotation_id = $data['quotation_id'];
        $value = $data['value'];
        $Qfield = $data['Qfield'];
         
        $quote_data = $this->CrmQuotation->findById($quotation_id);
        
             
                 
            $prod_total = $this->CrmQuotationProduct->find('first', array( 'fields' => array('sum(CrmQuotationProduct.total_price) AS sub_total'),
                'conditions'=>array('CrmQuotationProduct.crm_quotation_id'=>$quotation_id)));
                
        if($Qfield == 'discount'){
            $discount = $value; 
            $delivery_amount = $quote_data['CrmQuotation']['delivery_amount'];
            $installation_amount = $quote_data['CrmQuotation']['installation_amount'];
            
            $sub_total = $prod_total[0]['sub_total'];
            
            $grand_total = ($sub_total - $discount) + ($delivery_amount + $installation_amount); 
            //get subtotal , delivery_amount, installation_amount. then compute grand total 
        }else if($Qfield == 'delivery_amount'){
            $discount = $quote_data['CrmQuotation']['discount'];
            $delivery_amount = $value; 
            $installation_amount = $quote_data['CrmQuotation']['installation_amount'];
            
            $sub_total = $prod_total[0]['sub_total'];
            
            $grand_total = ($sub_total - $discount) + ($delivery_amount + $installation_amount); 
            //get subtotal , delivery_amount, installation_amount. then compute grand total 
        }else if($Qfield == 'installation_amount'){
            $discount = $quote_data['CrmQuotation']['discount'];
            $delivery_amount = $quote_data['CrmQuotation']['delivery_amount'];
            $installation_amount =  $value; 
            
            $sub_total = $prod_total[0]['sub_total'];
            
            $grand_total = ($sub_total - $discount) + ($delivery_amount + $installation_amount); 
            //get subtotal , delivery_amount, installation_amount. then compute grand total 
        }
        
        $this->CrmQuotation->id = $quotation_id;
        $this->CrmQuotation->set([
            'discount' => $discount,
            'sub_total' => $sub_total,
            'delivery_amount' => $delivery_amount,
            'installation_amount' => $installation_amount, 
            'grand_total' => $grand_total, 
            ]);
        if($this->CrmQuotation->save()){
            echo json_encode($data); 
        }
    }
    
    public function action() {
        $this->autoRender = false;
        $quote_id = $this->request->data['id'];
        $action = $this->request->data['action'];
        
        $DS_Quotation = $this->CrmQuotation->getDataSource();
        $this->CrmQuotation->id = $quote_id;
        
        $data = ['status'=>$action];
        
        if($action == 'MOVED'){
            $data['date_moved'] = date('Y-m-d H:m:s'); 
        }
        
        $this->CrmQuotation->set($data);
        if($this->CrmQuotation->save()) {
            $DS_Quotation->commit();
        }
        else {
            $DS_Quotation->rollback();
        }
        
        return json_encode($quote_id);
        exit;
    }
	
}
