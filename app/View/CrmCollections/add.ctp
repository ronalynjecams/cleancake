<div class="crmCollections form">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Add Crm Collection'); ?></h1>
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
			<?php echo $this->Form->create('CrmCollection', array('role' => 'form')); ?>

								<div class="form-group">
					<?php echo $this->Form->input('crm_quotation_id', array('class' => 'form-control', 'placeholder' => 'Crm Quotation Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('paid_amount', array('class' => 'form-control', 'placeholder' => 'Paid Amount'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('ewt_amount', array('class' => 'form-control', 'placeholder' => 'Ewt Amount'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('other_amount', array('class' => 'form-control', 'placeholder' => 'Other Amount'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('balance', array('class' => 'form-control', 'placeholder' => 'Balance'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('mode', array('class' => 'form-control', 'placeholder' => 'Mode'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('type', array('class' => 'form-control', 'placeholder' => 'Type'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('cheque_date', array('class' => 'form-control', 'placeholder' => 'Cheque Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('cheque_number', array('class' => 'form-control', 'placeholder' => 'Cheque Number'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('crm_bank_id', array('class' => 'form-control', 'placeholder' => 'Crm Bank Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('created_at', array('class' => 'form-control', 'placeholder' => 'Created At'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('updated_at', array('class' => 'form-control', 'placeholder' => 'Updated At'));?>
				</div>
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
