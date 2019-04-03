<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="crmCompanies index">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
            <h2>Collection List</h2>
		</div>
	</div>

	<div class="wrapper wrapper-content">
	<div class="row">
		
		<div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <?php
					if($undefined=="") { ?>
                    <div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example">
				            <thead>
				                <tr>
				                    <th>Date Created</th>
				                    <th>Client</th>
				                    <th>Contract Amount</th>
				                    <th>Balance</th>
				                    <th>Action</th>
				                </tr>
				            </thead>
				            <tbody>
				            	<?php
				            	foreach($cols as $col_obj) {
				            		$col = $col_obj['CrmCollection'];
				            		$quote = $col_obj['CrmQuotation'];
				            		$quote_id = $col['crm_quotation_id'];
				            		
				            		$col_id = $col['id'];
				            		if($col['created_at']!=null) {
					            		$date = date("F d, Y", strtotime($col['created_at']));
				            		}
				            		else {
				            			$date = "No Date Specified.";
				            		}
				            		
				            		foreach($clients[$quote_id] as $client_obj) {
				            			$client_name_tmp = ucwords($client_obj['name']);
				            			if($client_name_tmp!="") {
				            				$client_name = $client_name_tmp;
				            			}
				            			else {
				            				$client_name = "No Client Specified.";
				            			}
				            		}
				            		
				            		$contract_amount = "₱ ".number_format((float)$quote['grand_total'],2,'.',',');
				            		$balance = "₱ ".number_format((float)$col['balance'],2,'.',',');
				            		
				            		echo '
				            			<tr>
				            				<td>'.$date.'</td>
				            				<td>'.$client_name.'</td>
				            				<td>'.$contract_amount.'</td>
				            				<td>'.$balance.'</td>
				            				<td>
				            					<a href="/crm_collections/view?id='.$quote_id.'">
					            					<button class="btn btn-info"
					            							data-toggle="tooltip"
					            							data-placement="top"
					            							title="View Collection">
					            						<span class="fa fa-eye"></span>
					            					</button>
				            					</a>
				            					<a href="/crm_collections/update?id='.$quote_id.'" class="btn btn-success"
				            							data-toggle="tooltip"
				            							data-placement="top"
				            							title="Update Collection"
				            							id="btn_update" >
				            						<span class="fa fa-money"></span>
				            					</a>
			            					</td>
				            			</tr>';
				            	}
				            	?>
				            </tbody>
				        </table>
				    </div>
				    <?php }
				    else {
				    	echo '<font style="color:red;font-weight:bold;">'.$undefined.'</font>';
				    }?>
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
    });
</script>