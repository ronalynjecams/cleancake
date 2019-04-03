<?php 
App::uses('AppController', 'Controller'); 
class PdfsController extends AppController { 
    public $components = array('Paginator', 'Mpdf.Mpdf');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('earnings', 'sales');
    }
    
    public function print_quote($quotation_id) {
        $this->Mpdf->init();

        // $quotation_id = $this->params['url']['id'];

        $this->loadModel('CrmQuotation');
        $this->CrmQuotation->recursive = 2;
        $quotation = $this->CrmQuotation->findById($quotation_id);
        $this->set(compact('quotation'));

        // pr($quotation); exit;

        $this->Mpdf->SetHTMLHeader('<div style="padding-top:-15px; right:500px; font-size:10px; " align="right">' . date("F d, Y h:i A") . '</div>');
        
        $this->Mpdf->SetHTMLFooter('<table style="width: 100%;padding-bottom:-15px;  ">
            <tr>
                <td style="text-align: left;width:70%;font-size:10px;">
                    Q ' . $quotation['CrmQuotation']['quote_number'] . '</td>
                <td style="text-align: right;width: 30%;font-size:10px;">{PAGENO} / {nbpg}</td> 
            </tr>
        </table> '); 

        $terms_info = '<p style="margin-top: -5px;"><font size="6">' . $quotation['CrmQuotation']['terms'] . '</font></p>';

        $terms = $terms_info;

        $this->set(compact('terms'));
 

        /////get sales agent who created the quotation
        $prepared_by = $quotation['Admin']['name'];
        $agent_signature = $quotation['Admin']['CrmEmployeeDetail']['signature'];
        $this->set(compact('prepared_by'));
        $this->set(compact('agent_signature'));
 


        $client_name = strtoupper($quotation['CrmCompany']['name']);
        $contact_person = strtoupper($quotation['CrmCompany']['contact_person']);
        $this->set(compact('contact_person'));
        $contact_number = strtoupper($quotation['CrmCompany']['contact_number']);
        $email = strtoupper($quotation['CrmCompany']['email']);
        $tin = ($quotation['CrmCompany']['tin_number'] != "") ? '<p style="margin-top: -5px;">TIN: ' . $quotation['CrmCompany']['tin_number'] . '</p>' : '';
        $address = strtoupper($quotation['CrmCompany']['address']);

        ////// PRODUCT DETAILS START //////

        $this->loadModel('CrmQuotationProduct');
        $this->CrmQuotationProduct->recursive = 2;
        $quote_products = $this->getQuotationProducts($quotation_id);
        // pr($quote_products);
        // exit;

        $cnt = 1;
        $sub_total = 0;
        $product_details = [];
        foreach ($quote_products as $quote_prod) {
            $desc_variant = '';
            foreach($quote_prod['CrmQuoteprodVariant']['ProductVariant'] as $variant){
                $desc_variant .= "<p>".$variant['attribute_name']." : ".$variant['attribute_value']."</p>";
            }
            
            $img = $this->getImage($quote_prod['Product']['id']);
            $img = json_decode($img);
            $product_details[] = '<tr>
                <td width="15" align="left">' . $cnt . '</td>
                <td width="140" align="center"><b>' . $quote_prod['Product']['code'] . '</b></td>
                <td width="120" align="center"><img class="img-responsive" src="' . $img->img . '" width="100"></td>
                <td width="200" style="word-wrap:break-word">' .$desc_variant.''. $quote_prod['CrmQuotationProduct']['description'] . '</td>
                <td width="20" align="right">' . abs($quote_prod['CrmQuotationProduct']['qty']) . '</td>
                <td width="100" align="right">&#8369;  ' . number_format($quote_prod['CrmQuotationProduct']['list_price'], 2) . '</td> 
                <td width="120" align="right">&#8369;  ' . number_format($quote_prod['CrmQuotationProduct']['total_price'], 2) . '</td></tr>';


            $cnt++;
            $sub_total = $sub_total + $quote_prod['CrmQuotationProduct']['list_price'];
        }


        if ($quotation['CrmQuotation']['discount'] != 0) {
            $discount = '&#8369;  ' . number_format($quotation['CrmQuotation']['discount'], 2);
            $dis = '
                  <tr align="right">
                    <td style="width:50%" align="right"><b>Discount:</b> </td>
                    <td  style="text-align:right">' . $discount . ' </td>
                  </tr>';
        } else {
            $discount = "";
            $dis = "";
        }
        if ($quotation['CrmQuotation']['installation_amount'] != 0) {
            $installation_charge = '&#8369;  ' . number_format($quotation['CrmQuotation']['installation_amount'], 2);
            $install = '
                 <tr align="right">
                    <td align="right" ><b>Installation charge:</b></td>
                    <td style="text-align:right"> ' . $installation_charge . '</td>
                  </tr>';
        } else {
            $installation_charge = "";
            $install = "";
        }

        if ($quotation['CrmQuotation']['delivery_amount'] != 0) {
            $delivery_charge = '&#8369;  ' . number_format($quotation['CrmQuotation']['delivery_amount'], 2);
            $del = '
                <tr  align="right">
                    <td style="width:50%" align="right"><b>Delivery charge:</b> </td>
                    <td  style="text-align:right">' . $delivery_charge . '</td>
                  </tr>';
        } else {
            $delivery_charge = "";
            $del = "";
        }

        if ($quotation['CrmQuotation']['installation_amount'] != 0 || $quotation['CrmQuotation']['delivery_amount'] != 0 || $quotation['CrmQuotation']['discount'] != 0) {
            $sub = '
                <tr  align="right">
                    <td  align="right"><b>Sub total:</b></td>
                    <td style="text-align:right; padding-right:0px" >&#8369;  ' . number_format($quotation['CrmQuotation']['sub_total'], 2) . '<br/> <br/> 
                 </td> 
                 </tr>';
        } else {
            $sub = "";
        }

        $raw_validity_date = $quotation['CrmQuotation']['validity_date'];
        if($raw_validity_date!="" && $raw_validity_date!=null && $raw_validity_date!="0000-00-00") {
            $validity_date = date('F d, Y', strtotime($raw_validity_date));
        }
        else {
            $date_created = new DateTime($quotation['CrmQuotation']['created_at']);
            date_add($date_created,date_interval_create_from_date_string("30 days"));
            $validity_date = date_format($date_created,"F d, Y");
        }

        ////// PRODUCT DETAILS END //////

        $this->Mpdf->WriteHTML(' <div style=" top: 35px; left:18px;  font-size:10px; ">
        <table style="width: 100%; border:1px; font-family:arial ">
        
            <tr>
                <td colspan="2" align="right">
                  <h2>QUOTATION</h2>
                </td> 
            </tr>
            <tr>
                <td style="text-align: left;width:35%; font-size:13px;padding-right:20px;">
                <font style="font-size:12px;">
                    <p style="margin-top: -5px;">'.$this->active_company_name.'</p>
                    <p style="margin-top: -5px;">Address : '.$this->active_company_address.'</p>
                    <p style="margin-top: -5px;">Tel: (02) '.$this->active_company_number.'</p>
                    <p style="margin-top: -5px;">Email Add : '.$this->active_company_email.'</p>
                    <p style="margin-top: -5px;">'.$this->active_company_url.'</p>
                    </font>
                </td> 
                <td style="text-align: right;width:25%; font-size:10px;">
                    <img src="'.$this->active_company_logo.'"  height="7%" >  
                </td> 
            </tr>
        </table>
        <table border="0" style="width: 100%; font-family:arial;" >
        <tr>
    
            <td width="350" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;">
                <font style="font-size:12px;">To:</font>
                <font style="font-size:10px;">
                <p style="margin-top: 2px;"><b>' . strtoupper($client_name) . '</b></p>
                <p style="margin-top: -5px;">Contact person: ' . ucwords($contact_person) . '</p>
                <p style="margin-top: -5px;">Phone: ' . $contact_number . '</p>
                <p style="margin-top: -5px;">Email: ' . $email . '</p>
                <p style="margin-top: -5px;">Address: ' . ucwords($address) . '</p>
                '.$tin.'
                </font> 
            </td> 
            <td width="300" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;">
                <font style="font-size:11px;">
                <p style="margin-top: -5px;"><b>Quotation No.:</b> ' . $quotation['CrmQuotation']['quote_number'] . '</p>  
                <p><b>Date Created:</b> ' . date('F d, Y', strtotime($quotation['CrmQuotation']['created_at'])) . '</p>
                <p><b>Valid Till:</b> ' . $validity_date . '</p>
                <p><b>Bill To:</b> ' . $quotation['CrmQuotation']['billing_address']. '</p>
                <p><b>Ship To:</b> ' . $quotation['CrmQuotation']['shipping_address']. '</p>
                 </font>  
            </td>
        </tr>   
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p> 
    <p>&nbsp;</p>
     <p style="margin-top: -5px;padding-left:10px; font-size:12px;font-family:arial">Sir/Ma\'am</p>
     <p style="margin-top: -5px;padding-left:10px; font-size:12px;font-family:arial">We are pleased to submit our offer for your considerations as follows: </p>
    
    
    <p>&nbsp;</p> 
    <table border="0" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;font-size:12px; font-family:arial" align="center">
        <tr>
            <td align="left"  style="font-size:12px;"><b>#</b><br/><br/> <br/></td> 
            <td align="center" style="font-size:12px;"><b>Code</b> <br/><br/><br/> </td>
            <td align="center" style="font-size:12px;"><b>Product</b> <br/><br/><br/> </td>
            <td align="left"  style="font-size:12px;"><b>Description</b><br/><br/><br/> </td>
            <td align="right"  style="font-size:12px;"><b>Qty</b><br/> <br/><br/></td>
            <td align="right"  style="font-size:12px;"><b>List Price</b><br/> <br/><br/></td>
            <td   align="right"  style="font-size:12px; "> <b>Total</b><br/> <br/><br/></td>
        </tr>
        ' . implode($product_details) . '
            
     <tr>
            <td colspan="3" >  
            </td> 
            <td colspan="4" align="right">
                <table style="font-size:12px;width:250;font-family:arial    " align="right">
                    ' . $sub . '
                    ' . $install . '
                    ' . $del . '
                    ' . $dis . '
                      <tr>
                        <td style="width:50%" align="right"><b>Grand Total:</b><br/> <br/></td>
                        <td  style="text-align:right">&#8369;  ' . number_format($quotation['CrmQuotation']['grand_total'], 2) . ' </td>
                      </tr>
                    </table>
                </td> 
        </tr>
    </table> 
    </table> 
    </div>
        ');

        $this->Mpdf->AddPage('P', // L - landscape, P - portrait 
                '', '', '', '', 5, // margin_left
                5, // margin right
                15, // margin top
                30, // margin bottom
                10, // margin header
                10);
        $this->layout = 'pdf';
        $this->render('print_quote');
        $this->Mpdf->setFilename('quotation.pdf');

    }
    
    // ======================================================================
    //  PRINT JOB ORDER
    // ======================================================================
    
    public function print_jo($quotation_id) {
        $this->Mpdf->init();

        // $quotation_id = $this->params['url']['id'];

        $this->loadModel('CrmQuotation');
        $this->CrmQuotation->recursive = 2;
        $quotation = $this->CrmQuotation->findById($quotation_id);
        $this->set(compact('quotation'));
        // pr($quotation); exit;
        
        //START logs on JO
        $this->loadModel('CrmJobOrder');
        if(!$this->CrmJobOrder->findByCrmQuotationId($quotation_id)){
            $date = date('Y-m-d');
            $jo_data = ['crm_quotation_id' => $quotation_id, 'admin_id' => $this->Auth->user('id')];
            if($this->CrmJobOrder->save($jo_data)){
                if($quotation['CrmQuotation']['status'] == "MOVED"){
                    $this->CrmQuotation->id = $quotation_id;
                    $this->CrmQuotation->set(['status' => "PROCESSED"]);
                    $this->CrmQuotation->save();
                }
            }
        }
        //END logs on JO

        $this->Mpdf->SetHTMLHeader('<div style="padding-top:-15px; right:500px; font-size:10px; " align="right">' . date("F d, Y h:i A") . '</div>');
           $this->Mpdf->SetHTMLFooter(' <table style="width: 100%;padding-bottom:-15px;  ">
        <tr>
            <td style="text-align: left;width:70%;font-size:10px;">&nbsp;</td>
            <td style="text-align: right;width: 30%;font-size:10px;">{PAGENO} / {nbpg}</td> 
        </tr>
    </table> '); 
        
 
 

        /////get sales agent who created the quotation
        $prepared_by = $quotation['Admin']['name']; 


        $client_name = strtoupper($quotation['CrmCompany']['name']);
        $contact_person = strtoupper($quotation['CrmCompany']['contact_person']);
        $this->set(compact('contact_person'));
        $contact_number = strtoupper($quotation['CrmCompany']['contact_number']);
        $email = strtoupper($quotation['CrmCompany']['email']);
        $address = strtoupper($quotation['CrmCompany']['address']);
 

        ////// PRODUCT DETAILS START //////

        $this->loadModel('CrmQuotationProduct');
        $this->CrmQuotationProduct->recursive = 2;
        $quote_products = $this->getQuotationProducts($quotation_id);
        // pr($quote_products);
        // exit;

        $cnt = 1;
        $sub_total = 0;
        $product_details = [];
        foreach ($quote_products as $quote_prod) { 
            $desc_variant = '';
            foreach($quote_prod['CrmQuoteprodVariant']['ProductVariant'] as $variant){
                $desc_variant .= "<p>".$variant['attribute_name']." : ".$variant['attribute_value']."</p>";
            }
            
            $img = $this->getImage($quote_prod['Product']['id']);
            $img = json_decode($img);
            $product_details[] = '<tr>
                <td width="15" align="left">' . $cnt . '</td>
                <td width="200" align="center"><b>' . $quote_prod['Product']['code'] . '</b></td>
                <td width="120" align="center"><img class="img-responsive" src="'.$img->img.'" width="100"></td>
                <td width="300">' .$desc_variant.''. $quote_prod['CrmQuotationProduct']['description'] . '</td>
                <td width="20">' . abs($quote_prod['CrmQuotationProduct']['qty']) . '</td> ';


            $cnt++;
            $sub_total = $sub_total + $quote_prod['CrmQuotationProduct']['list_price'];
        }
 


        ////// PRODUCT DETAILS END //////

        $this->Mpdf->WriteHTML(' <div style=" top: 35px; left:18px;  font-size:10px; ">
        <table style="width: 100%; border:1px ">
        
            <tr>
                <td colspan="2" align="right">
                   <h3>Job Order</h3>
                </td> 
            </tr>
            <tr>
                <td style="text-align: left;width:35%; font-size:13px;padding-right:20px;">
                <font style="font-size:12px;">
                    <p style="margin-top: -5px;">'.$this->active_company_name.'</p> 
                        <p style="margin-top: -5px;">Tel: '.$this->active_company_number.'</p>
                    <p style="margin-top: -5px;">Email Add : '.$this->active_company_email.'</p>
                    <p style="margin-top: -5px;">'.$this->active_company_url.'</p>
                    <p style="margin-top: -5px;">JO-'.substr($quotation['CrmQuotation']['quote_number'], -4).'</p>
                    <p style="margin-top: -5px;">'.$quotation['Admin']['name'].'</p>
                    </font>
                </td> 
                <td style="text-align: right;width:25%; font-size:10px;">
                    <img src="'.$this->active_company_logo.'"  height="7%" >  
                </td> 
            </tr>
        </table>
 
    <p>&nbsp;</p>
    <p>&nbsp;</p>  
    
    <p>&nbsp;</p>
    <p>&nbsp;</p> 
    <table border="0" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;font-size:12px; " align="center">
        <tr>
            <td align="left"  style="font-size:12px;"><b>#</b><br/><br/> <br/></td> 
            <td align="center" style="font-size:12px;"><b>Code</b> <br/><br/><br/> </td>
            <td align="center" style="font-size:12px;"><b>Product</b> <br/><br/><br/> </td>
            <td align="left"  style="font-size:12px;"><b>Description</b><br/><br/><br/> </td>
            <td align="center"  style="font-size:12px;"><b>Qty</b><br/> <br/><br/></td> 
        </tr>
        ' . implode($product_details) . '
            
    
    </table> 
    </table> 
    </div>
        ');

      
        $this->layout = 'pdf';
        $this->render('print_jo');
        $this->Mpdf->setFilename($this->active_company.'-jo.pdf');

    }
    
    // ======================================================================
    //  PRINT DELIVERY REPORT
    // ======================================================================

    public function print_dr($dr_id) {
        // $dr_id = $this->params['url']['id'];
        
        $this->loadModel('CrmDeliveryReceipt');
        $this->loadModel('Admin');
        $this->loadModel('CrmCompany');
        
        $drs = $this->CrmDeliveryReceipt->findById($dr_id);
        $dr = $drs['CrmDeliveryReceipt'];
        $quotation = $drs['CrmQuotation'];
        $user = $drs['Admin'];
        $sales_agent = $drs['Admin']['name'];
        $this->set(compact('CrmDeliveryReceipt'));
        $this->set(compact('user'));
        $this->set(compact('quotation'));

        $drno = $dr['dr_number'];
        $quotation_id = $quotation['id'];
        $client_id = $quotation['crm_company_id'];
        $client_obj = $this->CrmCompany->findById($client_id);
        $client = $client_obj['CrmCompany'];
        $this->set(compact('client'));
        $client_name = strtoupper($client['name']);
        $contact_person = strtoupper($client['contact_person']);
        $this->set(compact('contact_person'));
        $contact_number = strtoupper($client['contact_number']);
        $email = strtoupper($client['email']);
        $address = strtoupper($client['address']);
        
        $prepared_by = $user['name'];
        // $agent_signature = $user['CrmEmployeeDetail']['signature'];
        // $this->set(compact('prepared_by'));
        // $this->set(compact('agent_signature'));
        
        $this->loadModel('CrmQuotationProduct');
        $this->CrmQuotationProduct->recursive = 2;
        $quote_products = $quote_products = $this->getQuotationProducts($quotation_id);
        
        $cnt = 1;
        $product_details = [];
        foreach ($quote_products as $quote_prod) {
            $desc_variant = '';
            if(array_key_exists('ProductVariant',$quote_prod_obj['CrmQuoteprodVariant'])){
                foreach($quote_prod_obj['CrmQuoteprodVariant']['ProductVariant'] as $variant){
                    $desc_variant .= $variant['attribute_name']." : ".$variant['attribute_value']."</br>";
                }
            }
            
            $img = $this->getImage($quote_prod['Product']['id']);
            $img = json_decode($img);
            $product_details[] = '<tr>
                <td width="15" align="left">' . $cnt . '</td>
                <td width="140" align="center"><b>' . $quote_prod['Product']['code'] . '</b></td>
                <td width="120" align="center"><img class="img-responsive" src="'.$img->img.'" width="100" height="100"></td>
                <td width="400">' . $desc_variant.''. $quote_prod['CrmQuotationProduct']['description'] . '</td>
                <td width="20">' . abs($quote_prod['CrmQuotationProduct']['qty']) . '</td></tr>';
            $cnt++;
        }
        
        // ==============================
        // ALL MPDF RELATED CODES
        // ==============================
        $this->Mpdf->init();
        $this->Mpdf->SetHTMLHeader('<div style="padding-top:-15px; right:500px; font-size:10px; " align="right">' . date("F d, Y h:i A") . '</div>');
        $this->Mpdf->SetHTMLFooter('<table style="width: 100%;padding-bottom:-15px;  ">
            <tr>
                <td style="text-align: left;width:70%;font-size:10px;">
                    DR #. ' . $drno . '</td>
                <td style="text-align: right;width: 30%;font-size:10px;">{PAGENO} / {nbpg}</td> 
            </tr>
        </table>');
        
        $this->Mpdf->WriteHTML('
        <div style=" top: 35px; left:18px;  font-size:10px; ">
            <table style="width: 100%; border:1px ">
                <tr>
                    <td colspan="2" align="right">
                       <h3>Delivery Receipt</h3>
                    </td> 
                </tr>
                <tr>
                    <td style="text-align: left;width:35%; font-size:13px;padding-right:20px;">
                    <font style="font-size:12px;">
                        <p style="margin-top: -5px;">'.$this->active_company_name.'</p>
                        <p style="margin-top: -5px;">Address : '.$this->active_company_address.'y</p>
                        <p style="margin-top: -5px;">Tel: '.$this->active_company_number.'</p>
                        <p style="margin-top: -5px;">Email Add : '.$this->active_company_email.'</p>
                        <p style="margin-top: -5px;">'.$this->active_company_url.'</p>
                        </font>
                    </td> 
                    <td style="text-align: right;width:25%; font-size:10px;">
                        <img src="'.$this->active_company_logo.'"  height="7%" >  
                    </td> 
                </tr>
            </table>
            
            <table border="0">
                <tr>
                    <td width="320" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;"> 
                        <font style="font-size:12px;">From:</font>
                        <font style="font-size:10px;"> 
                        <p class="marginedQuoteHeaderFirst"><b>'.$this->active_company_name.'</b></p>
                        <p style="margin-top: -5px;">' . $my_team['Team']['location'] . '</p> 
                            ' . $other_team_locations . '
                        <p style="margin-top: -5px;">' . $my_team_telephone . '</p> 
                        <p style="margin-top: -5px;"><b>Sales Executive: </b>' . $sales_agent . '</p> 
                        <p style="margin-top: -5px;"><b>Prepared By: </b>' . $prepared_by . '</p> 
                        </font><br/><br/><br/> 
                    </td>
            
                    <td width="240" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;">
                        <font style="font-size:12px;">To:</font>
                        <font style="font-size:10px;">
                        <p style="margin-top: 2px;"><b>' . $client_name . '</b></p>
                        <p style="margin-top: -5px;">Contact person:' . ucwords($contact_person) . '</p>
                        <p style="margin-top: -5px;">Phone:' . $contact_number . '</p>
                        <p style="margin-top: -5px;">Email:' . $email . '</p>
                        <p style="margin-top: -5px;">Address:' . ucwords($address) . '</p>
                        </font> 
                    </td> 
                    <td width="200" align="left" style="padding-left:10px;padding-right:10px;padding-bottom:-50px;">
                        <font style="font-size:11px;">
                        <p style="margin-top: -5px;"><b>DR #.:</b>'.$drno.'</p>  
                        <p><b>Date Created:</b> ' . date('F d, Y', strtotime($dr['created_at'])) . '</p>
                        </font>  
                    </td>
                </tr>
            </table>
            
            <br/><br/><br/><br/>
            
            <table border="0" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;font-size:12px; " align="center">
                <tr>
                    <td align="left" style="font-size:12px;"><b>#</b><br/><br/> <br/></td> 
                    <td align="center" style="font-size:12px;"><b>Code</b> <br/><br/><br/> </td>
                    <td align="center" style="font-size:12px;"><b>Product</b> <br/><br/><br/> </td>
                    <td align="left" style="font-size:12px;"><b>Description</b><br/><br/><br/> </td>
                    <td align="center" style="font-size:12px;"><b>Qty</b><br/> <br/><br/></td>
                </tr>
                '.implode($product_details).'
            </table>
        </div>
        ');
        $this->layout = 'pdf';
        $this->render('print_dr');
        $this->Mpdf->setFilename('dr.pdf');
    }
    
    public function sales($request = 0, $timeline = null, $admin_id = 0, $sd = null, $ed = null){
        $this->autoRender = false;
        $this->loadModel('CrmQuotation');
        $this->loadModel('CrmCollection');
        
        if($admin_id!=0){
            $this->loadModel('Admin');
            $userInfo = $this->Admin->findById($admin_id);
        }
        
        $table_body = '';
    
        $current_year = date("Y");
        $grand_total = 0.000000;
        $col_total = 0.000000;
        $year_contract_total = 0.000000;
        $year_contract_total_c = 0.000000;
        $year_paid_total = 0.000000;
        $quotations = [];
        $quotations_c = [];
        $title = '';
        
        if(!empty($userInfo)){
            $title .= '
            <div align="center" style="font-family:Arial; ">
                <font style="font-size:16px;color:#1a1a1a">'.$userInfo['Admin']['name'].'<font><br/>
                <font style="font-size:11px;">Quota ('.$userInfo['CrmEmployeeDetail']['quota'].')</font>
            </div>';
        }
        
        if($timeline == 'month') {
            $current_mo = date("m");
            $full_mo = date("F");
            $tbody = 'No Sales Report';
            
            if($sd == null || $ed == null){
                $options['conditions']['AND'] = ['YEAR(CrmQuotation.date_moved)' => date('Y'),
                                                'MONTH(CrmQuotation.date_moved)' => $current_mo];
                $range = $full_mo.' '.$current_year;
            } else{
                $options['conditions'] = ['DATE(date_moved) BETWEEN ? AND ?'=>[$sd, $ed]];
                $range = date("F d, Y", strtotime($sd)).' - '.date("F d, Y", strtotime($ed));
            }
            
            if($admin_id != 0){
                $options['conditions']['CrmQuotation.admin_id'] = $admin_id;
            }
            
            $options['conditions']['CrmQuotation.status'] = ['PROCESSED', 'APPROVED', 'COLLECTED'];
            $options['fields'] = ['CrmQuotation.id', 'CrmQuotation.created_at',
                                   'CrmQuotation.grand_total', 'CrmQuotation.status',
                                   'CrmQuotation.crm_company_id', 'CrmQuotation.admin_id',
                                   'CrmCompany.id', 'CrmCompany.name', 'Admin.id',
                                   'Admin.name', 'CrmQuotation.quote_number'];
            $options['order'] = 'CrmQuotation.created_at DESC';
            // $options['recursive'] = 2;
            
            $title .= '
            <div align="center" style="font-family:Arial; ">
                <font style="font-size:16px;font-weight:bold;color:#1a1a1a">Monthly Sales Report<font><br/>
                <font style="font-size:11px;">('.$range.')</font>
            </div>';
            
            $quotations = $this->CrmQuotation->find('all', $options);
            $count_monthly_quotation = 0;
            foreach($quotations as $quotation_obj) {
                $count_monthly_quotation++;
                
                $quotation = $quotation_obj['CrmQuotation'];
                $company = [];
                $agent = [];
                if(!empty($quotation_obj['CrmCompany'])) {
                    $company = $quotation_obj['CrmCompany'];
                }
                if(!empty($quotation_obj['Admin'])) {
                    $agent = $quotation_obj['Admin'];
                }
                
                $quotation_id = $quotation['id'];
                if($quotation['created_at']!="") {
                    $date_created = date("M. d, Y (h:i A)", strtotime($quotation['created_at']));
                }
                else {
                    $date_created = "<font style='color:red'>Not Specified</font>";
                }
                
                if($quotation['quote_number']!="") {
                    $quote_number = $quotation['quote_number'];
                }
                else {
                    $quote_number = "<font style='color:red'>Unknown</font>";
                }
                
                $company_name = "<font style='color:red'>Not Specified</font>";
                
                if(!empty($company)) {
                    if($company['name']!="") {
                        $company_name = $company['name'];
                    }
                }
                
                if(!empty($agent)) {
                    $full_name = $agent['name'];
    
                    if($full_name=="") {
                        $full_name = "<font style='color:red'>Unknown</font>";
                    }
                }
                else {
                    $full_name = "<font style='color:red'>Unknown</font>";
                }
                
                $contract_amount = number_format((float)$quotation['grand_total'],2,'.',',');
                $grand_total += $quotation['grand_total'];
                $date_created = date("F d, Y", strtotime($quotation['created_at']));
                
                $colls[$quotation_id] = $this->CrmCollection->find('all',
                    ['conditions'=>['CrmCollection.crm_quotation_id'=>$quotation_id,
                                    'CrmCollection.status'=>'verified'],
                                    'fields'=>['CrmCollection.paid_amount'],
                                    'recursive'=>-1]);
                $collected_amount = 0.00;
                foreach($colls[$quotation_id] as $col_obj) {
                    $col = $col_obj['CrmCollection'];
                    $collected_amount += $col['paid_amount'];
                }
                
                if($collected_amount >= floatval($quotation['grand_total'])) {
                    $contract_amount_txt = '<td style="background-color: rgba(152,251,152, 0.3);text-align:center">CLEARED</td>';
                }
                else {
                    $contract_amount_txt = '<td align="right">&#8369;  '.$contract_amount.'</td>';
                }
                
                $col_total += $collected_amount;
                $tbody .= '
                    <tr>
                        <td>'.$count_monthly_quotation.'</td>
                        <td>'.$date_created.'</td>
                        <td>'.$quote_number.'</td>
                        <td>'.$company_name.'</td>';
                        if(($this->Auth->user('job_title') == 'admin' && $admin_id == 0) || ($request == 1 && $admin_id == 0)){
                        $tbody .= '<td>'.$full_name.'</td>';
                        }
                        $tbody .= $contract_amount_txt.
                        '<td>'.$date_created.'</td>
                        <td align="right">&#8369;  '.number_format((float)$collected_amount,2,'.',',').'</td>
                    </tr>
                ';
            }
            $span = (($this->Auth->user('job_title') == 'admin' && $admin_id == 0) || ($request == 1 && $admin_id == 0)) ? 5 : 4;
            $table = '
                <table border="1" width="100%"  style="border-collapse:collapse;font-size:10px;border-color:#1a1a1a" align="center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date Created</th>
                            <th>Quotation #</th>
                            <th>Company Name</th>';
                            if(($this->Auth->user('job_title') == 'admin' && $admin_id == 0) || ($request == 1 && $admin_id == 0)){
                            $table .= '<th>Agent Name</th>';
                            }
                            $table .= '<th>Contract Amount</th>
                            <th>Date Created</th>
                            <th>Collected Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    '.$tbody.'
                    <tr>
                        <td colspan="'.$span.'" align="right"
                            style="font-weight:bold">Grand Total:</td>
                        <td align="right">&#8369;  '.number_format((float)$grand_total,2,'.',',').'</td>
                        <td colspan="2" align="right">&#8369;  '.number_format((float)$col_total,2,'.',',').'</td>
                    </tr>
                    </tbody>
                </table>
            ';
        
        }
        elseif($timeline == "year") {
            $title .= '<div align="center" style="font-family:Arial; ">
                <font style="font-size:16px;font-weight:bold;color:#1a1a1a">'.date("Y").' Sales Report<font><br/>
                <font style="font-size:11px;">Monthly Summary</p>
            </div>';
                        
            for($m=1;$m<=12;$m++) {
                $month_txt = date('F', mktime(0, 0, 0, $m, 1));
                
                            
                $options['conditions'] = ['status'=> ['PROCESSED', 'APPROVED', 'COLLECTED']];
                $options['conditions']['AND'] = ['YEAR(date_moved)' => date('Y'),
                                                'MONTH(date_moved)' => $m];
                
                if($admin_id!=0){
                    $options['conditions']['admin_id'] = $admin_id;
                }
                $options['fields'] = ['id', 'created_at', 'grand_total', 'status'];
                $options['order'] = 'date_moved DESC';
                $options['recursive'] = -1;
                
                $quotations[$m] = $this->CrmQuotation->find('all', $options);
                $options['conditions']['status'] = ['CANCELLED'];
                $quotations_c[$m] = $this->CrmQuotation->find('all', $options);         
                
                $collections = [];
                $tot_grand_total = [];
                $tot_grand_total_c = [];
                $grand_total = 0.000000;
                $grand_total_c = 0.000000;
                $total_paid_amount = 0.000000;

                $tot_grand_total[$m] = 0;
                $tot_grand_total_c[$m] = 0;
                
                foreach($quotations[$m] as $quotation_obj) {
                    $quotation = $quotation_obj['CrmQuotation'];
                    $quotation_id = $quotation['id'];
                    $grand_total += $quotation['grand_total'];
    
                    $tot_grand_total[$m] = $grand_total;
                    
                    $collections[$quotation_id] = $this->CrmCollection->find('all',
                        ['conditions'=> ['crm_quotation_id'=>$quotation_id],
                         'fields'=> ['id', 'paid_amount'],
                         'recursive'=> -1]);
                                        
                    foreach($collections[$quotation_id] as $collection_obj) {
                        $collection = $collection_obj['CrmCollection'];
                        $total_paid_amount += $collection['paid_amount'];
                    }
                }
                
                foreach($quotations_c[$m] as $quotation_obj_c) {
                    $quotation_c = $quotation_obj_c['CrmQuotation'];
                    $quotation_id_c = $quotation_c['id'];
                    $grand_total_c += $quotation_c['grand_total'];
    
                    $tot_grand_total_c[$m] = $grand_total_c;
                }
                
                $year_contract_total += $tot_grand_total[$m];
                $year_contract_total_c += $tot_grand_total_c[$m];
                $year_paid_total += $total_paid_amount;
                
                $table_body .= '
                    <tr>
                        <td width="25%" style="padding-left:70px;font-weight:bold;">'.$month_txt.'</td>
                        <td width="25%" style="padding-right:50px;" align="right">&#8369;  '.number_format((float)$tot_grand_total[$m],2,'.',',').'</td>
                        <td width="25%" style="padding-right:70px;" align="right">&#8369;  '.number_format((float)$total_paid_amount,2,'.',',').'</td>';
                        
                        if($tot_grand_total_c[$m]!=0) {
                            $table_body .= '<td width="25%" style="padding-right:70px;" align="right">&#8369;  '.number_format((float)$tot_grand_total_c[$m],2,'.',',').'</td>';
                        }
                        else {
                            $table_body .= '<td width="25%" style="padding-right:70px;" align="right">&#8369; 0.00</td>';
                        }
                $table_body .= '</tr>';
            }

            if(!empty($quotations)) {
                $grand_total_foot = '<tr>
                            <td width="25%" style="padding-left:70px;font-weight:bold;">Grand Total</td>
                            <td width="25%" style="padding-right:50px;" align="right">&#8369;  '.number_format((float)$year_contract_total,2,'.',',').'</td>
                            <td width="25%" style="padding-right:70px;font-weight:bold;" align="right">&#8369;  '.number_format((float)$year_paid_total,2,'.',',').'</td>
                            <td width="25%" style="padding-right:70px;font-weight:bold;" align="right">&#8369;  '.number_format((float)$year_contract_total_c,2,'.',',').'</td>
                        </tr>';
            }
            else { $grand_total_foot = '<tr><td colspan="4" style="padding-left:500px;">No Data</td></tr>'; }
            
            $table = '
                <table width="100%" border="1" cellpadding="1" style="border-collapse:collapse;font-size:10px;border-color:#1a1a1a" align="center">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Contract Amount</th>
                            <th>Collected Amount</th>
                            <th>Cancelled Quotations</th>
                        </tr>
                    </thead>
                    <tbody>
                        '.$table_body.'
                    
                        '.$grand_total_foot.'
                    </tbody>
                </table>
                ';
        }
        else {
            $title = '';
        }
        
        // ==============================
        // ALL MPDF RELATED CODES
        // ==============================
        $html = '
            <table style="font-family:Arial; font-size:10px;width:100%;" align="center">
                <tr>
                    <td width="45%" align="left">
                        <font style="font-weight:bold">Main Office:</font><br/>
                        '.$this->active_company_address.'<br/><br/>
                    </td>
                    <td width="55%" style="padding-left:35%">
                        <font style="font-weight:bold;">Landline:</font><br/>
                        '.$this->active_company_number.'<br/><br/>
                        <font style="font-weight:bold;">Email:</font><br/>
                        '.$this->active_company_email.'<br/><br/>
                        <font style="font-weight:bold;">Website:</font><br/>
                        '.$this->active_company_url.'
                    </td>
                </tr>
            </table>
            
            <br/>
            
            <div align="center" style="font-family:Arial; ">
                <font style="font-size:11px;">'.$title.'</p>
            </div>
            <br/>
            ';
            
        $html .= $table;
        $this->active_company_logo = ($request == 0) ? $this->active_company_logo : 'https://crm.furniturestore.ph/'.$this->active_company_logo;
        
        $header = '<img src="'.$this->active_company_logo.'" height="25">
            <div style="font-family:Arial; padding-top:-15px;padding-right:20px; font-size:10px; " align="right">' . date("F d, Y") . '</div><hr/>';
        $footer = '<hr/><table style="width: 100%;padding-bottom:-15px;">
                        <tr>
                            <td style="text-align: left;width:70%;font-size:10px;">{PAGENO} / {nbpg} </td>
                            <td style="text-align: right;width: 30%;font-size:10px;">'.$this->active_company_url.'</td> 
                        </tr>
                    </table> ';
                    
    
        if($request == 0){
            $this->Mpdf->init();
            
            $this->Mpdf->SetHTMLHeader($header);
            $this->Mpdf->SetHTMLFooter($footer);
            $this->Mpdf->AddPage('P', 
                    '', '', '', '', 8,
                    8, // margin right
                    25, // margin top
                    30, // margin bottom
                    10, // margin header
                    10);
    
            $this->Mpdf->WriteHTML($html);
            $this->layout = 'pdf';
            $this->render('sales');
            $this->Mpdf->setFilename('sales.pdf');
        }else{
            return json_encode(['html'=>$html,'header'=>$header, 'footer'=>$footer]);
        }
    }
    
    public function earnings($user_id, $request = 0) {
        $this->loadModel('CrmQuotation');
        $this->loadModel('Admin');

        $me = $this->Admin->findById($user_id);
        // $this->Quotation->recursive = 2;

        $pending_quotations = $this->CrmQuotation->find('all',[
                'conditions'=>[
                        'CrmQuotation.admin_id'=> $user_id,
                        'CrmQuotation.status'=>'PENDING'
                ]
        ]);
        $this->set(compact('pending_quotations'));
        
        $approved_quotations = $this->CrmQuotation->find('all',[
                'conditions'=>[
                        'CrmQuotation.admin_id'=> $user_id,
                        'CrmQuotation.status'=> ['MOVED','APPROVED', 'PROCESSED', 'COLLECTED']
                ]
        ]);
        $this->set(compact('approved_quotations'));

        // pr($pending_quotations);
        // pr($approved_quotations); exit;

        ////// PENDING DETAILS start //////
        $pending_details = [];
        $cntp = 1;
        $sub_total = 0;
        foreach ($pending_quotations as $pending) { 
            // pr($pending);

            $pending_details[] = '<tr>
                <td width="15" align="left">' . $cntp . '</td>
                <td width="150" align="center">' .  date('F d, Y', strtotime($pending['CrmQuotation']['created_at'])) . '</td>
                <td width="400" align="center"> ' . $pending['CrmCompany']['name'] . ' </td> 
                <td width="200" align="right">&#8369;  ' . number_format($pending['CrmQuotation']['grand_total'],2) . '</td></tr> ';


            $cntp++;
            $sub_total = $sub_total + $pending['CrmQuotation']['grand_total'];
        }
 

        ////// PENDING DETAILS END //////

        ////// approved DETAILS start //////
        $approved_details = [];
        $cnta = 1;
        $sub_totala = 0;
        foreach ($approved_quotations as $approved) { 
            // pr($pending);

            $approved_details[] = '<tr>
                <td width="15" align="left">' . $cnta . '</td>
                <td width="150" align="center">' .  date('F d, Y', strtotime($approved['CrmQuotation']['created_at'])) . '</td>
                <td width="400" align="center"> ' . $approved['CrmCompany']['name'] . ' </td> 
                <td width="200" align="right">&#8369;  ' . number_format($approved['CrmQuotation']['grand_total'],2) . '</td></tr> ';


            $cnta++;
            $sub_totala = $sub_totala + $approved['CrmQuotation']['grand_total'];
        }
 

        ////// approved DETAILS END //////

        $this->active_company_logo = ($request == 0) ? $this->active_company_logo : 'https://crm.furniturestore.ph/'.$this->active_company_logo;
        $html = ' <div style=" top: 35px; left:18px;  font-size:10px; ">
        <table style="width: 100%;">
        
            <tr>
                <td colspan="2" align="right">
                   <h3>Earnings</h3>
                </td> 
            </tr>
            <tr>
                <td style="text-align: left;width:35%; font-size:13px;padding-right:20px;">
                <font style="font-size:12px;">
                    <p style="margin-top: -5px;">'.$this->active_company_name.'</p> 
                        <p style="margin-top: -5px;">Tel: '.$this->active_company_number.'</p>
                    <p style="margin-top: -5px;">Email Add : '.$this->active_company_email.'</p>
                    <p style="margin-top: -5px;">'.$this->active_company_url.'</p> 
                    <p style="margin-top: -5px;">'.$me['Admin']['name'].'</p>
                    </font>
                </td> 
                <td style="text-align: right;width:25%; font-size:10px;">
                    <img src="'.$this->active_company_logo.'"  height="7%" >  
                </td> 
            </tr>
        </table>
  
    <h2 align="center">List of Pending Quotations</h2>
    <table border="1" cellpadding="1" cellspacing="0"  style="border-collapse:collapse;font-size:12px; " align="center">
        <tr>
            <td align="left"  style="font-size:12px;"><b>#</b><br/><br/> <br/></td> 

            <td align="center" style="font-size:12px;"><b>Date Created</b> <br/><br/><br/> </td>
            <td align="center" style="font-size:12px;"><b>Company Name</b> <br/><br/><br/> </td>
            <td align="right"  style="font-size:12px;"><b>Contract Amount</b><br/><br/><br/> </td> 
        </tr>
        ' . implode($pending_details) . '
            
        <tr>
        <td colspan="3" align="right"><b>Grand Total: </b> &nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="right"><b>&#8369;  '.number_format($sub_total,2).'</b></td>
        </tr>
    </table>  
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <h2 align="center">List of Approved Quotations</h2>
    <table border="1" cellpadding="1" cellspacing="0"  style="border-collapse:collapse;font-size:12px; " align="center">
        <tr>
            <td align="left"  style="font-size:12px;"><b>#</b><br/><br/> <br/></td> 

            <td align="center" style="font-size:12px;"><b>Date Created</b> <br/><br/><br/> </td>
            <td align="center" style="font-size:12px;"><b>Company Name</b> <br/><br/><br/> </td>
            <td align="right"  style="font-size:12px;"><b>Contract Amount</b><br/><br/><br/> </td> 
        </tr>
        ' . implode($approved_details) . '
            
        <tr>
        <td colspan="3" align="right"><b>Grand Total: </b> &nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td align="right"><b>&#8369;  '.number_format($sub_totala,2).'</b></td>
        </tr>
    </table>  
    </div>
        ';
        
        if($request == 0){
            $this->Mpdf->init();
            $this->Mpdf->WriteHTML($html);
            $this->layout = 'pdf';
            $this->render('earnings');
            $this->Mpdf->setFilename('hai-earnings.pdf');
        } else{
            $this->autoRender = false;
            return $html;
        }
    }
}