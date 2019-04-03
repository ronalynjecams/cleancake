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

<div class="<?php echo $pluralVar; ?> view">
	
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo "<?php echo __('{$singularHumanName}'); ?>"; ?></h1>
		</div>
	</div>
	
	<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox-title">
                <h5><?php echo "<?php echo __('{$singularHumanName}'); ?>"; ?></h5>
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
						<?php
						foreach ($fields as $field) {
							echo "<tr>\n";
							$isKey = false;
							if (!empty($associations['belongsTo'])) {
								foreach ($associations['belongsTo'] as $alias => $details) {
									if ($field === $details['foreignKey']) {
										$isKey = true;
										echo "\t\t<th><?php echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?></th>\n";
										echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t&nbsp;\n\t\t</td>\n";
										break;
									}
								}
							}
							if ($isKey !== true) {
								echo "\t\t<th><?php echo __('" . Inflector::humanize($field) . "'); ?></th>\n";
								echo "\t\t<td>\n\t\t\t<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t\t&nbsp;\n\t\t</td>\n";
							}
							echo "</tr>\n";
						}
						?>
						</tbody>
					</table>
				</div>
			</div>		
		</div>
	</div>
	</div>

	<?php
	if (!empty($associations['hasOne'])) :
		foreach ($associations['hasOne'] as $alias => $details): ?>
			<div class="row related">
				<div class="col-md-12">
					<div class="ibox-title">
	                    <h5><?php echo "<?php echo __('Related " . Inflector::humanize($details['controller']) . "'); ?>"; ?></h5>
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
								<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>
									<tr>
									<?php
									foreach ($details['fields'] as $field) {
										echo "\t\t<th><?php echo __('" . Inflector::humanize($field) . "'); ?></th>\n";
										echo "\t\t<td>\n\t<?php echo \${$singularVar}['{$alias}']['{$field}']; ?>\n&nbsp;</td>\n";
									}
									?>
									</tr>
								<?php echo "<?php endif; ?>\n"; ?>
								</tbody>
							</table>
							<div class="actions">
								<?php echo "<?php echo \$this->Html->link(__('Edit " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$singularVar}['{$alias}']['{$details['primaryKey']}']), array('escape' => false, 'class' => 'btn btn-default')); ?>\n"; ?>
							</div>
						</div>
					</div>
				</div><!-- end col md 12 -->
			</div>
			<?php
		endforeach;
	endif;
	
	if (empty($associations['hasMany'])) {
		$associations['hasMany'] = array();
	}
	if (empty($associations['hasAndBelongsToMany'])) {
		$associations['hasAndBelongsToMany'] = array();
	}
	$relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
	foreach ($relations as $alias => $details):
		$otherSingularVar = Inflector::variable($alias);
		$otherPluralHumanName = Inflector::humanize($details['controller']);
	?>
	
	<div class="related row">
		<div class="col-md-12">
			<div class="ibox">
			<div class="ibox-title">
                <h5><?php echo "<?php echo __('Related " . $otherPluralHumanName . "'); ?>"; ?></h5>\
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            
            <?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>
			
			<div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
							<tr>
							<?php
								foreach ($details['fields'] as $field) {
									echo "\t\t<th><?php echo __('" . Inflector::humanize($field) . "'); ?></th>\n";
								}
							?>
							<th class="actions"></th>
							</tr>
						<thead>
						<tbody>
							<?php
							echo "\t<?php foreach (\${$singularVar}['{$alias}'] as \${$otherSingularVar}): ?>\n";
								echo "\t\t<tr>\n";
									foreach ($details['fields'] as $field) {
										echo "\t\t\t<td><?php echo \${$otherSingularVar}['{$field}']; ?></td>\n";
									}
						
									echo "\t\t\t<td class=\"actions\">\n";
									echo "\t\t\t\t<?php echo \$this->Html->link(__('<span class=\"fa fa-search\"></span>'), array('controller' => '{$details['controller']}', 'action' => 'view', \${$otherSingularVar}['{$details['primaryKey']}']), array('escape' => false)); ?>\n";
									echo "\t\t\t\t<?php echo \$this->Html->link(__('<span class=\"fa fa-edit\"></span>'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$otherSingularVar}['{$details['primaryKey']}']), array('escape' => false)); ?>\n";
									echo "\t\t\t\t<?php echo \$this->Form->postLink(__('<span class=\"fa fa-remove\"></span>'), array('controller' => '{$details['controller']}', 'action' => 'delete', \${$otherSingularVar}['{$details['primaryKey']}']), array('escape' => false), __('Are you sure you want to delete # %s?', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
									echo "\t\t\t</td>\n";
									echo "\t\t</tr>\n";
						
							echo "\t<?php endforeach; ?>\n";
							?>
						</tbody>
					</table>
				</div>
			</div>
			<?php echo "<?php endif; ?>\n\n"; ?>
			<div class="actions">
				<?php echo "<?php echo \$this->Html->link(__('<span class=\"fa fa-plus\"></span>&nbsp;&nbsp;New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?>"; ?> 
			</div>
		</div>
		</div><!-- end col md 12 -->
	</div>
	<?php endforeach; ?>
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