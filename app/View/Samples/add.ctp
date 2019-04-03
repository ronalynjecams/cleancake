<div class="samples form">

	<div class="row  border-bottom white-bg dashboard-header">
		<div class="col-md-12">
				<h1><?php echo __('Add Sample'); ?></h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="ibox-title">
                <h5>&nbsp</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
							<?php echo $this->Form->create('Sample', array('role' => 'form')); ?>

								<div class="form-group">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('moified', array('class' => 'form-control', 'placeholder' => 'Moified'));?>
				</div>
								<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

			</div>
		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
