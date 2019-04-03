
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="admins index">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Admins'); ?></h1>
		</div>
	</div>

	<div class="wrapper wrapper-content">
	<div class="row">
		
		<div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><?php echo __('Admins'); ?> List</h5>
                    <div class="ibox-tools">
                    	<?php echo $this->Html->link(__('<span class="fa fa-plus"></span>&nbsp;&nbsp;New Admin'), array('action' => 'add'), array('escape' => false)); ?>                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example">
							<thead>
								<tr>
									<th><?php echo $this->Paginator->sort('Timestamp'); ?></th>
									<th><?php echo $this->Paginator->sort('Activity'); ?></th>
									<th><?php echo $this->Paginator->sort('Member'); ?></th>
								</tr>
							</thead>
							<tbody>
					<?php foreach ($time as $t): ?>
						<tr>
							<td><?php echo h($t['in']); ?>&nbsp;</td>
							<td>In</td>
							<td><?php echo h($name); ?>&nbsp;</td>
						</tr>
						<tr>
							<td><?php echo h($t['out']); ?>&nbsp;</td>
							<td>Out</td>
							<td><?php echo h($name); ?>&nbsp;</td>
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

<?php
$fr = current($time);
$to = end($time);
$fr = date('mdY',strtotime($fr['in']));
$to = date('mdY',strtotime($to['in']));

?>

<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            ordering: false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: '<?php echo $name.$fr.'-'.$to; ?>'},
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
