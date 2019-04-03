
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="crmQuotationProducts index">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Crm Quotation Products'); ?></h1>
		</div>
	</div>

	<div class="wrapper wrapper-content">
	<div class="row">
		
		<div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><?php echo __('Crm Quotation Products'); ?> List</h5>
                    <div class="ibox-tools">
                    	<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Crm Quotation Product'), array('action' => 'add'), array('escape' => false)); ?>                        <a class="collapse-link">
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
																		<th><?php echo $this->Paginator->sort('product_id'); ?></th>
																		<th><?php echo $this->Paginator->sort('admin_id'); ?></th>
																		<th><?php echo $this->Paginator->sort('qty'); ?></th>
																		<th><?php echo $this->Paginator->sort('list_price'); ?></th>
																		<th><?php echo $this->Paginator->sort('total_price'); ?></th>
																		<th><?php echo $this->Paginator->sort('description'); ?></th>
																		<th><?php echo $this->Paginator->sort('created_at'); ?></th>
																		<th><?php echo $this->Paginator->sort('updated_at'); ?></th>
																		<th class="actions"></th>
								</tr>
							</thead>
							<tbody>
									<?php foreach ($crmQuotationProducts as $crmQuotationProduct): ?>
					<tr>
						<td><?php echo h($crmQuotationProduct['CrmQuotationProduct']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($crmQuotationProduct['CrmQuotation']['id'], array('controller' => 'crm_quotations', 'action' => 'view', $crmQuotationProduct['CrmQuotation']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($crmQuotationProduct['Product']['id'], array('controller' => 'products', 'action' => 'view', $crmQuotationProduct['Product']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($crmQuotationProduct['Admin']['name'], array('controller' => 'admins', 'action' => 'view', $crmQuotationProduct['Admin']['id'])); ?>
		</td>
						<td><?php echo h($crmQuotationProduct['CrmQuotationProduct']['qty']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotationProduct['CrmQuotationProduct']['list_price']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotationProduct['CrmQuotationProduct']['total_price']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotationProduct['CrmQuotationProduct']['description']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotationProduct['CrmQuotationProduct']['created_at']); ?>&nbsp;</td>
						<td><?php echo h($crmQuotationProduct['CrmQuotationProduct']['updated_at']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $crmQuotationProduct['CrmQuotationProduct']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $crmQuotationProduct['CrmQuotationProduct']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $crmQuotationProduct['CrmQuotationProduct']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $crmQuotationProduct['CrmQuotationProduct']['id'])); ?>
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
