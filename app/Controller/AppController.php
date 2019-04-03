<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'posts',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'display',
                'home'
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish',
                    'userModel' => 'Admin'
                )
            )
        )
    );
    
    public $active_company = "Raeas";
    public $active_company_name = "RAEAS MARKETING";
    public $active_company_email = "raeasmktg@gmail.com";
    public $active_company_url = "www.furniturestore.ph";
    public $active_company_logo = "/hai/raeas.jpg";
    public $active_company_dash_logo = "/hai/e-raeas.jpg";
    public $active_company_number = "751.4165";
    public $active_company_address = "54 Dona Soledad Ave., Better Living Subdivision, Don Bosco, Paranaque City";

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'bootstrap';
        $this->Auth->allow('add', 'view', 'logout', 'login');
        
        $this->set('authUser', $this->Auth->user());
        $this->set('userID', $this->Auth->user('id'));
        $this->set('userRole', $this->Auth->user('job_title'));
        
        $myrole = $this->Auth->user('job_title');
        
        if($myrole == 'sales_executive'){
            $job_title = 'Sales Executive';
        } elseif($myrole == 'sales_coordinator'){
            $job_title = 'Sales Coordinator';
        } else{
            $job_title = 'Admin';
        }
        
        $this->set(compact($myrole));

        $me = $this->Auth->user('id');
        $this->set(compact('me'));
        $active_company = "Raeas";
        $active_company_logo = "/hai/e-raeas.jpg";
        $active_skin = "skin-3";
        $active_company_url = "www.furniturestore.ph";
        $active_company_dash_logo = "/hai/e-raeas.jpg";
        $this->set(compact('active_company', 'active_company_logo', 'job_title', 'active_skin', 'active_company_url', 'active_company_dash_logo'));
        
    }
    
    public function getProducts(){
        // $this->autoRender = false;
        $this->loadModel('Product');
		$options['conditions'] = ['Product.parent_num' => NULL, 'Product.status' => 'APPROVED'];
		
		$products =$this->Product->find('all', $options);
		if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->response->type('json');
            
            return json_encode($products);
		}
		return $products;
		
		
	}
	
    public function getProductVariants($id){
	    $this->autoRender = false;
	    $this->loadModel('Product');
	    $this->loadModel('ProductVariant');
	    
	    $this->Product->recursive = -1;
	    $options['conditions'] = ['Product.parent_num' => $id, 'Product.status' => 'APPROVED'];
	    $products = $this->Product->find('list', $options);

// 		$this->ProductVariant->recursive = -1;
		$variants = $this->ProductVariant->find('all', ['conditions' => ['ProductVariant.product_id' => $products]]);
		
		$arr = [];
		$arr['display'] = [];
		foreach($variants as $variant){
		    $variant_name = $variant['ProductVariant']['attribute_name'];
		    $variant_value = $variant['ProductVariant']['attribute_value'];
		    
		    if(array_key_exists($variant_name,$arr['display'])){
    		    if(!in_array($variant_value,$arr['display'][$variant_name])){
        		    $arr['display'][$variant_name][] = $variant_value;
    		    }
		    }else{
		        $arr['display'][$variant_name][] = $variant_value ;
		    }
		    $arr[$id][] = ['attribute_name' => $variant_name, 
		                    'attribute_value' => $variant_value,
		                    'archive' => $variant['Product']['archive'],
		                    'base_price' => $variant['Product']['base_price'],
		                    'id' => $variant['Product']['id'] 
		                   ];
		}
		
		if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->response->type('json');
            
            return json_encode($arr);
		}
		return $arr;
// 		pr($arr);
	}
	
	public function getProduct($id){
	   // $this->autoRender = false;
	    $this->loadModel('Product');
		
		$this->Product->recursive = -1;
		$product = $this->Product->findById($id);
		$variants = $this->getProductVariants($id);
		
		$product['Variants'] = $variants;
		if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->response->type('json');
            return json_encode($product);
        }else{
            pr($product);
        }
	}
	
	public function checkVariants() {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->response->type('json');
            
            $property = $this->request->query['property'];
            $value = $this->request->query['value'];
            
            foreach($property as $key => $value){
                
            }
            
            $this->Product->recursive = -1;
            $product = $this->Product->findById($id);
            return (json_encode($product['Product']));
            exit;
        }
    }
	
	public function getCompanies($id = null){
	   // $this->autoRender = false;
	    $this->loadModel('CrmCompany');
	    
	    $a = 'all';
	    
	    $options['conditions'] = [
                'CrmCompany.type' => 'CLIENTS',
                'CrmCompany.admin_id' => $this->Auth->user('id')
            ];
            
	    if($id != null){
	        $a = 'first';
	        $options['conditions'] = ['CrmCompany.id' => $id]; 
	    }
	    
        $companies = $this->CrmCompany->find($a, $options);
        
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->response->type('json');
            if(!empty($companies['CrmCompany']))
                return json_encode($companies['CrmCompany']);
            }else{
                return $companies;
            }
	}
	
	public function getQuotationProducts($id = null){
	   // $this->autoRender = false;
	    $this->loadModel('CrmQuotationProduct');
	    $this->CrmQuotationProduct->recursive = -1;
	    $options['conditions'] = ['crm_quotation_id' => $id];
	    $options['contain'] = ['Product','CrmQuoteprodVariant' => ['ProductVariant']];
	    $this->CrmQuotationProduct->Behaviors->attach('Containable');
        return $this->CrmQuotationProduct->find('all', $options);
	}

    public function encryptor($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'Homefurniture2018';
        $secret_iv = 'H0m3furn1tur32018';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
    
    public function getImage($id){
        $encrypt = $this->encryptor('encrypt', $id);
        $img = file_get_contents('https://furniturestore.ph/catalog/product-path?pid='.$encrypt);
        
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->response->type('text');
            return $img;
        }else{
            return $img;
        }
    }
    
    public function getMonthly($id = 0, $month = null){
        // $this->autoRender = false;
        
        $this->loadModel('CrmQuotation');
        
        $month = ($month == null) ? date('m') : $month;

        $options['conditions'] = ['status'=>['PROCESSED', 'APPROVED', 'COLLECTED'],
                                'AND'=>['MONTH(CrmQuotation.date_moved)'=>$month,
                                    'YEAR(CrmQuotation.date_moved)'=>date('Y')]];
        if($id != 0){
            $options['conditions']['admin_id'] = $id;
        }
        $options['fields'] = ['id', 'CrmQuotation.date_moved', 'SUM(grand_total) as monthly_total', 'status'];
        $options['recursive'] = -1;
        
        $monthly = $this->CrmQuotation->find('all', $options);
        
        return $monthly;
    }
    
    public function getYearly($id = 0, $year = null){
        // $this->autoRender = false;
        
            $this->loadModel('CrmQuotation');
            
            $year = ($year == null) ? date('Y') : $year;
    
            $options['conditions'] = ['status'=>['PROCESSED', 'APPROVED', 'COLLECTED'],
                                    'AND'=>['YEAR(CrmQuotation.date_moved)'=>$year]];
            if($id != 0){
                $options['conditions']['admin_id'] = $id;
            }
            $options['fields'] = ['id', 'CrmQuotation.date_moved', 'SUM(grand_total) as yearly_total', 'status'];
            $options['recursive'] = -1;
            
            $yearly = $this->CrmQuotation->find('all',$options);
            return $yearly;
    }
    
    public function getQuotationCount($id = 0, $status = null, $per_status = 0){
        $this->loadModel('CrmQuotation');
        
        $this->CrmQuotation->recursive = -1;
        
        if($per_status==0){
            if($status == "approved" ){
                $options['conditions'] =  ['status'=>['PROCESSED', 'APPROVED', 'COLLECTED']];
            }
            if($status == "pending"){
                $options['conditions'] =  ['status'=>['PENDING']];
            }
        }
        if($per_status!=0){
            $options['conditions'] =  ['status'=>[$status]];
        }
        if($id != 0){
            $options['conditions']['admin_id'] = $id;
        }
        
        $quotations = $this->CrmQuotation->find('all', $options);
        
        return sizeof($quotations);
    }
    
}
