<div class="crmQuotations form">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Edit Crm Quotation'); ?></h1>
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
			<?php echo $this->Form->create('CrmQuotation', array('role' => 'form')); ?>

								<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('quote_number', array('class' => 'form-control', 'placeholder' => 'Quote Number'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('crm_company_id', array('class' => 'form-control', 'placeholder' => 'Crm Company Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('admin_id', array('class' => 'form-control', 'placeholder' => 'Admin Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('terms', array('class' => 'form-control', 'placeholder' => 'Terms'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('shipping_address', array('class' => 'form-control', 'placeholder' => 'Shipping Address'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('billing_adress', array('class' => 'form-control', 'placeholder' => 'Billing Adress'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('sub_total', array('class' => 'form-control', 'placeholder' => 'Sub Total'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('delivery_amount', array('class' => 'form-control', 'placeholder' => 'Delivery Amount'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('installation_amount', array('class' => 'form-control', 'placeholder' => 'Installation Amount'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('discount', array('class' => 'form-control', 'placeholder' => 'Discount'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('grand_total', array('class' => 'form-control', 'placeholder' => 'Grand Total'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('collection_remarks', array('class' => 'form-control', 'placeholder' => 'Collection Remarks'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('collection_date', array('class' => 'form-control', 'placeholder' => 'Collection Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('subject', array('class' => 'form-control', 'placeholder' => 'Subject'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('validity_date', array('class' => 'form-control', 'placeholder' => 'Validity Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('inquiry_id', array('class' => 'form-control', 'placeholder' => 'Inquiry Id'));?>
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
