
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="crmDeliveryReceipts view">
	
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Crm Delivery Receipt'); ?></h1>
		</div>
	</div>
	
	<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox-title">
                <h5><?php echo __('Crm Delivery Receipt'); ?></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<tbody>
						<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Crm Quotation'); ?></th>
		<td>
			<?php echo $this->Html->link($crmDeliveryReceipt['CrmQuotation']['id'], array('controller' => 'crm_quotations', 'action' => 'view', $crmDeliveryReceipt['CrmQuotation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Dr Number'); ?></th>
		<td>
			<?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['dr_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Delivery Date'); ?></th>
		<td>
			<?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['delivery_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Admin'); ?></th>
		<td>
			<?php echo $this->Html->link($crmDeliveryReceipt['Admin']['name'], array('controller' => 'admins', 'action' => 'view', $crmDeliveryReceipt['Admin']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Dr Type'); ?></th>
		<td>
			<?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['dr_type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Amount'); ?></th>
		<td>
			<?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Booking Code'); ?></th>
		<td>
			<?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['booking_code']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created At'); ?></th>
		<td>
			<?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['created_at']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Updatetd At'); ?></th>
		<td>
			<?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['updatetd_at']); ?>
			&nbsp;
		</td>
</tr>
						</tbody>
					</table>
				</div>
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

    });

</script>