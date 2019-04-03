
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="products index">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Products'); ?></h1>
		</div>
	</div>

	<div class="wrapper wrapper-content">
	<div class="row">
		
		<div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><?php echo __('Products'); ?> List</h5>
                    <div class="ibox-tools">
                    	<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Product'), array('action' => 'add'), array('escape' => false)); ?>                        <a class="collapse-link">
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
																		<th><?php echo $this->Paginator->sort('sub_category_id'); ?></th>
																		<th><?php echo $this->Paginator->sort('product_name'); ?></th>
																		<th><?php echo $this->Paginator->sort('code'); ?></th>
																		<th><?php echo $this->Paginator->sort('lead_time'); ?></th>
																		<th><?php echo $this->Paginator->sort('parent_num'); ?></th>
																		<th><?php echo $this->Paginator->sort('base_price'); ?></th>
																		<th><?php echo $this->Paginator->sort('keywords'); ?></th>
																		<th><?php echo $this->Paginator->sort('note'); ?></th>
																		<th><?php echo $this->Paginator->sort('status'); ?></th>
																		<th><?php echo $this->Paginator->sort('archive'); ?></th>
																		<th><?php echo $this->Paginator->sort('created_by'); ?></th>
																		<th><?php echo $this->Paginator->sort('updated_by'); ?></th>
																		<th><?php echo $this->Paginator->sort('created_at'); ?></th>
																		<th><?php echo $this->Paginator->sort('updated_at'); ?></th>
																		<th class="actions"></th>
								</tr>
							</thead>
							<tbody>
									<?php foreach ($products as $product): ?>
					<tr>
						<td><?php echo h($product['Product']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($product['SubCategory']['id'], array('controller' => 'sub_categories', 'action' => 'view', $product['SubCategory']['id'])); ?>
		</td>
						<td><?php echo h($product['Product']['product_name']); ?>&nbsp;</td>
						<td><?php echo h($product['Product']['code']); ?>&nbsp;</td>
						<td><?php echo h($product['Product']['lead_time']); ?>&nbsp;</td>
						<td><?php echo h($product['Product']['parent_num']); ?>&nbsp;</td>
						<td><?php echo h($product['Product']['base_price']); ?>&nbsp;</td>
						<td><?php echo h($product['Product']['keywords']); ?>&nbsp;</td>
						<td><?php echo h($product['Product']['note']); ?>&nbsp;</td>
						<td><?php echo h($product['Product']['status']); ?>&nbsp;</td>
						<td><?php echo h($product['Product']['archive']); ?>&nbsp;</td>
						<td><?php echo h($product['Product']['created_by']); ?>&nbsp;</td>
						<td><?php echo h($product['Product']['updated_by']); ?>&nbsp;</td>
						<td><?php echo h($product['Product']['created_at']); ?>&nbsp;</td>
						<td><?php echo h($product['Product']['updated_at']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $product['Product']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $product['Product']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $product['Product']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?>
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
