<div class="productVariants form">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Edit Product Variant'); ?></h1>
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
			<?php echo $this->Form->create('ProductVariant', array('role' => 'form')); ?>

								<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('product_id', array('class' => 'form-control', 'placeholder' => 'Product Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('attribute_name', array('class' => 'form-control', 'placeholder' => 'Attribute Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('attribute_value', array('class' => 'form-control', 'placeholder' => 'Attribute Value'));?>
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
