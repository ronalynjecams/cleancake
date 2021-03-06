
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="crmDeliveryReceipts index">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Crm Delivery Receipts'); ?></h1>
		</div>
	</div>

	<div class="wrapper wrapper-content">
	<div class="row">
		
		<div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><?php echo __('Crm Delivery Receipts'); ?> List</h5>
                    <div class="ibox-tools">
                    	<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Crm Delivery Receipt'), array('action' => 'add'), array('escape' => false)); ?>                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example">
							<thead>
								<tr>
																		<th><?php echo $this->Paginator->sort('id'); ?></th>
																		<th><?php echo $this->Paginator->sort('crm_quotation_id'); ?></th>
																		<th><?php echo $this->Paginator->sort('dr_number'); ?></th>
																		<th><?php echo $this->Paginator->sort('delivery_date'); ?></th>
																		<th><?php echo $this->Paginator->sort('admin_id'); ?></th>
																		<th><?php echo $this->Paginator->sort('dr_type'); ?></th>
																		<th><?php echo $this->Paginator->sort('amount'); ?></th>
																		<th><?php echo $this->Paginator->sort('booking_code'); ?></th>
																		<th><?php echo $this->Paginator->sort('status'); ?></th>
																		<th><?php echo $this->Paginator->sort('created_at'); ?></th>
																		<th><?php echo $this->Paginator->sort('updatetd_at'); ?></th>
																		<th class="actions"></th>
								</tr>
							</thead>
							<tbody>
									<?php foreach ($crmDeliveryReceipts as $crmDeliveryReceipt): ?>
					<tr>
						<td><?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($crmDeliveryReceipt['CrmQuotation']['id'], array('controller' => 'crm_quotations', 'action' => 'view', $crmDeliveryReceipt['CrmQuotation']['id'])); ?>
		</td>
						<td><?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['dr_number']); ?>&nbsp;</td>
						<td><?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['delivery_date']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($crmDeliveryReceipt['Admin']['name'], array('controller' => 'admins', 'action' => 'view', $crmDeliveryReceipt['Admin']['id'])); ?>
		</td>
						<td><?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['dr_type']); ?>&nbsp;</td>
						<td><?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['amount']); ?>&nbsp;</td>
						<td><?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['booking_code']); ?>&nbsp;</td>
						<td><?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['status']); ?>&nbsp;</td>
						<td><?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['created_at']); ?>&nbsp;</td>
						<td><?php echo h($crmDeliveryReceipt['CrmDeliveryReceipt']['updatetd_at']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $crmDeliveryReceipt['CrmDeliveryReceipt']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $crmDeliveryReceipt['CrmDeliveryReceipt']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $crmDeliveryReceipt['CrmDeliveryReceipt']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $crmDeliveryReceipt['CrmDeliveryReceipt']['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
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

    });

</script>
