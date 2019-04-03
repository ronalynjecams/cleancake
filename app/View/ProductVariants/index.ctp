
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="productVariants index">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Product Variants'); ?></h1>
		</div>
	</div>

	<div class="wrapper wrapper-content">
	<div class="row">
		
		<div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><?php echo __('Product Variants'); ?> List</h5>
                    <div class="ibox-tools">
                    	<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Product Variant'), array('action' => 'add'), array('escape' => false)); ?>                        <a class="collapse-link">
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
																		<th><?php echo $this->Paginator->sort('product_id'); ?></th>
																		<th><?php echo $this->Paginator->sort('attribute_name'); ?></th>
																		<th><?php echo $this->Paginator->sort('attribute_value'); ?></th>
																		<th><?php echo $this->Paginator->sort('created_at'); ?></th>
																		<th><?php echo $this->Paginator->sort('updated_at'); ?></th>
																		<th class="actions"></th>
								</tr>
							</thead>
							<tbody>
									<?php foreach ($productVariants as $productVariant): ?>
					<tr>
						<td><?php echo h($productVariant['ProductVariant']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($productVariant['Product']['id'], array('controller' => 'products', 'action' => 'view', $productVariant['Product']['id'])); ?>
		</td>
						<td><?php echo h($productVariant['ProductVariant']['attribute_name']); ?>&nbsp;</td>
						<td><?php echo h($productVariant['ProductVariant']['attribute_value']); ?>&nbsp;</td>
						<td><?php echo h($productVariant['ProductVariant']['created_at']); ?>&nbsp;</td>
						<td><?php echo h($productVariant['ProductVariant']['updated_at']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $productVariant['ProductVariant']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $productVariant['ProductVariant']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $productVariant['ProductVariant']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $productVariant['ProductVariant']['id'])); ?>
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
