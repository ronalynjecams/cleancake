
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="subCategories view">
	
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Sub Category'); ?></h1>
		</div>
	</div>
	
	<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox-title">
                <h5><?php echo __('Sub Category'); ?></h5>
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
			<?php echo h($subCategory['SubCategory']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Sub Category Name'); ?></th>
		<td>
			<?php echo h($subCategory['SubCategory']['sub_category_name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Level'); ?></th>
		<td>
			<?php echo h($subCategory['SubCategory']['level']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Sub Link Num'); ?></th>
		<td>
			<?php echo h($subCategory['SubCategory']['sub_link_num']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Category'); ?></th>
		<td>
			<?php echo $this->Html->link($subCategory['Category']['id'], array('controller' => 'categories', 'action' => 'view', $subCategory['Category']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($subCategory['SubCategory']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created At'); ?></th>
		<td>
			<?php echo h($subCategory['SubCategory']['created_at']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Updated At'); ?></th>
		<td>
			<?php echo h($subCategory['SubCategory']['updated_at']); ?>
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
                <h5><?php echo __('Related Products'); ?></h5>\
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            
            <?php if (!empty($subCategory['Product'])): ?>
			
			<div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
							<tr>
									<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Sub Category Id'); ?></th>
		<th><?php echo __('Product Name'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Lead Time'); ?></th>
		<th><?php echo __('Parent Num'); ?></th>
		<th><?php echo __('Base Price'); ?></th>
		<th><?php echo __('Keywords'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Archive'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Updated By'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
							<th class="actions"></th>
							</tr>
						<thead>
						<tbody>
								<?php foreach ($subCategory['Product'] as $product): ?>
		<tr>
			<td><?php echo $product['id']; ?></td>
			<td><?php echo $product['sub_category_id']; ?></td>
			<td><?php echo $product['product_name']; ?></td>
			<td><?php echo $product['code']; ?></td>
			<td><?php echo $product['lead_time']; ?></td>
			<td><?php echo $product['parent_num']; ?></td>
			<td><?php echo $product['base_price']; ?></td>
			<td><?php echo $product['keywords']; ?></td>
			<td><?php echo $product['note']; ?></td>
			<td><?php echo $product['status']; ?></td>
			<td><?php echo $product['archive']; ?></td>
			<td><?php echo $product['created_by']; ?></td>
			<td><?php echo $product['updated_by']; ?></td>
			<td><?php echo $product['created_at']; ?></td>
			<td><?php echo $product['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-search"></span>'), array('controller' => 'products', 'action' => 'view', $product['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="fa fa-edit"></span>'), array('controller' => 'products', 'action' => 'edit', $product['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="fa fa-remove"></span>'), array('controller' => 'products', 'action' => 'delete', $product['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $product['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<?php endif; ?>

			<div class="actions">
				<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
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