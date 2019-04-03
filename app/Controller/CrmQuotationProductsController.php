<?php
App::uses('AppController', 'Controller');
/**
 * CrmQuotationProducts Controller
 *
 * @property CrmQuotationProduct $CrmQuotationProduct
 * @property PaginatorComponent $Paginator
 */
class CrmQuotationProductsController extends AppController {

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
		$this->CrmQuotationProduct->recursive = 0;
		$this->set('crmQuotationProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CrmQuotationProduct->exists($id)) {
			throw new NotFoundException(__('Invalid crm quotation product'));
		}
		$options = array('conditions' => array('CrmQuotationProduct.' . $this->CrmQuotationProduct->primaryKey => $id));
		$this->set('crmQuotationProduct', $this->CrmQuotationProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CrmQuotationProduct->create();
			if ($this->CrmQuotationProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The crm quotation product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm quotation product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$crmQuotations = $this->CrmQuotationProduct->CrmQuotation->find('list');
		$products = $this->CrmQuotationProduct->Product->find('list');
		$admins = $this->CrmQuotationProduct->Admin->find('list');
		$this->set(compact('crmQuotations', 'products', 'admins'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CrmQuotationProduct->exists($id)) {
			throw new NotFoundException(__('Invalid crm quotation product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CrmQuotationProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The crm quotation product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crm quotation product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('CrmQuotationProduct.' . $this->CrmQuotationProduct->primaryKey => $id));
			$this->request->data = $this->CrmQuotationProduct->find('first', $options);
		}
		$crmQuotations = $this->CrmQuotationProduct->CrmQuotation->find('list');
		$products = $this->CrmQuotationProduct->Product->find('list');
		$admins = $this->CrmQuotationProduct->Admin->find('list');
		$this->set(compact('crmQuotations', 'products', 'admins'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CrmQuotationProduct->id = $id;
		if (!$this->CrmQuotationProduct->exists()) {
			throw new NotFoundException(__('Invalid crm quotation product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CrmQuotationProduct->delete()) {
			$this->Session->setFlash(__('The crm quotation product has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The crm quotation product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function saveQuotationProduct(){
        $this->loadModel('CrmQuotation');
        
        $this->autoRender = false;
        $data = $this->request->data;
        $quotation_product_id = $data['quotation_product_id'];
        $Qfield = $data['Qfield'];
        $value = $data['value'];
         
         $qp = $this->CrmQuotationProduct->findById($quotation_product_id);
         if($Qfield == 'qty'){
             
             $qp_val = $qp['CrmQuotationProduct']['list_price'];
             $new_total = $value * $qp_val;
             
         }else  if($Qfield == 'list_price'){
             
             $qp_val_price = $qp['CrmQuotationProduct']['qty'];
             $new_total = $value * $qp_val_price;
             
         }else if($Qfield == 'description'){
             
             $new_total = $qp['CrmQuotationProduct']['total_price'];
             
         }
         
         
         
        
        $this->CrmQuotationProduct->id = $quotation_product_id;
        $this->CrmQuotationProduct->set(array(
            $Qfield => $value , 
            'total_price' =>$new_total
        ));
        if ($this->CrmQuotationProduct->save()) { 
            
            
             if($Qfield != 'description'){
                    $prod_total = $this->CrmQuotationProduct->find('first', array( 'fields' => array('sum(CrmQuotationProduct.total_price) AS sub_total'),
                    'conditions'=>array('CrmQuotationProduct.crm_quotation_id'=>$qp['CrmQuotationProduct']['crm_quotation_id'])));
                
                    $quote_data = $this->CrmQuotation->findById($qp['CrmQuotationProduct']['crm_quotation_id']);
                 
                    $discount = $quote_data['CrmQuotation']['discount']; 
                    $delivery_amount = $quote_data['CrmQuotation']['delivery_amount'];
                    $installation_amount = $quote_data['CrmQuotation']['installation_amount'];
                    
                    $sub_total = $prod_total[0]['sub_total'];
                    
                    $grand_total = ($sub_total + $delivery_amount + $installation_amount ) - $discount; 
                    
                    
                        $this->CrmQuotation->id = $qp['CrmQuotationProduct']['crm_quotation_id'];
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
             }else{
                 echo json_encode($data); 
             }
        } else {
            echo json_encode('invalid data');
        }
        exit;
    }
}
