<div class="products form">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
				<h1><?php echo __('Edit Product'); ?></h1>
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
			<?php echo $this->Form->create('Product', array('role' => 'form')); ?>

								<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('sub_category_id', array('class' => 'form-control', 'placeholder' => 'Sub Category Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('product_name', array('class' => 'form-control', 'placeholder' => 'Product Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('code', array('class' => 'form-control', 'placeholder' => 'Code'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('lead_time', array('class' => 'form-control', 'placeholder' => 'Lead Time'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('parent_num', array('class' => 'form-control', 'placeholder' => 'Parent Num'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('base_price', array('class' => 'form-control', 'placeholder' => 'Base Price'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('keywords', array('class' => 'form-control', 'placeholder' => 'Keywords'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('note', array('class' => 'form-control', 'placeholder' => 'Note'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('archive', array('class' => 'form-control', 'placeholder' => 'Archive'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('created_by', array('class' => 'form-control', 'placeholder' => 'Created By'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('updated_by', array('class' => 'form-control', 'placeholder' => 'Updated By'));?>
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
