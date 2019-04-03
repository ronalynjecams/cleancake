
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="crmCompanies index">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
            <h2>Delivery Receipt List</h2>
		</div>
	</div>

	<div class="wrapper wrapper-content">
	<div class="row">
		
		<div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example">
							<thead>
                                <tr>
                                    <th>Date Created</th>
                                    <th>Company Name</th>
                                    <th>DR Number</th>
                                    <th>DR Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
							<tbody>
                                <?php
                                foreach($drs as $dr_obj) {
                                    $dr = $dr_obj['CrmDeliveryReceipt'];
                                    $dr_id = $dr['id'];
                                    $dr_created = date("F d, Y", strtotime($dr['created_at']));
                                    $dr_quotation_id = $dr['crm_quotation_id'];
                                    $dr_number = $dr['dr_number'];
                                    $dr_type = ucwords($dr['dr_type']);
                                    
                                    $company_name = "No company.";
                                    if(!empty($companies[$dr_quotation_id]['CrmCompany'])) { 
                                        $company = $companies[$dr_quotation_id]['CrmCompany'];
                                        $company_name_tmp = ucwords($company['name']);
                                        if($company_name_tmp!="") {
                                            $company_name = $company_name_tmp;
                                        }
                                    }
                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $dr_created; ?></td>
                                        <td><?php echo $company_name; ?></td>
                                        <td><?php echo $dr_number; ?></td>
                                        <td><?php echo $dr_type; ?></td>
                                        <td>
                                            <a href="/pdfs/print_dr/<?php echo $dr_id; ?>">
                                                <button class="btn btn-default"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Print DR">
                                                    <span class="fa fa-file-powerpoint-o text-danger">
                                                    </span>
                                                </button>
                                            </a>
                                            <?php
                                            if($userRole == "sales_manager" ||
                                                $userRole == "admin") {
                                                    
                                                if($status == "pending") {
                                                    echo '
                                                    <button class="btn btn-warning"
                                                            data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="Deliver"
                                                            id="btn_deliver"
                                                            data-action="delivered"
                                                            value="'.$dr_id.'">
                                                        <span class="fa fa-truck">
                                                        </span>
                                                    </button>
                                                    
                                                    <button class="btn btn-danger"
                                                            data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="Cancel"
                                                            id="btn_cancel"
                                                            data-action="cancelled"
                                                            value="'.$dr_id.'">
                                                        <span class="fa fa-close">
                                                        </span>
                                                    </button>
                                                    ';
                                                    
                                                    echo '<button class="btn btn-default update_booking_btn" data-id="' . $dr_id . '"><i class="fa fa-edit"></i></button>';
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

<!--update modal-->

<div class="modal" id="update_modal" role="dialog" tabindex="-2"  aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Update Delivery Details</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="update_dr_id">
                
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<input type="date" class="form-control" id="input_date"
								   placeholder="Delivery Date" />
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<select class="form-control" id="select_type">
								<option>--- Select Type ---</option>
								<option value="transportify">Transportify</option>
								<option value="jecams">Jecams</option>
								<option value="pickup">Pickup</option>
							</select>
						</div>
					</div>
				</div>
				<div id="deliveryType">
				    <div id="type">
        				<div class="row">
        				    <div class="col-lg-6">
        						<div class="form-group">
        							<input type="number" step="any" id="input_amount" placeholder="Amount" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
        						</div>
        					</div>
        					<div class="col-lg-6">
        						<div class="form-group">
        							<input type="number" step="any" id="input_booking_code" class="form-control" placeholder="Booking Code" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
        						</div>
        					</div>
        				</div>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                <button type="button" class="btn btn-primary updateBookingBtn"  >Update</button>  
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

        $("#select_type").change(function () {
    		$("#type").remove();
    		var type = $("#select_type").val();
    		
    		if(type == 'transportify'){
    		    createNewDiv();
    		}
    	});	
    	
    	$(".update_booking_btn").each(function () {
            $(this).on("click", function () {
                var id = $(this).data('id'); //this line gets value of data-id from delete button
                $('#update_dr_id').val(id); // this line passes the value from data id to modal, to be able to manipulate id of the selected row
                $('#update_modal').modal('show'); // this line shows modal, make sure to assign values first before showing modal
    
                $.get('/crm_delivery_receipts/get_info', {
                    id: id,
                }, function (data) { 
                    if(data['dr_type'] != "transportify"){
                    $("#type").remove();
                    }
                    $('#input_booking_code').val(data['booking_code']);
                    $('#select_type').val(data['dr_type']);
                    $('#input_amount').val(data['amount']);
                    $('#input_date').val(data['delivery_date']);
                });
            });
        });
    
    
        function createNewDiv(){
            var newDiv = $(document.createElement('div'))
                         .attr("id", 'type');
    	    newDiv.after().html('<div class="row"><div class="col-lg-6">'+
    							'<div class="form-group">'+
    								'<input type="number" step="any" id="input_amount" placeholder="Amount" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />'+
    							'</div>'+
    						'</div>'+
    						'<div class="col-lg-6">'+
    							'<div class="form-group">'+
    								'<input type="number" step="any" id="input_booking_code" class="form-control" placeholder="Booking Code" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />'+
    							'</div>'+
    						'</div></div>');
    	
    	    newDiv.appendTo("#deliveryType");
        		
        }
        
        $('.updateBookingBtn').on("click", function () {
            var ubooking_code = $('#input_booking_code').val(); 
            var utype = $('#select_type').val(); 
            var uamount = $('#input_amount').val(); 
            var dr_id = $("#update_dr_id").val();
            var udate = $("#input_date").val();
            if ((utype != "")) { 
                var data = {
                    "ubooking_code": ubooking_code,
                    "utype": utype,
                    "uamount": uamount,
                    "udate": udate,
                    "dr_id": dr_id
                }
                $.ajax({
                    url: "/crm_delivery_receipts/update_booking_process",
                    type: 'POST',
                    data: {'data': data},
                    dataType: 'json',
                    success: function (id) {
                        location.reload();
                    }
                });
                } else {
                    document.getElementById('utype').style.borderColor = "red";
                }
                        
        });
        
        $("button#btn_cancel, button#btn_deliver").on('click', function() {
            var id = $(this).val();
            var action = $(this).data('action');
            var data = {"id":id, "action":action};
            
            swal({
	            title: "Are you sure?",
	            text: "This Delivery Receipt will be "+action+".",
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
	        			url: '/crm_delivery_receipts/action',
		        		type: 'POST',
		        		data: {"data": data},
		        		dataType: 'text',
		        		success: function(msg) {
		        			console.log(msg);
		        			swal({
					            title: "Success!",
					            text: "Delivery Receipt was "+action+".",
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
					            text: "Something went wrong while Delivery Receipt was being "+action+". Please try again.",
					            type: "warning"
					        });
		        		}
		        	});	
	            }
	        });
        });
    });

</script>
