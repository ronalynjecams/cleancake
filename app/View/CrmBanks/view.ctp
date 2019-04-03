
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="crmBanks view">
	
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Crm Bank'); ?></h1>
		</div>
	</div>
	
	<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox-title">
                <h5><?php echo __('Crm Bank'); ?></h5>
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
			<?php echo h($crmBank['CrmBank']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($crmBank['CrmBank']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created At'); ?></th>
		<td>
			<?php echo h($crmBank['CrmBank']['created_at']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Updated At'); ?></th>
		<td>
			<?php echo h($crmBank['CrmBank']['updated_at']); ?>
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
            
            <?php if (!empty($crmBank['CrmCollection'])): ?>
			
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
								<?php foreach ($crmBank['CrmCollection'] as $crmCollection): ?>
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