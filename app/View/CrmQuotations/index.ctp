
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

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
						<table class="table table-striped table-bordered table-hover dataTables-quotations">
							<thead>
								<tr>
																		<th><?php echo $this->Paginator->sort('id'); ?></th>
																		<th><?php echo $this->Paginator->sort('quote_number'); ?></th>
																		<th><?php echo $this->Paginator->sort('crm_company_id'); ?></th>
																		<th><?php echo $this->Paginator->sort('admin_id'); ?></th>
																		<th><?php echo $this->Paginator->sort('terms'); ?></th>
																		<th><?php echo $this->Paginator->sort('shipping_address'); ?></th>
																		<th><?php echo $this->Paginator->sort('billing_adress'); ?></th>
																		<th><?php echo $this->Paginator->sort('sub_total'); ?></th>
																		<th><?php echo $this->Paginator->sort('delivery_amount'); ?></th>
																		<th><?php echo $this->Paginator->sort('installation_amount'); ?></th>
																		<th><?php echo $this->Paginator->sort('discount'); ?></th>
																		<th><?php echo $this->Paginator->sort('grand_total'); ?></th>
																		<th><?php echo $this->Paginator->sort('collection_remarks'); ?></th>
																		<th><?php echo $this->Paginator->sort('collection_date'); ?></th>
																		<th><?php echo $this->Paginator->sort('subject'); ?></th>
																		<th><?php echo $this->Paginator->sort('validity_date'); ?></th>
																		<th><?php echo $this->Paginator->sort('status'); ?></th>
																		<th><?php echo $this->Paginator->sort('inquiry_id'); ?></th>
																		<th><?php echo $this->Paginator->sort('created_at'); ?></th>
																		<th><?php echo $this->Paginator->sort('updated_at'); ?></th>
																		<th class="actions"></th>
								</tr>
							</thead>
							<tbody>
									<?php foreach ($crmQuotations as $crmQuotation): ?>
					<tr>
						<td><?php echo h($crmQuotation['CrmQuotation']['id']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['quote_number']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($crmQuotation['CrmCompany']['name'], array('controller' => 'crm_companies', 'action' => 'view', $crmQuotation['CrmCompany']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($crmQuotation['Admin']['name'], array('controller' => 'admins', 'action' => 'view', $crmQuotation['Admin']['id'])); ?>
		</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['terms']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['shipping_address']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['billing_adress']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['sub_total']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['delivery_amount']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['installation_amount']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['discount']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['grand_total']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['collection_remarks']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['collection_date']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['subject']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['validity_date']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['status']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($crmQuotation['Inquiry']['id'], array('controller' => 'inquiries', 'action' => 'view', $crmQuotation['Inquiry']['id'])); ?>
		</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['created_at']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotation['CrmQuotation']['updated_at']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $crmQuotation['CrmQuotation']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $crmQuotation['CrmQuotation']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $crmQuotation['CrmQuotation']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $crmQuotation['CrmQuotation']['id'])); ?>
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
        $('.dataTables-quotations').DataTable({
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
