
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="/css/sweetalert.css" rel="stylesheet">
<script src="/js/sweetalert.min.js"></script>

<div class="crmQuotations index">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Quotations'); ?></h1>
		</div>
	</div>

	<div class="wrapper wrapper-content">
	<div class="row">
		
		<div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><?php echo __('Quotations'); ?> List</h5>
                </div>
                <div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example">
							<thead>
				                <tr>
				                	<th>Date Created</th>
				                	<th>Company name [Quotation #]</th>
				                	<?php if($userRole != "sales_executive") { ?>
				                	<th>Sales Executive</th>
				                	<?php } ?>
				                	<th>Contract Amount</th>
				                	<th>Collected Amount</th>
				                	<th>Action</th>
				                </tr>
				            </thead>
				            <tbody>
							<?php
				                foreach($quotations as $quotation) {
				                	$quote = $quotation['CrmQuotation'];
				                	$jo = $quotation['CrmJobOrder'];
				                	$delivery = $quotation['CrmDeliveryReceipt'];
				                	$quote_id = $quote['id'];
				                	$quote_created = date("F d, Y", strtotime($quote['created_at']));
				                	$company = $quotation['CrmCompany'];
				                	$company_name_tmp = $company['name'];
				                	$company_name = ($company_name_tmp != "") ? $company_name_tmp : "No Company.";
				                	$sales_exe = $quotation['Admin'];
				                	$sales_exe_name_tmp = ucwords($sales_exe['name']);
				                	$sales_exe_username = ucwords($sales_exe['username']);
				                	$quote_info = "";
				                	
				                	if($quote['status'] != 'pending' || $quote['status'] != 'ongoing'){
				                		if($quote['date_moved'] != ''){
			                				$quote_info .= "<br /><small><strong>Date Moved:</strong> ".date("F d, Y [h:i a]", strtotime($quote['date_moved'])).'</small><br/>';
			                			}
			                			if($jo['id'] != ""){
				                			$quote_info .= "<small><strong>JO date created:</strong> ".date("F d, Y [h:i a]", strtotime($jo['created_at'])).'</small><br/>';
				                		}
				                		if($jo['id'] != "" && $jo['sent_date'] != ""){
				                			$quote_info .= "<small><strong>JO sent date:</strong> ".date("F d, Y [h:i a]", strtotime($jo['sent_date'])).'</small><br/>';
				                		}
				                		if($quote['collection_date'] != ''){
				                			$quote_info .= "<small><strong>Date paid:</strong> ".date("F d, Y [h:i a]", strtotime($quote['collection_date'])).'</small><br/>';
				                		}
				                	}
				                	
				                	if($sales_exe_name_tmp != "") {
				                		$sales_exe_name = $sales_exe_name_tmp;
				                	}
				                	else {
				                		if($sales_exe_username!="") {
				                			$sales_exe_name = $sales_exe_username;
				                		}
				                		else {
					                		$sales_exe_name = "No Sales Executive.";
				                		}
				                	}
				                	$grand_total = $quote['grand_total'];
				                	$contract_amnt = number_format((float)$grand_total,2,'.',',');
				                	
				                	$paid_amount = 0.000000;
				                	$ewt_amount = 0.000000;
				                	$other_amount = 0.000000;
				                	$col_obj = $cols_obj[$quote_id];
				                	foreach($col_obj as $cols) {
				                		$col = $cols['CrmCollection'];
					                	$paid_amount += $col['paid_amount'];
					                	$ewt_amount += $col['ewt_amount'];
					                	$other_amount += $col['other_amount'];
				                	}
				                	$total_tmp = $paid_amount + $ewt_amount + $other_amount;
				                	$total = number_format((float)$total_tmp,2,'.',',');
				                	?>	
				                	<tr>
				                		<td><?php echo $quote_created; ?></td>
				                		<td><?php echo $company_name.'  <small>['.$quote['quote_number'].']</small> ';  
				                			if($quote_info != ""){
				                				echo '<button class="btn btn-success btn-circle btn-xs btn-outline"
				                							 data-toggle="tooltip"
				                							 data-placement="top"
				                							 title="Quotation Info"
				                							 onclick="showQuoteInfo(\''.$quote_info.'\')">
				                						<i class="fa fa-info">
				                						</i>
				                					</button>';
				                			}?>
				                		</td>
				                		<?php if($userRole != "sales_executive") {
				                			echo '<td>'.$sales_exe_name.'</td>';
				                		} ?>
				                		<td align="right">	&#8369; <?php echo $contract_amnt; ?></td>
				                		<td align="right">	&#8369; <?php echo $total; ?></td>
				                		<td>
				                			<a href="/crm_collections/view?id=<?php echo $quote_id; ?>">
				                			<button class="btn btn-info"
				                					id="btn_view"
				                					data-toggle="tooltip"
				                					data-placement="top"
				                					title="View Quotation">
				                				<span class="fa fa-eye"></span>
				                			</button>
				                			</a>
				                			
				                			<?php
				                			
				                			if($userRole != "sales_executive") {
				                				echo '
			                						<a href="/crm_quotations/quote/update/'.$quote_id.'" class="btn btn-warning"
			                							 data-toggle="tooltip"
			                							 data-placement="top"
			                							 title="Update"   >
				                						<span class="fa fa-edit">
				                						</span>
				                					</a>';	
				                			}
			                				echo '
			                					<a href="/pdfs/print_quote/'.$quote_id.'">
			                					<button class="btn btn-default"
			                							data-toggle="tooltip"
			                							data-placement="top"
			                							title="Print Quotation">
			                						<span class="fa fa-file-pdf-o text-danger">
			                						</span>
			                					</button>
			                					</a>
			                				';
			                				
				                			if($userRole == "sales_executive") {
				                				if($status == "pending") {
				                					echo '
				                					<a href="/crm_quotations/quote/update/'.$quote_id.'" class="btn btn-warning"
				                							 data-toggle="tooltip"
				                							 data-placement="top"
				                							 title="Update"   >
				                						<span class="fa fa-edit">
				                						</span>
				                					</a>
				                					<button class="btn btn-primary quote_action"
				                							 data-toggle="tooltip"
				                							 data-placement="top"
				                							 title="Move"
				                							 id="btn_move"
				                							 data-action="MOVED"
				                							 value="'.$quote_id.'">
				                						<span class="fa fa-share-square-o quote_action">
				                						</span>
				                					</button>
				                					';
				                				}
				                			}
				                			
				                			if($userRole == 'sales_manager'
				                			|| $userRole == 'admin') {
				                				if($status=="moved") {
					                				echo '
					                					<button class="btn btn-success quote_action"
					                							 data-toggle="tooltip"
					                							 data-placement="top"
					                							 title="Approve"
					                							 id="btn_approve"
					                							 data-action="APPROVED"
					                							 value="'.$quote_id.'">
					                						<span class="fa fa-check quote_action">
					                						</span>
					                					</button>
					                				';
				                				}
				                			}
				                			if($status!='pending'){
			                					if((float)$total_tmp  < (float)$grand_total){
				                					echo '<a href="/crm_collections/update?id='.$quote['id'].'" data-toggle="tooltip"
				                							 data-placement="top"
				                							 title="Update Collection" class="btn btn-default"><i class="fa fa-money">
				                						  </i></a>';
				                				}
				                			}
				                			
				                			if($userRole != 'sales_executive'){
				                				if($status!='pending'){
				                					echo '
					                					<a href="/pdfs/print_jo/'.$quote_id.'" target="_blank">
					                					<button class="btn btn-default"
					                							data-toggle="tooltip"
					                							data-placement="top"
					                							title="Print Job Order">
					                						<span class="fa fa-file-zip-o text-danger">
					                						</span>
					                					</button></a>
					                				';
					                				if($jo['id'] != "" && $jo['sent_date'] == ""){
					                					echo '<button class="btn btn-success"
					                							 data-toggle="tooltip"
					                							 data-placement="top"
					                							 title="JO Sent"
					                							 onclick="joSent('.$quote_id.')"
					                							 >
					                						<span class="fa fa-telegram">
					                						</span>
					                					</button>';
					                				}			         
					                				if(empty($delivery)){
					                					echo '<a href="/crm_delivery_receipts/add?id='.$quote_id.'&&status='.$status.'&&type='.$quote['inquiry_id'].'" class="btn btn-default"><i class="fa fa-truck">
					                						  </i></a>';
					                				}
					                				echo '
					                					<button class="btn btn-danger quote_action"
					                							 data-toggle="tooltip"
					                							 data-placement="top"
					                							 title="Cancel"
					                							 id="btn_cancel"
					                							 data-action="CANCELLED"
					                							 value="'.$quote_id.'">
					                						<span class="fa fa-times quote_action">
					                						</span>
					                					</button>
					                				';
				                				}
				                				if($status == 'approved') {
				                					echo '
					                					<button class="btn btn-danger quote_action"
					                							 data-toggle="tooltip"
					                							 data-placement="top"
					                							 title="Process"
					                							 id="btn_process"
					                							 data-action="PROCESSED"
					                							 value="'.$quote_id.'">
					                						<span class="fa fa-refresh quote_action">
					                						</span>
					                					</button>
					                				';
				                				}
				                			}
				                			
				                			// echo ($quote_info != "") ? $quote_info : "";
				                			?>
				                		</td>
				                	</tr>
				                	<?php
				                }
				                ?>
				            </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>	

<script src="/js/jquery-3.1.1.min.js"></script>
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
                {extend: 'excel', title: 'Quotation'},
                {extend: 'pdf', title: 'Quotation'},

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
        
        $(document).on('click', function(e) {
        	var target = $(e.target);
        	var button_span = $(e.target).prop('class');
        	var action = "";
        	var isOkay = false;
        	console.log(button_span+' else');
       		console.log(button_span.indexOf("quote_action"));
       		if(button_span.indexOf("quote_action") >= 0) {
    			var button = target.closest('button');
    			var quote_id = button.val();
	        	action = button.data('action');
	        	var data = {"id":quote_id, "action":action};
	        	isOkay = true;
	        	
    		}
    		else {
    			isOkay = false;
    		}
			
			if(isOkay) {
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
						            if (isConfirm) { location.reload(); }
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
			}
        });


		
    });
    
    function joSent(quote_id){
    	swal({
            title: "Are you sure?",
            text: "JO already sent?",
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
        			url: '/crm_job_orders/joSent/'+quote_id,
	        		type: 'POST',
	        		dataType: 'text',
	        		success: function(msg) {	
	        			location.reload(); 
	        		},
	        		error: function(error) {
	        			console.log("Error: "+error);
	        			swal({
				            title: "Oops!",
				            text: "Something went wrong while updating JO. Please try again.",
				            type: "warning"
				        });
	        		}
	        	});	
            }
        });
    }
    
    function showQuoteInfo(info){
        swal({
            title: "",
            html: true,
            text: info,
            type: "info"
        });
    }
    
</script>
