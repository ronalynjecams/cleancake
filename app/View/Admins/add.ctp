<div class="admins form">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Add User'); ?></h1>
		</div>
	</div>

	<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="ibox">
			<div class="ibox-title">
                <h5>&nbsp</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
			<?php echo $this->Form->create('Admin', array('role' => 'form', 'enctype'=>'multipart/form-data')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('username', array('class' => 'form-control', 'placeholder' => 'Username'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password'));?>
				</div>
				<div class="form-group">
					<label for="">Role</label>
					<?php echo $this->Form->input('job_title', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Role', 'options' => array('sales_executive' => 'Sales Executive', 'sales_coordinator' => 'Sales Coordinator','admin' => 'Admin'), 'empty' => 'Choose One'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('quota', array('class' => 'form-control', 'placeholder' => 'Quota'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('position', array('class' => 'form-control', 'placeholder' => 'Position'));?>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label for="">Date Employed</label>
						<?php echo $this->Form->date('date_employed', array('class' => 'form-control', 'placeholder' => 'Date Employed'));?>
					</div>
					<div class="form-group col-md-6">
						<?php echo $this->Form->input('signature', array('class' => 'form-control', 'type'=>'file', 'placeholder' => 'Signature'));?>
					</div>
				</div>
				<!--<div class="form-group">-->
				<!--	<?php //echo $this->Form->input('type', array('class' => 'form-control', 'placeholder' => 'Type'));?>-->
				<!--</div>-->
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

			</div>
		</div>
		</div><!-- end col md 12 -->
	</div>
	</div><!-- end row -->
</div>
