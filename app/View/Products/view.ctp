
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="products view">
	
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Product'); ?></h1>
		</div>
	</div>
	
	<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox-title">
                <h5><?php echo __('Product'); ?></h5>
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
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Sub Category'); ?></th>
		<td>
			<?php echo $this->Html->link($product['SubCategory']['id'], array('controller' => 'sub_categories', 'action' => 'view', $product['SubCategory']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product Name'); ?></th>
		<td>
			<?php echo h($product['Product']['product_name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Code'); ?></th>
		<td>
			<?php echo h($product['Product']['code']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Lead Time'); ?></th>
		<td>
			<?php echo h($product['Product']['lead_time']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Parent Num'); ?></th>
		<td>
			<?php echo h($product['Product']['parent_num']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Base Price'); ?></th>
		<td>
			<?php echo h($product['Product']['base_price']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Keywords'); ?></th>
		<td>
			<?php echo h($product['Product']['keywords']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Note'); ?></th>
		<td>
			<?php echo h($product['Product']['note']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($product['Product']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Archive'); ?></th>
		<td>
			<?php echo h($product['Product']['archive']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created By'); ?></th>
		<td>
			<?php echo h($product['Product']['created_by']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Updated By'); ?></th>
		<td>
			<?php echo h($product['Product']['updated_by']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created At'); ?></th>
		<td>
			<?php echo h($product['Product']['created_at']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Updated At'); ?></th>
		<td>
			<?php echo h($product['Product']['updated_at']); ?>
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
                <h5><?php echo __('Related Inquiry Details'); ?></h5>\
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            
            <?php if (!empty($product['InquiryDetail'])): ?>
			
			<div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
							<tr>
									<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Inquiry Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Base Price'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
							<th class="actions"></th>
							</tr>
						<thead>
						<tbody>
								<?php foreach ($product['InquiryDetail'] as $inquiryDetail): ?>
		<tr>
			<td><?php echo $inquiryDetail['id']; ?></td>
			<td><?php echo $inquiryDetail['inquiry_id']; ?></td>
			<td><?php echo $inquiryDetail['product_id']; ?></td>
			<td><?php echo $inquiryDetail['qty']; ?></td>
			<td><?php echo $inquiryDetail['base_price']; ?></td>
			<td><?php echo $inquiryDetail['created_at']; ?></td>
			<td><?php echo $inquiryDetail['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-search"></span>'), array('controller' => 'inquiry_details', 'action' => 'view', $inquiryDetail['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="fa fa-edit"></span>'), array('controller' => 'inquiry_details', 'action' => 'edit', $inquiryDetail['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="fa fa-remove"></span>'), array('controller' => 'inquiry_details', 'action' => 'delete', $inquiryDetail['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $inquiryDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php endif; ?>

			<div class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Inquiry Detail'), array('controller' => 'inquiry_details', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
			</div>
		</div>
		</div><!-- end col md 12 -->
	</div>
		
	<div class="related row">
		<div class="col-md-12">
			<div class="ibox">
			<div class="ibox-title">
                <h5><?php echo __('Related Product Variants'); ?></h5>\
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            
            <?php if (!empty($product['ProductVariant'])): ?>
			
			<div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
							<tr>
									<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Attribute Name'); ?></th>
		<th><?php echo __('Attribute Value'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
							<th class="actions"></th>
							</tr>
						<thead>
						<tbody>
								<?php foreach ($product['ProductVariant'] as $productVariant): ?>
		<tr>
			<td><?php echo $productVariant['id']; ?></td>
			<td><?php echo $productVariant['product_id']; ?></td>
			<td><?php echo $productVariant['attribute_name']; ?></td>
			<td><?php echo $productVariant['attribute_value']; ?></td>
			<td><?php echo $productVariant['created_at']; ?></td>
			<td><?php echo $productVariant['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-search"></span>'), array('controller' => 'product_variants', 'action' => 'view', $productVariant['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="fa fa-edit"></span>'), array('controller' => 'product_variants', 'action' => 'edit', $productVariant['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="fa fa-remove"></span>'), array('controller' => 'product_variants', 'action' => 'delete', $productVariant['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $productVariant['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php endif; ?>

			<div class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Product Variant'), array('controller' => 'product_variants', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
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