
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="users view">
	
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('User'); ?></h1>
		</div>
	</div>
	
	<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox-title">
                <h5><?php echo __('User'); ?></h5>
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
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($user['User']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Username'); ?></th>
		<td>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Password'); ?></th>
		<td>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Remember Token'); ?></th>
		<td>
			<?php echo h($user['User']['remember_token']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created At'); ?></th>
		<td>
			<?php echo h($user['User']['created_at']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Updated At'); ?></th>
		<td>
			<?php echo h($user['User']['updated_at']); ?>
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
            
            <?php if (!empty($user['CrmCompany'])): ?>
			
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
								<?php foreach ($user['CrmCompany'] as $crmCompany): ?>
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
            
            <?php if (!empty($user['CrmDeliveryReceipt'])): ?>
			
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
								<?php foreach ($user['CrmDeliveryReceipt'] as $crmDeliveryReceipt): ?>
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
                <h5><?php echo __('Related Crm Quotation Products'); ?></h5>\
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            
            <?php if (!empty($user['CrmQuotationProduct'])): ?>
			
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
								<?php foreach ($user['CrmQuotationProduct'] as $crmQuotationProduct): ?>
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
            
            <?php if (!empty($user['CrmQuotation'])): ?>
			
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
		<th><?php echo __('Billing Address'); ?></th>
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
								<?php foreach ($user['CrmQuotation'] as $crmQuotation): ?>
		<tr>
			<td><?php echo $crmQuotation['id']; ?></td>
			<td><?php echo $crmQuotation['quote_number']; ?></td>
			<td><?php echo $crmQuotation['crm_company_id']; ?></td>
			<td><?php echo $crmQuotation['admin_id']; ?></td>
			<td><?php echo $crmQuotation['terms']; ?></td>
			<td><?php echo $crmQuotation['shipping_address']; ?></td>
			<td><?php echo $crmQuotation['billing_address']; ?></td>
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
		
	<div class="related row">
		<div class="col-md-12">
			<div class="ibox">
			<div class="ibox-title">
                <h5><?php echo __('Related Social Profiles'); ?></h5>\
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            
            <?php if (!empty($user['SocialProfile'])): ?>
			
			<div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
							<tr>
									<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Social Network Name'); ?></th>
		<th><?php echo __('Social Network Id'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Display Name'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Link'); ?></th>
		<th><?php echo __('Picture'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
		<th><?php echo __('Status'); ?></th>
							<th class="actions"></th>
							</tr>
						<thead>
						<tbody>
								<?php foreach ($user['SocialProfile'] as $socialProfile): ?>
		<tr>
			<td><?php echo $socialProfile['id']; ?></td>
			<td><?php echo $socialProfile['user_id']; ?></td>
			<td><?php echo $socialProfile['social_network_name']; ?></td>
			<td><?php echo $socialProfile['social_network_id']; ?></td>
			<td><?php echo $socialProfile['email']; ?></td>
			<td><?php echo $socialProfile['display_name']; ?></td>
			<td><?php echo $socialProfile['first_name']; ?></td>
			<td><?php echo $socialProfile['last_name']; ?></td>
			<td><?php echo $socialProfile['link']; ?></td>
			<td><?php echo $socialProfile['picture']; ?></td>
			<td><?php echo $socialProfile['created_at']; ?></td>
			<td><?php echo $socialProfile['updated_at']; ?></td>
			<td><?php echo $socialProfile['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-search"></span>'), array('controller' => 'social_profiles', 'action' => 'view', $socialProfile['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="fa fa-edit"></span>'), array('controller' => 'social_profiles', 'action' => 'edit', $socialProfile['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="fa fa-remove"></span>'), array('controller' => 'social_profiles', 'action' => 'delete', $socialProfile['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $socialProfile['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php endif; ?>

			<div class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Social Profile'), array('controller' => 'social_profiles', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
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