
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="crmQuotationProducts view">
	
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Crm Quotation Product'); ?></h1>
		</div>
	</div>
	
	<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox-title">
                <h5><?php echo __('Crm Quotation Product'); ?></h5>
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
			<?php echo h($crmQuotationProduct['CrmQuotationProduct']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Crm Quotation'); ?></th>
		<td>
			<?php echo $this->Html->link($crmQuotationProduct['CrmQuotation']['id'], array('controller' => 'crm_quotations', 'action' => 'view', $crmQuotationProduct['CrmQuotation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product'); ?></th>
		<td>
			<?php echo $this->Html->link($crmQuotationProduct['Product']['id'], array('controller' => 'products', 'action' => 'view', $crmQuotationProduct['Product']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Admin'); ?></th>
		<td>
			<?php echo $this->Html->link($crmQuotationProduct['Admin']['name'], array('controller' => 'admins', 'action' => 'view', $crmQuotationProduct['Admin']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty'); ?></th>
		<td>
			<?php echo h($crmQuotationProduct['CrmQuotationProduct']['qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('List Price'); ?></th>
		<td>
			<?php echo h($crmQuotationProduct['CrmQuotationProduct']['list_price']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Total Price'); ?></th>
		<td>
			<?php echo h($crmQuotationProduct['CrmQuotationProduct']['total_price']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Description'); ?></th>
		<td>
			<?php echo h($crmQuotationProduct['CrmQuotationProduct']['description']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created At'); ?></th>
		<td>
			<?php echo h($crmQuotationProduct['CrmQuotationProduct']['created_at']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Updated At'); ?></th>
		<td>
			<?php echo h($crmQuotationProduct['CrmQuotationProduct']['updated_at']); ?>
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