<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <h3>Welcome to <?php echo $active_company; ?></h3>
            <p>Login</p>
            <?php echo $this->Form->create('Admin', array('role' => 'form', 'class' => 'form-horizontal m-t-10')); ?>
                <div class="form-group">
                    <?php echo $this->Form->input('username', array('class' => 'form-control', 'placeholder' => 'Username', 'label' => false)); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password', 'label' => false)); ?>
                </div>
                <?php echo $this->Form->submit(__('Login'), array('class' => 'btn btn-warning block full-width m-b')); ?>

                <!--<a href="#"><small>Forgot password?</small></a>-->
                <!--<p class="text-muted text-center"><small>Do not have an account?</small></p>-->
                <!--<a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>-->
            <?php echo $this->Form->end() ?>
            <p class="m-t"> <small><?php echo $active_company; ?> &copy;2018</small> </p>
        </div>
    </div>
    <!-- end card-box -->

<!-- end wrapper page -->
</body>