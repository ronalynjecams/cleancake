
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="crmCompanies index">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Crm Companies'); ?></h1>
		</div>
	</div>

	<div class="wrapper wrapper-content">
	<div class="row">
		
		<div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><?php echo __('Crm Companies'); ?> List</h5>
                    <div class="ibox-tools">
                    	<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Crm Company'), array('action' => 'add'), array('escape' => false)); ?>                        <a class="collapse-link">
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
																		<th><?php echo $this->Paginator->sort('type'); ?></th>
																		<th><?php echo $this->Paginator->sort('name'); ?></th>
																		<th><?php echo $this->Paginator->sort('contact_number'); ?></th>
																		<th><?php echo $this->Paginator->sort('contact_person'); ?></th>
																		<th><?php echo $this->Paginator->sort('address'); ?></th>
																		<th><?php echo $this->Paginator->sort('email'); ?></th>
																		<th><?php echo $this->Paginator->sort('created_at'); ?></th>
																		<th><?php echo $this->Paginator->sort('updated_at'); ?></th>
																		<th class="actions"></th>
								</tr>
							</thead>
							<tbody>
									<?php foreach ($crmCompanies as $crmCompany): ?>
					<tr>
						<td><?php echo h($crmCompany['CrmCompany']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($crmCompany['Admin']['name'], array('controller' => 'admins', 'action' => 'view', $crmCompany['Admin']['id'])); ?>
		</td>
						<td><?php echo h($crmCompany['CrmCompany']['type']); ?>&nbsp;</td>
						<td><?php echo h($crmCompany['CrmCompany']['name']); ?>&nbsp;</td>
						<td><?php echo h($crmCompany['CrmCompany']['contact_number']); ?>&nbsp;</td>
						<td><?php echo h($crmCompany['CrmCompany']['contact_person']); ?>&nbsp;</td>
						<td><?php echo h($crmCompany['CrmCompany']['address']); ?>&nbsp;</td>
						<td><?php echo h($crmCompany['CrmCompany']['email']); ?>&nbsp;</td>
						<td><?php echo h($crmCompany['CrmCompany']['created_at']); ?>&nbsp;</td>
						<td><?php echo h($crmCompany['CrmCompany']['updated_at']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $crmCompany['CrmCompany']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $crmCompany['CrmCompany']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $crmCompany['CrmCompany']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $crmCompany['CrmCompany']['id'])); ?>
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
