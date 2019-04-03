<div class="crmDeliveryReceipts form">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Create Delivery Receipt'); ?></h1>
		</div>
	</div>

	<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox">
			<div class="ibox-title">
                <h5>&nbsp</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<input type="hidden" id="quotation" value="<?php echo $quotation; ?>"/>
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
					
				</div>
				<div id='amountcode'>
					<div id='amountcodeval'>
						<input type="hidden" id="input_amount" value="0"/>
						<input type="hidden" id="input_booking_code" value="0"/>
					</div>
				</div>
				<div class="form-group">
					<button class="btn btn-info" id="btn_add">
						<span class="fa fa-plus"></span>
						Add
					</button>
				</div>
			</div>
		</div>
		</div><!-- end col md 12 -->
	</div>
	</div><!-- end row -->
</div>


<script type="text/javascript">

$(document).ready(function() {
	$("#select_type").change(function () {
		$("#type").remove();
		$("#amountcodeval").remove();
		var type = $("#select_type").val();
		var newDiv = $(document.createElement('div'))
	         .attr("id", 'type');
		if(type == 'transportify'){
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
		}else{
			newDiv = $(document.createElement('div'))
	         .attr("id", 'amountcodeval');
			newDiv.after().html('<input type="hidden" id="input_amount" value="0"/>'+
						'<input type="hidden" id="input_booking_code" value="0"/>');
		
		    newDiv.appendTo("#amountcode");
		}
	});
	
	$("#btn_add").on('click', function() {
		var quotation = $("#quotation");
		var dr_number = $("#input_dr_number");
		var date = $("#input_date");
		var type = $("#select_type");
		var amount = $("#input_amount");
		var booking_code = $("#input_booking_code");
		
		if(date.val()!="") {
			if(type.val()!="--- Select Type ---") {
				if(amount.val()!="") {
					if(booking_code.val()!="") {
						var data = {"quotation": quotation.val(),
									"date": date.val(),
									"type": type.val(),
									"amount": amount.val(),
									"booking_code": booking_code.val(),
									"status": "<?php echo $status; ?>"
						};
									
						$.ajax({
							url: '/crm_delivery_receipts/create',
							type: 'POST',
							data: {'data': data},
							dataType: 'text',
							success: function(id) {
								console.log(id);
								location.href = "/crm_quotations/all_list?status=<?php echo $status; ?>&&type=<?php echo $type; ?>";
							},
							error: function(error) {
								console.log("Error in delivery_receipts: "+error);
								swal({
	                                title: "Error!",
	                                text: "Something went wrong with creating Delivery Receipts. Please try again.",
	                                type: "warning",
	                                confirmButtonClass: "btn-danger",
	                                confirmButtonText: "Okay",
	                                closeOnConfirm: false,
	                            });
							}
						});
					}
					else {
						booking_code.css({'border-color':'red'});
					}
				}
				else {
					amount.css({'border-color':'red'});
				}
			}
			else {
				type.css({'border-color':'red'});
			}
		}
		else {
			date.css({'border-color':'red'});
		}
	});
});
</script>