
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="admins view">
	
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Admin'); ?></h1>
		</div>
	</div>
	
	<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox-title">
                <h5><?php echo __('Admin'); ?></h5>
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
			<?php echo h($admin['Admin']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($admin['Admin']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Username'); ?></th>
		<td>
			<?php echo h($admin['Admin']['username']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Title'); ?></th>
		<td>
			<?php echo h($admin['Admin']['job_title']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Password'); ?></th>
		<td>
			<?php echo h($admin['Admin']['password']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Active'); ?></th>
		<td>
			<?php echo h($admin['Admin']['active']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Remember Token'); ?></th>
		<td>
			<?php echo h($admin['Admin']['remember_token']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Type'); ?></th>
		<td>
			<?php echo h($admin['Admin']['type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created At'); ?></th>
		<td>
			<?php echo h($admin['Admin']['created_at']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Updated At'); ?></th>
		<td>
			<?php echo h($admin['Admin']['updated_at']); ?>
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
                <h5><?php echo __('Related Crm Companies'); ?></h5>\
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            
            <?php if (!empty($admin['CrmCompany'])): ?>
			
			<div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
							<tr>
									<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Admin Id'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Contact Number'); ?></th>
		<th><?php echo __('Contact Person'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
							<th class="actions"></th>
							</tr>
						<thead>
						<tbody>
								<?php foreach ($admin['CrmCompany'] as $crmCompany): ?>
		<tr>
			<td><?php echo $crmCompany['id']; ?></td>
			<td><?php echo $crmCompany['admin_id']; ?></td>
			<td><?php echo $crmCompany['type']; ?></td>
			<td><?php echo $crmCompany['name']; ?></td>
			<td><?php echo $crmCompany['contact_number']; ?></td>
			<td><?php echo $crmCompany['contact_person']; ?></td>
			<td><?php echo $crmCompany['address']; ?></td>
			<td><?php echo $crmCompany['email']; ?></td>
			<td><?php echo $crmCompany['created_at']; ?></td>
			<td><?php echo $crmCompany['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-search"></span>'), array('controller' => 'crm_companies', 'action' => 'view', $crmCompany['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="fa fa-edit"></span>'), array('controller' => 'crm_companies', 'action' => 'edit', $crmCompany['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="fa fa-remove"></span>'), array('controller' => 'crm_companies', 'action' => 'delete', $crmCompany['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $crmCompany['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php endif; ?>

			<div class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Crm Company'), array('controller' => 'crm_companies', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
			</div>
		</div>
		</div><!-- end col md 12 -->
	</div>
		
	<div class="related row">
		<div class="col-md-12">
			<div class="ibox">
			<div class="ibox-title">
                <h5><?php echo __('Related Crm Delivery Receipts'); ?></h5>\
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            
            <?php if (!empty($admin['CrmDeliveryReceipt'])): ?>
			
			<div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
							<tr>
									<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Crm Quotation Id'); ?></th>
		<th><?php echo __('Dr Number'); ?></th>
		<th><?php echo __('Delivery Date'); ?></th>
		<th><?php echo __('Admin Id'); ?></th>
		<th><?php echo __('Dr Type'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th><?php echo __('Booking Code'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updatetd At'); ?></th>
							<th class="actions"></th>
							</tr>
						<thead>
						<tbody>
								<?php foreach ($admin['CrmDeliveryReceipt'] as $crmDeliveryReceipt): ?>
		<tr>
			<td><?php echo $crmDeliveryReceipt['id']; ?></td>
			<td><?php echo $crmDeliveryReceipt['crm_quotation_id']; ?></td>
			<td><?php echo $crmDeliveryReceipt['dr_number']; ?></td>
			<td><?php echo $crmDeliveryReceipt['delivery_date']; ?></td>
			<td><?php echo $crmDeliveryReceipt['admin_id']; ?></td>
			<td><?php echo $crmDeliveryReceipt['dr_type']; ?></td>
			<td><?php echo $crmDeliveryReceipt['amount']; ?></td>
			<td><?php echo $crmDeliveryReceipt['booking_code']; ?></td>
			<td><?php echo $crmDeliveryReceipt['status']; ?></td>
			<td><?php echo $crmDeliveryReceipt['created_at']; ?></td>
			<td><?php echo $crmDeliveryReceipt['updatetd_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-search"></span>'), array('controller' => 'crm_delivery_receipts', 'action' => 'view', $crmDeliveryReceipt['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="fa fa-edit"></span>'), array('controller' => 'crm_delivery_receipts', 'action' => 'edit', $crmDeliveryReceipt['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="fa fa-remove"></span>'), array('controller' => 'crm_delivery_receipts', 'action' => 'delete', $crmDeliveryReceipt['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $crmDeliveryReceipt['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php endif; ?>

			<div class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Crm Delivery Receipt'), array('controller' => 'crm_delivery_receipts', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
			</div>
		</div>
		</div><!-- end col md 12 -->
	</div>
		
	<div class="related row">
		<div class="col-md-12">
			<div class="ibox">
			<div class="ibox-title">
                <h5><?php echo __('Related Crm Employee Details'); ?></h5>\
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            
            <?php if (!empty($admin['CrmEmployeeDetail'])): ?>
			
			<div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
							<tr>
									<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Admin Id'); ?></th>
		<th><?php echo __('Position'); ?></th>
		<th><?php echo __('Quota'); ?></th>
		<th><?php echo __('Date Employed'); ?></th>
		<th><?php echo __('Signature'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
							<th class="actions"></th>
							</tr>
						<thead>
						<tbody>
								<?php foreach ($admin['CrmEmployeeDetail'] as $crmEmployeeDetail): ?>
		<tr>
			<td><?php echo $crmEmployeeDetail['id']; ?></td>
			<td><?php echo $crmEmployeeDetail['admin_id']; ?></td>
			<td><?php echo $crmEmployeeDetail['position']; ?></td>
			<td><?php echo $crmEmployeeDetail['quota']; ?></td>
			<td><?php echo $crmEmployeeDetail['date_employed']; ?></td>
			<td><?php echo $crmEmployeeDetail['signature']; ?></td>
			<td><?php echo $crmEmployeeDetail['created_at']; ?></td>
			<td><?php echo $crmEmployeeDetail['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-search"></span>'), array('controller' => 'crm_employee_details', 'action' => 'view', $crmEmployeeDetail['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="fa fa-edit"></span>'), array('controller' => 'crm_employee_details', 'action' => 'edit', $crmEmployeeDetail['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="fa fa-remove"></span>'), array('controller' => 'crm_employee_details', 'action' => 'delete', $crmEmployeeDetail['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $crmEmployeeDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php endif; ?>

			<div class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Crm Employee Detail'), array('controller' => 'crm_employee_details', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
			</div>
		</div>
		</div><!-- end col md 12 -->
	</div>
		
	<div class="related row">
		<div class="col-md-12">
			<div class="ibox">
			<div class="ibox-title">
                <h5><?php echo __('Related Crm Quotation Products'); ?></h5>\
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            
            <?php if (!empty($admin['CrmQuotationProduct'])): ?>
			
			<div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
							<tr>
									<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Crm Quotation Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Admin Id'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('List Price'); ?></th>
		<th><?php echo __('Total Price'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
							<th class="actions"></th>
							</tr>
						<thead>
						<tbody>
								<?php foreach ($admin['CrmQuotationProduct'] as $crmQuotationProduct): ?>
		<tr>
			<td><?php echo $crmQuotationProduct['id']; ?></td>
			<td><?php echo $crmQuotationProduct['crm_quotation_id']; ?></td>
			<td><?php echo $crmQuotationProduct['product_id']; ?></td>
			<td><?php echo $crmQuotationProduct['admin_id']; ?></td>
			<td><?php echo $crmQuotationProduct['qty']; ?></td>
			<td><?php echo $crmQuotationProduct['list_price']; ?></td>
			<td><?php echo $crmQuotationProduct['total_price']; ?></td>
			<td><?php echo $crmQuotationProduct['description']; ?></td>
			<td><?php echo $crmQuotationProduct['created_at']; ?></td>
			<td><?php echo $crmQuotationProduct['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-search"></span>'), array('controller' => 'crm_quotation_products', 'action' => 'view', $crmQuotationProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="fa fa-edit"></span>'), array('controller' => 'crm_quotation_products', 'action' => 'edit', $crmQuotationProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="fa fa-remove"></span>'), array('controller' => 'crm_quotation_products', 'action' => 'delete', $crmQuotationProduct['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $crmQuotationProduct['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php endif; ?>

			<div class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Crm Quotation Product'), array('controller' => 'crm_quotation_products', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
			</div>
		</div>
		</div><!-- end col md 12 -->
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
            
            <?php if (!empty($admin['CrmQuotation'])): ?>
			
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
								<?php foreach ($admin['CrmQuotation'] as $crmQuotation): ?>
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