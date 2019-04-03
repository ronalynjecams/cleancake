
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="crmCollections view">
	
			<?php
			if(!empty($quotes_obj)) {
				$cli = $quotes_obj['CrmCompany'];
				$quote = $quotes_obj['CrmQuotation'];
				$user = $quotes_obj['Admin'];
				$cols = $quotes_obj['CrmCollection'];
				if(!empty($drs_obj)) {
					$drs = $drs_obj['CrmDeliveryReceipt'];
					
					if($drs['dr_type']!="") {
						$dr_type = ucwords($drs['dr_type']);
					}
					else { $dr_type = "<font style='color:red'>Not Specified</font>"; }
					
					if($drs['delivery_date']!=null) {
						$delivery_date = date("F d, Y", strtotime($drs['delivery_date']));
					}
					else { $delivery_date = "<font style='color:red'>Not Specified</font>"; }
				}
				
				$shipping_address = "";
				if($quote['shipping_address']!="") {
					$shipping_address = ucwords($quote['shipping_address']);
				}
				
				$billing_address = "";
				if($quote['billing_address']!="") {
					$billing_address = ucwords($quote['billing_address']);
				}
				
				$address_tmp = $shipping_address." ".$billing_address;
				if($address_tmp!="") {
					$address = $address_tmp;
				}
				else { $address = "<font style='color:red'>Not Specified</font>"; }
				
				$grand_total = "₱ ".number_format((float)$quote['grand_total'],2,'.',',');
				
				$bal = 0.000000;
				foreach($cols as $col) {
					$bal += $col['balance'];
					$balance = "₱ ".number_format((float)$bal,2,'.',',');
				}
				
				$client_name_tmp = $cli['name'];
				
				if($client_name_tmp!=null) { $client_name = ucwords($client_name_tmp); }
				else { $client_name = "<font style='color:red'>Not Specified</p>"; }
				
				if($cli['contact_person']!="") {
					$contact_person = ucwords($cli['contact_person']);
				}
				else { $contact_person = "<font style='color:red'>Unknown</font>"; }
				
				if($cli['contact_number']!="") {
					$contact_number = $cli['contact_number'];
				}
				else { $contact_number = "<font style='color:red'>Not Specified</font>"; }
				
				if($cli['email']!="") {
					$email = $cli['email'];
				}
				else { $email = "<font style='color:red'>Not Specified</font>"; }
				
				$quote_number = "";
				if($quote['quote_number']!=null) {
					$quote_number = $quote['quote_number'];
				}
				
				if($quote['subject']!="") {
					$subject = ucfirst($quote['subject']);
				}
				else {
					$subject = "<font style='color:red'>No Subject</font>";
				}
				
				if($quote['status']!="") { $status = $quote['status']; }
				else { $status = "<font style='color:red'>Undefined</font>"; }
				
				$created_by_tmp = ucwords($user['name']);
				if($created_by_tmp != "") { $created_by = $created_by_tmp; }
				else {
					if($user['name']!="") {
						$created_by = $user['name'];
					}
					else {
						$created_by = "<font style='color:red'>Unknown</font>";
					}
				}
				
				if($quote['created_at']!=null) {	
					$date_created = date("F d, Y", strtotime($quote['created_at']));
				}
				else { $date_created = "<font style='color:red'>Not Specified</font>"; }
				
				$raw_validity_date = $quote['validity_date'];
		        if($raw_validity_date!="" && $raw_validity_date!=null && $raw_validity_date!="0000-00-00") {
					$val_date = date("F d, Y", strtotime($quote['validity_date']));
				}
				else {
		            $date_createds = new DateTime($quote['created_at']);
		            date_add($date_createds,date_interval_create_from_date_string("30 days"));
		            $val_date = date_format($date_createds,"F d, Y");
				}
				?>
	
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<div class="row">
                <div class="col-lg-6">
					<h2><?php echo $client_name; ?></h2>
				</div>
				<div class="col-lg-6" align="right">
					<h2>
					<?php echo $quote_number; ?>
					<?php if($quote['status'] == 'PROCESSED'){ ?>
						&nbsp;&nbsp;<a href="/crm_collections/update?id=<?php echo $quote['id']; ?>" class="btn btn-sm btn-info">Update Collection</a>
					<?php } ?>
					<?php if($quote['status'] == 'PENDING' && $userRole == "sales_executive"){ ?>
						&nbsp;&nbsp;<a href="#" id="moveQuotation" data-quotationid="<?php echo $quote['id']; ?>" data-action="moved" class="btn btn-sm btn-info">Move to Purchasing</a>
						&nbsp;&nbsp;<a href="/crm_quotations/quote/update/<?php echo $quote['id']; ?>" class="btn btn-sm btn-primary">Update</a>
					<?php  
					}?>
						<?php if($quote['status'] != 'PENDING' && $userRole != "sales_executive"){ ?>
						<!--&nbsp;&nbsp;<a href="/collections/update?id=<?php echo $quote['id']; ?>" class="btn btn-xs btn-info">Move to Purchasing</a>-->
						&nbsp;&nbsp;<a href="/crm_quotations/quote/update/<?php echo $quote['id']; ?>" class="btn btn-sm btn-primary">Update</a>
					<?php  
					}
					elseif($userRole != "sales_executive" && $quote['status'] != 'PENDING'){?>
						&nbsp;&nbsp;<a href="/crm_collections/update?id=<?php echo $quote['id']; ?>" class="btn btn-sm btn-info">Collect</a>
				<?php } ?>
				</h2>
				</div>
				</div>
		</div>
	</div>
	
	<div class="wrapper wrapper-content">
	
	<div class="row">
		<div class="col-md-6">
		<div class="ibox">
			<div class="ibox-content">
				<div class="row">
					<div class="col-md-6">
					<h5>Quotation Information</h5>
						<div class="row">
							<div class="col-lg-6">
								<p>
									<font style="font-weight:bold">Subject:</font>
									<?php echo $subject; ?>
								</p>
								<p>
									<font style="font-weight:bold">Status:</font>
									<?php echo $status; ?>
								</p>
								<p>
									<font style="font-weight:bold">Created By:</font>
									<?php echo $created_by; ?>
								</p>
							</div>
							<div class="col-lg-6">
								<p>
									<font style="font-weight:bold">Date Created:</font>
									<?php echo $date_created; ?>
								</p>
								<p>
									<font style="font-weight:bold">Validity Date:</font>
									<?php echo $val_date; ?>
								</p>
							</div>
						</div>
						<p style="font-weight:bold">Client</p>
						<div class="row">
							<div class="col-lg-6">
								<p>
									<font style="font-weight:bold">Contact Person:</font>
									<?php echo $contact_person; ?>
								</p>
								<p>
									<font style="font-weight:bold">Contact Number:</font>
									<?php echo $contact_number; ?>
								</p>
							</div>
							<div class="col-lg-6">
								<p>
									<font style="font-weight:bold">Email Address:</font>
									<?php echo $email; ?>
								</p>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
		</div>
		
		<div class="col-md-6">
		<div class="ibox">
			<div class="ibox-content">
			<?php if(!empty($col)) { ?>
				<h5>Collection Details</h5>
				<div class="row">
					<div class="col-lg-12" > 
						<p align="left" style="font-weight:bold">
							Total Contract Price:
						</p> 
						<div  align="left">
							<p style="padding-left:50px"><?php echo $grand_total; ?></p>
							<?php if($balance == 0){?>
							<p class="text-danger" style="font-weight:bold"> Balance </p>
							<p style="padding-left:50px" class="text-danger">
								<?php echo $balance; ?>
							</p>
							<?php } ?>
						</div>  
					</div>
				</div>
			<?php } ?>
			<?php if(!empty($drs_obj)) { ?>
				<h5>Delivery / Billing Info</h5>
				<div class="row">
					<div class="col-md-6">
						<p>
							<font style="font-weight:bold">
								Delivery Mode:
							</font>
							<?php echo $dr_type; ?>
						</p>
						<p>
							<font style="font-weight:bold">
								Billing and Shipping Address:
							</font>
						</p>
						<?php echo $address; ?>
					</div>
					<div class="col-md-6">
						<p>
							<font style="font-weight:bold">
								Tentative Delivery or Pickup Date:
							</font>
							<?php echo $delivery_date; ?>	
						</p>
					</div>
				</div>
			<?php } ?>
			</div>
		</div>
		</div>
	</div>
		
	
	<div class="row">
		<div class="col-md-12">
            <div class="ibox">
			<div class="ibox-content">
				<h5>Products Info</h5>
				<div class="table-responsive">
					<table class="table table-striped ">
			            <thead>
			                <tr>
			                	<th>#</th>
			                	<th>Product Name</th>
			                	<th>Description</th>
			                	<th>Quantity</th>
			                	<th>List Price</th>
			                	<th>Total Price</th>
			                </tr>
			            </thead>
			            
			            <tbody>
				            <?php
				            $count = 0;
				            foreach($quote_prods as $quote_prod_obj) {
				            	$count++;
					            $quote_prod = $quote_prod_obj['CrmQuotationProduct'];
					            $product = $quote_prod_obj['Product'];
					            
					            $desc_variant = '';
					            if(array_key_exists('ProductVariant',$quote_prod_obj['CrmQuoteprodVariant'])){
			                        foreach($quote_prod_obj['CrmQuoteprodVariant']['ProductVariant'] as $variant){
			                            $desc_variant .= $variant['attribute_name']." : ".$variant['attribute_value']."</br>";
			                        }
					            }
					            
					            if($product['code']!="") {
					            	$name = ucwords($product['code']);
					            }
					            else {
					            	$name = "<font style='color:red'>Not Specified</font>";
					            }
					            
					            if($quote_prod['description']!="") {
					            	$des = $desc_variant.''.ucfirst($quote_prod['description']);
					            }
					            else {
					            	$des = "<font style='color:red'>No Description</font>";
					            }
					            
					            echo '
					            	<tr>
					            		<td>'.$count.'</td>
					            		<td>'.$name.'</td>
					            		<td>'.$des.'</td>
					            		<td>'.$quote_prod_obj['CrmQuotationProduct']['qty'].'</td>
					            		<td>&#8369; '.$quote_prod_obj['CrmQuotationProduct']['list_price'].'</td>
					            		<td>&#8369; '.$quote_prod_obj['CrmQuotationProduct']['total_price'].'</td>
					            	</tr>
					            ';
				            }
			            	?>
			            	
			            	 <tr>
                                <td colspan="4" align="right"> </td> 
                                <td align="right">Sub Total</td> 
                                <td align="right"> &#8369; <?php echo number_format($quotes_obj['CrmQuotation']['sub_total'],2); ?>  </td>
                               
                            </tr>
                            
                            <tr>
                                <td colspan="4" align="right"> </td> 
                                <td align="right">Discount</td>
                                <td align="right">&#8369; <?php echo number_format($quotes_obj['CrmQuotation']['discount'],2);?></td>
                            </tr>
                            
                            <tr>
                                <td colspan="4" align="right"> </td> 
                                <td align="right">Delivery</td> 
                                <td align="right">&#8369; <?php echo number_format($quotes_obj['CrmQuotation']['delivery_amount'],2); ?> </td>
                            </tr>
                            
                            <tr>
                                <td colspan="4" align="right"> </td> 
                                <td align="right">Installation</td> 
                                <td align="right"> &#8369; <?php echo number_format($quotes_obj['CrmQuotation']['installation_amount'],2); ?>  </td>
                                
                            </tr>
                              
                            <tr>
                                <td colspan="4" align="right"> </td> 
                                <td>Grand Total</td> 
                                <td align="right">&#8369;  <?php echo number_format($quotes_obj['CrmQuotation']['grand_total'],2);?>  </td> 
                            </tr> 
			            </tbody>
			        </table>
			    </div>
		<?php
			}
			else {
				echo "<h4>Quotation Not Found.</h4>";
			}
		?>
			</div>		
			</div>
		</div>
	</div>
	
	</div>

<script src="/js/plugins/dataTables/datatables.min.js"></script>
<script src="/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]

        });
        
        $("#moveQuotation").click(function () {
	        var action = $(this).data('action');
	        var quote_id  = $(this).data('quotationid');
	        var data = {"id":quote_id, "action":action};
	        swal({
	            title: "Are you sure?",
	            text: "This quotation will be "+action+".",
	            type: "warning",
	            showCancelButton: true,
	            confirmButtonClass: "btn-danger",
	            confirmButtonText: "Yes",
	            cancelButtonText: "No",
	            closeOnConfirm: false,
	            closeOnCancel: true
	        },
	        function (isConfirm) {
	            if (isConfirm) {
	                $.ajax({
	        			url: '/crm_quotations/action',
	            		type: 'POST',
	            		data: {"data": data},
	            		dataType: 'text',
	            		success: function(msg) {
	            			console.log(msg);
	            			swal({
	        		            title: "Success!",
	        		            text: "Quotation was "+action+".",
	        		            type: "success"
	        		        },
	        		        function (isConfirm) {
	        		            if (isConfirm) { location.href = '/crm_quotations/all_list?status=moved&&type=<?php echo $quote['inquiry_id'] ?>'; }
	        		        });
	            		},
	            		error: function(error) {
	            			console.log("Error: "+error);
	            			swal({
	        		            title: "Oops!",
	        		            text: "Something went wrong while quotation was being "+action+". Please try again.",
	        		            type: "warning"
	        		        });
	            		}
	            	});	
	            }
	        });
	    });

    });

</script>