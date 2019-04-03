 
            <div class="wrapper wrapper-content">
        <div class="row">
            
                    <div class="col-lg-3"> 
                    </div> 
                    <div class="col-lg-3">
                        <!--<div class="ibox ">-->
                        <!--    <div class="ibox-title">-->
                        <!--        <h5>Quotation Status</h5>-->
                        <!--    </div>-->
                        <!--    <div class="ibox-content">-->
                        <!--        <span class="label label-success">Overall</span>-->
                        <!--        <span class="label label-success">Overall</span>-->
                        <!--        <span class="label label-success">Overall</span>-->
                        <!--        <span class="label label-success">Overall</span>-->
                        <!--        <span class="label label-success">Overall</span>-->
                                <!--<h1 class="no-margins">40 886,200</h1>-->
                                <!--<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>-->
                                <!--<small>Total income</small>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <?php $params = ($userRole == 'sales_executive') ? "/".$me : ""; ?>
                                <a href="/pdfs/sales/0/month<?php echo $params; ?>" data-toggle="tooltip" data-placement="top" title="Print Monthly Sales" target="'_blank'">
                                <span class="label label-success float-right">Monthly</span>
                                </a>
                                <h5>Income</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo number_format((float)$month[0][0]['monthly_total'], 2, '.', ','); ?></h1>
                                <div class="stat-percent font-bold text-success"><?php echo date('F'); ?></div>
                                <small>Total income</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <a href="/pdfs/sales/0/year<?php echo $params; ?>" data-toggle="tooltip" data-placement="top" title="Print Yearly Sales" target="'_blank'">
                                <span class="label label-info float-right">Annual</span>
                                </a>
                                <h5>Income</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo number_format((float)$year[0][0]['yearly_total'], 2, '.', ','); ?></h1>
                                <div class="stat-percent font-bold text-info"><?php echo date('Y'); ?></div>
                                <small>Total income</small>
                            </div>
                             
                        </div>
                    </div>
            <!--        <div class="col-lg-3">-->
            <!--            <div class="ibox ">-->
            <!--                <div class="ibox-title">-->
            <!--                    <span class="label label-primary float-right">Today</span>-->
            <!--                    <h5>visits</h5>-->
            <!--                </div>-->
            <!--                <div class="ibox-content">-->
            <!--                    <h1 class="no-margins">106,120</h1>-->
            <!--                    <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>-->
            <!--                    <small>New visits</small>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="col-lg-3">-->
            <!--            <div class="ibox ">-->
            <!--                <div class="ibox-title">-->
            <!--                    <span class="label label-danger float-right">Low value</span>-->
            <!--                    <h5>User activity</h5>-->
            <!--                </div>-->
            <!--                <div class="ibox-content">-->
            <!--                    <h1 class="no-margins">80,600</h1>-->
            <!--                    <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>-->
            <!--                    <small>In first month</small>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--</div>-->
        </div> 

  <div class="row" onload="sales_per_agent()">
        <?php foreach($users as $user): ?>
        <div class="col-lg-4">
            <div class="contact-box">
                <div class="row" >
                    <div class="col-4">
                        <div class="text-center">
                            <a class="text-primary" href="/pdfs/earnings/<?php echo $user['Admin']['id']; ?>" data-toggle="tooltip" data-placement="top" title="Print Earnings" target="_blank">
                            <img alt="image" class="rounded-circle m-t-xs img-fluid" src="/hai/avatar1.png">
                            </a>
                            <div class="m-t-xs font-bold"><?php echo $user['Admin']['job_title']; ?></div>
                            <small> 
                           <div class="m-t-xs font-bold text-info"><p>Pending: <font id="pending<?php echo $user['Admin']['id']; ?>">0</font></p></div> 
                         <div class="m-t-xs font-bold text-success"><p>Approved: <font id="approved<?php echo $user['Admin']['id']; ?>">0</font></p></div> 
                               </small> 
                        </div>
                    </div>
                    <div class="col-8">
                        <a class="text-primary" href="/pdfs/sales/0/month/<?php echo $user['Admin']['id']; ?>" data-toggle="tooltip" data-placement="top" title="Print Monthly Sales" target="_blank">
                            <h3><strong><?php echo $user['Admin']['name']; ?></strong></h3>
                        </a>
                        <a class="text-primary" href="#" id="monthly_btn" data-id="<?php echo $user['Admin']['id']; ?>" data-name="<?php echo $user['Admin']['name']; ?>" data-toggle="tooltip" data-placement="top" title="Print Sales by Date Range">
                            <p><i class="fa fa-money"></i> <?php echo date('F'); ?>:<br/> &#8369; <font id="sales_month<?php echo $user['Admin']['id']; ?>">0.00</font></p>
                        </a>
                        <h2 class="no-margins float-right">&#8369; <font id="sales_year<?php echo $user['Admin']['id']; ?>">0.00</font></h2>
                        <br/><br/>
                        <a class="text-primary" href="/pdfs/sales/0/year/<?php echo $user['Admin']['id']; ?>" data-toggle="tooltip" data-placement="top" title="Print Yearly Sales" target="_blank">
                        <small class="float-right">Yearly income  </small> 
                        </a>
                                <!--<span class="label label-info float-right">Monthly</span>-->
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>

<!--Date Range Modal Start-->
<!--===================================================-->
<div class="modal fade" id="date-range-modal" role="dialog" tabindex="-1"
     aria-labelledby="date-range-default-modal" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<!--Modal header-->
			<div class="modal-header">
			  <h4 class="modal-title">
		          Select Sales Report Range
	          </h4>
			</div>
			<!--Modal body-->
			<div class="modal-body">
				<p style="font-size:25px;" align="center">
					For <font id="sales_name"></font>
				</p>
				
			
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							Start Date
							<input type="date" class="form-control" id="start_date" />
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							End Date
							<input type="date" class="form-control" id="end_date" />
						</div>
					</div>
					<div id="monetary_body"></div>
				</div>
			</div>
			
			<!--Modal footer-->
			<div class="modal-footer">
			  <button data-dismiss="modal" class="btn btn-default"
			    type="button">Close</button>
			  <button class="btn btn-primary" id="btn_date_range">Submit</button>
			</div>
		</div>
	</div>
</div>
<!--===================================================-->
<!--Date Range Modal End-->
      
<script>
    function sales_per_agent() {
        $.ajax({
            url: '/admins/get_sales_agent/',
            type: 'GET',
            success: function (success) {
                console.log(success);
                var data_arr = JSON.parse(success);
                var month = data_arr['month'];
                var year = data_arr['year'];
    
                var users = JSON.parse('<?php echo json_encode($users); ?>');
                for(var i=0;i<users.length;i++) {
                    var user_id = users[i]['Admin']['id'];
                    if(month[user_id][0][0]['monthly_total']!=null) {
                        var monthly_total = month[user_id][0][0]['monthly_total'];
                        $("#sales_month"+user_id).text(parseFloat(monthly_total).toLocaleString('en', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                    }
                    if(year[user_id][0][0]['yearly_total']!=null) {
                        var yearly_total = year[user_id][0][0]['yearly_total'];
                        $("#sales_year"+user_id).text(parseFloat(yearly_total).toLocaleString('en', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                    }
                    if(year[user_id]['approved']!=0){
                        var approved = year[user_id]['approved'];
                        $("#approved"+user_id).text(approved);
                    }
                    if(year[user_id]['pending']!=0){
                        var pending = year[user_id]['pending'];
                        $("#pending"+user_id).text(pending);;
                    }
                }
            },
            error: function (error) {
                console.log(error);
                alert("Oops! An error occured. Please try again later.");
            }
        });
    }

    $(function(){
    	$('div[onload]').trigger('onload');
    });
    
    
    $("a#monthly_btn").on('click', function() {
		salesagent = $(this).data('id');
		var sales_name = $(this).data('name');
		$("#sales_name").text(sales_name);
		$('#date-range-modal').modal('show');
	});
	
	$("#btn_date_range").on('click', function() {
		var start_date = $("#start_date").val();
		var end_date = $("#end_date").val();
		
		if(start_date!="") {
			if(end_date!="") {
				$('#date-range-modal').modal('hide');
					window.open("/pdfs/sales/0/month/"+salesagent+
								  "/"+start_date+"/"+end_date, '_blank');
			}
			else {
				$("#end_date").css({'border-color':'red'});
			}
		}
		else {
			$('#start_date').css({'border-color':'red'});
		}
	});
</script>