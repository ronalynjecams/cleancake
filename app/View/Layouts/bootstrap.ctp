<!DOCTYPE html>
<html lang="en">
   <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
        <title><?php echo $active_company; ?></title>
        
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $active_company_dash_logo; ?>">
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    
        <!-- Toastr style -->
        <link href="/css/plugins/toastr/toastr.min.css" rel="stylesheet">
        <link href="/css/sweetalert.css" rel="stylesheet">
    
        <!-- Gritter -->
        <link href="/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    
        <link href="/css/animate.css" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">
        <script src="/js/sweetalert.min.js"></script>
        
         <script src="/js/jquery-3.1.1.min.js"></script>
         <script src="/js/tinymce.min.js"></script> 
         <script src="/js/app.js"></script>
        
    </head>

    <?php
    if ($authUser) {
        ?>
        <body class="pace-done <?php echo $active_skin; ?>">
            <!-- Begin page -->
            <div id="wrapper">
            <!--<div id="wrapper">-->
                <?php
                // echo $this->Element('topbar');
                echo $this->Element('leftsidebar');
                ?>
                <div id="page-wrapper" class="gray-bg dashbard-1">
                <div class="content-page"> 
                    <?php
                    echo $this->Element('topbar');
                    echo $this->fetch('content');
                    // echo $this->Element('rightsidebar');
                    echo $this->Element('footer');
                    ?>  
                    
                    
                </div> <!-- content -->
                </div>
            </div> <!-- END wrapper -->
            <script>
                var resizefunc = [];
            </script>

            <!-- Mainly scripts -->
           
            <script src="/js/popper.min.js"></script>
            <script src="/js/bootstrap.js"></script>
            <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
            <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        
            
        
            <!-- Custom and plugin javascript -->
            <script src="/js/inspinia.js"></script>
            <script src="/js/plugins/pace/pace.min.js"></script>
        
            <!-- jQuery UI -->
            <script src="/js/plugins/jquery-ui/jquery-ui.min.js"></script>
        

        </body>
<?php
    } else {
        echo $this->fetch('content');
    }
?>
    <!-- Mirrored from coderthemes.com/flacto/light_red_2_dark/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Dec 2017 01:03:45 GMT -->
</html>

