
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="crmCompanies view">
	
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Crm Company'); ?></h1>
		</div>
	</div>
	
	<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox-title">
                <h5><?php echo __('Crm Company'); ?></h5>
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
			<?php echo h($crmCompany['CrmCompany']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Admin'); ?></th>
		<td>
			<?php echo $this->Html->link($crmCompany['Admin']['name'], array('controller' => 'admins', 'action' => 'view', $crmCompany['Admin']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Type'); ?></th>
		<td>
			<?php echo h($crmCompany['CrmCompany']['type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($crmCompany['CrmCompany']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Contact Number'); ?></th>
		<td>
			<?php echo h($crmCompany['CrmCompany']['contact_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Contact Person'); ?></th>
		<td>
			<?php echo h($crmCompany['CrmCompany']['contact_person']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Address'); ?></th>
		<td>
			<?php echo h($crmCompany['CrmCompany']['address']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Email'); ?></th>
		<td>
			<?php echo h($crmCompany['CrmCompany']['email']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created At'); ?></th>
		<td>
			<?php echo h($crmCompany['CrmCompany']['created_at']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Updated At'); ?></th>
		<td>
			<?php echo h($crmCompany['CrmCompany']['updated_at']); ?>
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

		
	<div class="related row">
		<div class="col-md-12">
			<div class="ibox">
			<div class="ibox-title">
                <h5><?php echo __('Related Crm Quotations'); ?></h5>\
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            
            <?php if (!empty($crmCompany['CrmQuotation'])): ?>
			
			<div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
							<tr>
									<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Quote Number'); ?></th>
		<th><?php echo __('Crm Company Id'); ?></th>
		<th><?php echo __('Admin Id'); ?></th>
		<th><?php echo __('Terms'); ?></th>
		<th><?php echo __('Shipping Address'); ?></th>
		<th><?php echo __('Billing Adress'); ?></th>
		<th><?php echo __('Sub Total'); ?></th>
		<th><?php echo __('Delivery Amount'); ?></th>
		<th><?php echo __('Installation Amount'); ?></th>
		<th><?php echo __('Discount'); ?></th>
		<th><?php echo __('Grand Total'); ?></th>
		<th><?php echo __('Collection Remarks'); ?></th>
		<th><?php echo __('Collection Date'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Validity Date'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Inquiry Id'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
							<th class="actions"></th>
							</tr>
						<thead>
						<tbody>
								<?php foreach ($crmCompany['CrmQuotation'] as $crmQuotation): ?>
		<tr>
			<td><?php echo $crmQuotation['id']; ?></td>
			<td><?php echo $crmQuotation['quote_number']; ?></td>
			<td><?php echo $crmQuotation['crm_company_id']; ?></td>
			<td><?php echo $crmQuotation['admin_id']; ?></td>
			<td><?php echo $crmQuotation['terms']; ?></td>
			<td><?php echo $crmQuotation['shipping_address']; ?></td>
			<td><?php echo $crmQuotation['billing_adress']; ?></td>
			<td><?php echo $crmQuotation['sub_total']; ?></td>
			<td><?php echo $crmQuotation['delivery_amount']; ?></td>
			<td><?php echo $crmQuotation['installation_amount']; ?></td>
			<td><?php echo $crmQuotation['discount']; ?></td>
			<td><?php echo $crmQuotation['grand_total']; ?></td>
			<td><?php echo $crmQuotation['collection_remarks']; ?></td>
			<td><?php echo $crmQuotation['collection_date']; ?></td>
			<td><?php echo $crmQuotation['subject']; ?></td>
			<td><?php echo $crmQuotation['validity_date']; ?></td>
			<td><?php echo $crmQuotation['status']; ?></td>
			<td><?php echo $crmQuotation['inquiry_id']; ?></td>
			<td><?php echo $crmQuotation['created_at']; ?></td>
			<td><?php echo $crmQuotation['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-search"></span>'), array('controller' => 'crm_quotations', 'action' => 'view', $crmQuotation['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="fa fa-edit"></span>'), array('controller' => 'crm_quotations', 'action' => 'edit', $crmQuotation['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="fa fa-remove"></span>'), array('controller' => 'crm_quotations', 'action' => 'delete', $crmQuotation['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $crmQuotation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php endif; ?>

			<div class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Crm Quotation'), array('controller' => 'crm_quotations', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
			</div>
		</div>
		</div><!-- end col md 12 -->
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