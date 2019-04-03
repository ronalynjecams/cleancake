
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="crmEmployeeDetails view">
	
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Crm Employee Detail'); ?></h1>
		</div>
	</div>
	
	<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox-title">
                <h5><?php echo __('Crm Employee Detail'); ?></h5>
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
			<?php echo h($crmEmployeeDetail['CrmEmployeeDetail']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Admin'); ?></th>
		<td>
			<?php echo $this->Html->link($crmEmployeeDetail['Admin']['name'], array('controller' => 'admins', 'action' => 'view', $crmEmployeeDetail['Admin']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Position'); ?></th>
		<td>
			<?php echo h($crmEmployeeDetail['CrmEmployeeDetail']['position']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quota'); ?></th>
		<td>
			<?php echo h($crmEmployeeDetail['CrmEmployeeDetail']['quota']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Employed'); ?></th>
		<td>
			<?php echo h($crmEmployeeDetail['CrmEmployeeDetail']['date_employed']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Signature'); ?></th>
		<td>
			<?php echo h($crmEmployeeDetail['CrmEmployeeDetail']['signature']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created At'); ?></th>
		<td>
			<?php echo h($crmEmployeeDetail['CrmEmployeeDetail']['created_at']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Updated At'); ?></th>
		<td>
			<?php echo h($crmEmployeeDetail['CrmEmployeeDetail']['updated_at']); ?>
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