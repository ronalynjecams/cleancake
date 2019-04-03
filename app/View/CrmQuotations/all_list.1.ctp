
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="/css/sweetalert.css" rel="stylesheet">
<script src="/js/sweetalert.min.js"></script>

<div class="crmQuotations index">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Crm Quotations'); ?></h1>
		</div>
	</div>

	<div class="wrapper wrapper-content">
	<div class="row">
		
		<div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><?php echo __('Crm Quotations'); ?> List</h5>
                    <div class="ibox-tools">
                    	<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Crm Quotation'), array('action' => 'add'), array('escape' => false)); ?>                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
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
				                	$quote_id = $quote['id'];
				                	$quote_created = date("F d, Y", strtotime($quote['created_at']));
				                	$company = $quotation['CrmCompany'];
				                	$company_name_tmp = $company['name'];
				                	$company_name = ($company_name_tmp != "") ? $company_name_tmp : "No Company.";
				                	$sales_exe = $quotation['Admin'];
				                	$sales_exe_name_tmp = ucwords($sales_exe['name']);
				                	$sales_exe_username = ucwords($sales_exe['username']);
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
				                	$contract_amnt = number_format((float)$quote['grand_total'],2,'.',',');
				                	
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
				                		<td><?php echo $company_name.'  <small>['.$quote['quote_number'].']</small>'; ?></td>
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
				                			
				                // 			if($userRole == 'sales_executive' || $userRole == 'sales_manager') {
				                				echo '
				                					<a href="/pdfs/print_quote/'.$quote_id.'">
				                					<button class="btn btn-default quote_action"
				                							data-toggle="tooltip"
				                							data-placement="top"
				                							title="Print Quotation">
				                						<span class="fa fa-file-pdf-o text-danger">
				                						</span>
				                					</button>
				                					</a>
				                				';
				                // 			}
				                			
				                			if($userRole == "sales_executive") {
				                				if($status == "pending") {
				                					echo '
				                					<a href="/crm_quotations/update?id='.$quote_id.'" class="btn btn-warning"
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
				                			
				                // 			if($userRole == 'sales_manager') {
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
				                // 			}
				                			
				                			if($userRole != 'sales_executive'){
				                					echo '
				                					<a href="/pdfs/print_jo/'.$quote_id.'" target="_blank">
				                					<button class="btn btn-default"
				                							data-toggle="tooltip"
				                							data-placement="top"
				                							title="Print Job Order">
				                						<span class="fa fa-file-zip-o text-danger">
				                						</span>
				                					</button>
				                				';
				                				
				                				if($quotation['CrmJobOrder']['id'] != "" && $quotation['CrmJobOrder']['sent_date'] == ""){
				                					echo '<button class="btn btn-success quote_action"
				                							 data-toggle="tooltip"
				                							 data-placement="top"
				                							 title="JO Sent"
				                							 id="btn_sent"
				                							 data-action="PROCESSED"
				                							 value="'.$quote_id.'">
				                						<span class="fa fa-telegram quote_action">
				                						</span>
				                					</button>';
				                				}
				                			}
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

</script>
