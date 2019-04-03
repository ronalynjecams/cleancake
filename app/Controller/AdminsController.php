<?php
App::uses('AppController', 'Controller');
/**
 * Admins Controller
 *
 * @property Admin $Admin
 * @property PaginatorComponent $Paginator
 */
class AdminsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('dashboard_api', 'get_sales_agent', 'maketime');
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Admin->recursive = 0;
		$this->set('admins', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Admin->exists($id)) {
			throw new NotFoundException(__('Invalid admin'));
		}
		$options = array('conditions' => array('Admin.' . $this->Admin->primaryKey => $id));
		$this->set('admin', $this->Admin->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Admin->create();
			$adminData = $this->request->data;
			$detailData['CrmEmployeeDetail']['quota'] = $adminData['Admin']['quota'];
			$detailData['CrmEmployeeDetail']['date_employed'] = $adminData['Admin']['date_employed'];
			$detailData['CrmEmployeeDetail']['signature'] = $adminData['Admin']['signature'];
			$detailData['CrmEmployeeDetail']['position'] = $adminData['Admin']['position'];
			unset($adminData['Admin']['quota']);
			unset($adminData['Admin']['date_employed']);
			unset($adminData['Admin']['signature']);
			if ($this->Admin->save($adminData)) {
				if(!empty($detailData['CrmEmployeeDetail']['signature']['name'])) {
		            $file = $detailData['CrmEmployeeDetail']['signature'];
		            $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
		            $arr_ext = array('jpg', 'jpeg', 'png');
		            
					$t = microtime(true);
					$micro = sprintf("%06d",($t - floor($t)) * 1000000);
					$date_ms = new DateTime( date('Y-m-d H:i:s.'.$micro, $t));
					$date_tmp = $date_ms->format('YmdHisu');
					
		            $newfilename = $file['name'];
		            if($ext == 'jpg' || $ext == 'jpeg'){
		            	$createdImage = imagecreatefromjpeg($file['tmp_name']);
		            }
		            if($ext == 'png'){
		            	$createdImage = imagecreatefrompng($file['tmp_name']);
		            }
					if($createdImage){
			            if(in_array($ext, $arr_ext))
			            {
			                if(move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/signatures' . DS . $date_tmp."_".$newfilename))
			                {
			                	$detailData['CrmEmployeeDetail']['signature'] = $date_tmp."_".$newfilename;
						        $detailData['CrmEmployeeDetail']['admin_id'] = $this->Admin->getLastInsertID();
						        $this->loadModel('CrmEmployeeDetail');
						        $this->CrmEmployeeDetail->create();
						        $this->CrmEmployeeDetail->save($detailData);
			                }
			            }
					}
			    }
				$this->Session->setFlash(__('The admin has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The admin could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->Admin->exists($id)) {
			throw new NotFoundException(__('Invalid admin'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Admin->save($this->request->data)) {
				$this->Session->setFlash(__('The admin has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The admin could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Admin.' . $this->Admin->primaryKey => $id));
			$this->request->data = $this->Admin->find('first', $options);
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
		$this->Admin->id = $id;
		if (!$this->Admin->exists()) {
			throw new NotFoundException(__('Invalid admin'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Admin->delete()) {
			$this->Session->setFlash(__('The admin has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The admin could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function login(){
		if ($this->request->is('post')) {
            if ($this->Auth->login()) {
		    	$this->Admin->recursive = -1;
		    	$options['conditions'] = ['Admin.id' => $this->Auth->user('id')];
		    	$options['contain'] = ['CrmEmployeeDetail'];
		    	$this->Admin->Behaviors->attach('Containable');
		    	$user = $this->Admin->find('first',  $options);
		    	$user_up = $user['Admin'];
		    	$user_up['CrmEmployeeDetail'] = $user['CrmEmployeeDetail'];
		    	$this->Session->write('Auth.User', $user_up);
		    	
				return $this->redirect('/admins/dashboard');
            }
			$this->Session->setFlash(__('Invalid username or password, try again'));

		}
	}
	
	public function logout() {
        // $this->Hybridauth->logout();
        return $this->redirect($this->Auth->logout());
    }
    
    public function dashboard(){
    	$this->Admin->recursive = -1;
    	$id = 0;
    	$users = [];
    	if($this->Auth->user('job_title') == 'admin'){
    		$users = $this->Admin->findAllByJobTitle('sales_executive');
    		
    	}else{
    		$id = $this->Auth->user('id');
    	}
    	
    	$this->set(compact('users'));
    	
    	$month = $this->getMonthly($id);
        $year = $this->getYearly($id);;
        $this->set(compact('month', 'year'));
    }
   
	public function get_sales_agent(){
    	$this->autoRender = false;
        
        $this->Admin->recursive = -1;
        $users = $this->Admin->findAllByJobTitle('sales_executive', ['id']);
        foreach($users as $user) {
            $user_id = $user['Admin']['id'];
            $get_month_quotes[$user_id] = $this->getMonthly($user_id);
            $get_year_quotes[$user_id] = $this->getYearly($user_id);
            $get_year_quotes[$user_id]['pending'] = $this->getQuotationCount($user_id, 'pending');
            $get_year_quotes[$user_id]['approved'] = $this->getQuotationCount($user_id, 'approved');
            
        }
        
        return json_encode(["month"=>$get_month_quotes, "year"=>$get_year_quotes]);
    }
    
    public function dashboard_api(){
    	$this->autoRender = false;
    	$this->Admin->recursive = -1;
    	$id = 0;
    	$users = $this->Admin->findAllByJobTitle('sales_executive');
    	$month = $this->getMonthly($id);
        $year = $this->getYearly($id);
        $quotations['pending'] = $this->getQuotationCount(0, 'PENDING', 1);
        $quotations['moved'] = $this->getQuotationCount(0, 'MOVED', 1);
        $quotations['approved'] = $this->getQuotationCount(0, 'APPROVED', 1);
        $quotations['processed'] = $this->getQuotationCount(0, 'PROCESSED', 1);
        $quotations['collected'] = $this->getQuotationCount(0, 'COLLECTED', 1);
        $quotations['cancelled'] = $this->getQuotationCount(0, 'CANCELLED', 1);
        
        return json_encode(['month'=>$month, 'year'=>$year, 'users'=>$users, 'quotations'=>$quotations]);
    }
    
    public function maketime($cut_off = 1, $in_fr, $in_to, $out_fr, $out_to, $ex, $name){
    	$time = [];
    	$st = 6;
    	$end = 20;
    	$month = date('m');
    	if($cut_off == 2){
    		$month2 = date('m', strtotime(date('Y-m')." -1 month"));
    		$st = 21;
    		$month_end = strtotime('last day of last month', time());
    		$end = date('d', $month_end);
    		$res = $this->makerand($month2, $st, $end, $in_fr, $in_to, $out_fr, $out_to, $ex);
    		$st = 1;
    		$end = 5;
    		// $month = date('m', strtotime('+1 month'));
    		$res2 = $this->makerand($month, $st, $end, $in_fr, $in_to, $out_fr, $out_to, $ex);
    		$time = array_merge($res,$res2);
    	} else{
    		$time = $this->makerand($month, $st, $end, $in_fr, $in_to, $out_fr, $out_to, $ex);
    	}
  //  	pr($time);
		// exit;
		
		$this->set('time', $time);
		$this->set('name', $name);
    }
    
    public function makerand($month, $st, $end, $in_fr, $in_to, $out_fr, $out_to, $ex){
    	$year = date('Y');
    	$arr = [];
    	while($st <= $end){
    		$in = $month."/".$st."/".$year." ".rand($in_fr,$in_to).":".str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT).":".str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT);
    		$out = $month."/".$st."/".$year." ".rand($out_fr,$out_to).":".str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT).":".str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT);
    		
    		$diff=date_diff(date_create($in),date_create($out));
    		if(date('D', strtotime($in)) == $ex){
    			$st++;
    		}else{
	    		if($diff->h >= 9 ){
	    			$arr[$st]['in'] = $in;
    				$arr[$st]['out'] = $out;
		    		$st++;
	    		}
    		}
    		
    	}
    	return $arr;
    }
}
