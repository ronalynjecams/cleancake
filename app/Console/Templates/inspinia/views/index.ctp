<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>

<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="<?php echo $pluralVar; ?> index">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></h1>
		</div>
	</div>

	<div class="wrapper wrapper-content">
	<div class="row">
		
		<div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?> List</h5>
                    <div class="ibox-tools">
                    	<?php echo "<?php echo \$this->Html->link(__('<span class=\"fa fa-plus\"></span>&nbsp;&nbsp;New " . $singularHumanName . "'), array('action' => 'add'), array('escape' => false)); ?>"; ?>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example">
							<thead>
								<tr>
									<?php foreach ($fields as $field): ?>
									<th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
									<?php endforeach; ?>
									<th class="actions"></th>
								</tr>
							</thead>
							<tbody>
								<?php
								echo "\t<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
								echo "\t\t\t\t\t<tr>\n";
									foreach ($fields as $field) {
										$isKey = false;
										if (!empty($associations['belongsTo'])) {
											foreach ($associations['belongsTo'] as $alias => $details) {
												if ($field === $details['foreignKey']) {
													$isKey = true;
													echo "\t\t\t\t\t\t\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
													break;
												}
											}
										}
										if ($isKey !== true) {
											echo "\t\t\t\t\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
										}
									}
					
									echo "\t\t\t\t\t\t<td class=\"actions\">\n";
									echo "\t\t\t\t\t\t\t<?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-search\"></span>', array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false)); ?>\n";
									echo "\t\t\t\t\t\t\t<?php echo \$this->Html->link('<span class=\"glyphicon glyphicon-edit\"></span>', array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false)); ?>\n";
									echo "\t\t\t\t\t\t\t<?php echo \$this->Form->postLink('<span class=\"glyphicon glyphicon-remove\"></span>', array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
									echo "\t\t\t\t\t\t</td>\n";
								echo "\t\t\t\t\t</tr>\n";
					
								echo "\t\t\t\t<?php endforeach; ?>\n";
								?>
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
