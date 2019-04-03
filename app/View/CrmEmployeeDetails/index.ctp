
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="crmEmployeeDetails index">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Crm Employee Details'); ?></h1>
		</div>
	</div>

	<div class="wrapper wrapper-content">
	<div class="row">
		
		<div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><?php echo __('Crm Employee Details'); ?> List</h5>
                    <div class="ibox-tools">
                    	<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Crm Employee Detail'), array('action' => 'add'), array('escape' => false)); ?>                        <a class="collapse-link">
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
																		<th><?php echo $this->Paginator->sort('admin_id'); ?></th>
																		<th><?php echo $this->Paginator->sort('position'); ?></th>
																		<th><?php echo $this->Paginator->sort('quota'); ?></th>
																		<th><?php echo $this->Paginator->sort('date_employed'); ?></th>
																		<th><?php echo $this->Paginator->sort('signature'); ?></th>
																		<th><?php echo $this->Paginator->sort('created_at'); ?></th>
																		<th><?php echo $this->Paginator->sort('updated_at'); ?></th>
																		<th class="actions"></th>
								</tr>
							</thead>
							<tbody>
									<?php foreach ($crmEmployeeDetails as $crmEmployeeDetail): ?>
					<tr>
						<td><?php echo h($crmEmployeeDetail['CrmEmployeeDetail']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($crmEmployeeDetail['Admin']['name'], array('controller' => 'admins', 'action' => 'view', $crmEmployeeDetail['Admin']['id'])); ?>
		</td>
						<td><?php echo h($crmEmployeeDetail['CrmEmployeeDetail']['position']); ?>&nbsp;</td>
						<td><?php echo h($crmEmployeeDetail['CrmEmployeeDetail']['quota']); ?>&nbsp;</td>
						<td><?php echo h($crmEmployeeDetail['CrmEmployeeDetail']['date_employed']); ?>&nbsp;</td>
						<td><?php echo h($crmEmployeeDetail['CrmEmployeeDetail']['signature']); ?>&nbsp;</td>
						<td><?php echo h($crmEmployeeDetail['CrmEmployeeDetail']['created_at']); ?>&nbsp;</td>
						<td><?php echo h($crmEmployeeDetail['CrmEmployeeDetail']['updated_at']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $crmEmployeeDetail['CrmEmployeeDetail']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $crmEmployeeDetail['CrmEmployeeDetail']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $crmEmployeeDetail['CrmEmployeeDetail']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $crmEmployeeDetail['CrmEmployeeDetail']['id'])); ?>
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
