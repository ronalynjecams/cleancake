
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="crmQuotations view">
	
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Crm Quotation'); ?></h1>
		</div>
	</div>
	
	<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox-title">
                <h5><?php echo __('Crm Quotation'); ?></h5>
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
			<?php echo h($crmQuotation['CrmQuotation']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quote Number'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['quote_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Crm Company'); ?></th>
		<td>
			<?php echo $this->Html->link($crmQuotation['CrmCompany']['name'], array('controller' => 'crm_companies', 'action' => 'view', $crmQuotation['CrmCompany']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Admin'); ?></th>
		<td>
			<?php echo $this->Html->link($crmQuotation['Admin']['name'], array('controller' => 'admins', 'action' => 'view', $crmQuotation['Admin']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Terms'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['terms']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Shipping Address'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['shipping_address']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Billing Adress'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['billing_adress']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Sub Total'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['sub_total']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Delivery Amount'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['delivery_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Installation Amount'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['installation_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Discount'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['discount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Grand Total'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['grand_total']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Collection Remarks'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['collection_remarks']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Collection Date'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['collection_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Subject'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['subject']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Validity Date'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['validity_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Inquiry'); ?></th>
		<td>
			<?php echo $this->Html->link($crmQuotation['Inquiry']['id'], array('controller' => 'inquiries', 'action' => 'view', $crmQuotation['Inquiry']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created At'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['created_at']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Updated At'); ?></th>
		<td>
			<?php echo h($crmQuotation['CrmQuotation']['updated_at']); ?>
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
                <h5><?php echo __('Related Crm Collections'); ?></h5>\
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            
            <?php if (!empty($crmQuotation['CrmCollection'])): ?>
			
			<div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
							<tr>
									<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Crm Quotation Id'); ?></th>
		<th><?php echo __('Paid Amount'); ?></th>
		<th><?php echo __('Ewt Amount'); ?></th>
		<th><?php echo __('Other Amount'); ?></th>
		<th><?php echo __('Balance'); ?></th>
		<th><?php echo __('Mode'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Cheque Date'); ?></th>
		<th><?php echo __('Cheque Number'); ?></th>
		<th><?php echo __('Crm Bank Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
							<th class="actions"></th>
							</tr>
						<thead>
						<tbody>
								<?php foreach ($crmQuotation['CrmCollection'] as $crmCollection): ?>
		<tr>
			<td><?php echo $crmCollection['id']; ?></td>
			<td><?php echo $crmCollection['crm_quotation_id']; ?></td>
			<td><?php echo $crmCollection['paid_amount']; ?></td>
			<td><?php echo $crmCollection['ewt_amount']; ?></td>
			<td><?php echo $crmCollection['other_amount']; ?></td>
			<td><?php echo $crmCollection['balance']; ?></td>
			<td><?php echo $crmCollection['mode']; ?></td>
			<td><?php echo $crmCollection['type']; ?></td>
			<td><?php echo $crmCollection['cheque_date']; ?></td>
			<td><?php echo $crmCollection['cheque_number']; ?></td>
			<td><?php echo $crmCollection['crm_bank_id']; ?></td>
			<td><?php echo $crmCollection['status']; ?></td>
			<td><?php echo $crmCollection['created_at']; ?></td>
			<td><?php echo $crmCollection['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-search"></span>'), array('controller' => 'crm_collections', 'action' => 'view', $crmCollection['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="fa fa-edit"></span>'), array('controller' => 'crm_collections', 'action' => 'edit', $crmCollection['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="fa fa-remove"></span>'), array('controller' => 'crm_collections', 'action' => 'delete', $crmCollection['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $crmCollection['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php endif; ?>

			<div class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Crm Collection'), array('controller' => 'crm_collections', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
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
            
            <?php if (!empty($crmQuotation['CrmDeliveryReceipt'])): ?>
			
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
								<?php foreach ($crmQuotation['CrmDeliveryReceipt'] as $crmDeliveryReceipt): ?>
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
            
            <?php if (!empty($crmQuotation['CrmQuotationProduct'])): ?>
			
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
								<?php foreach ($crmQuotation['CrmQuotationProduct'] as $crmQuotationProduct): ?>
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