<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url(FAVICON); ?>">

    <title><?php echo MASTER_PAGE_TITLE; ?></title>

    <link href="<?php echo base_url(CSS . 'jquery.dataTables.css'); ?>" rel="stylesheet">    
    <link href="<?php echo base_url(CSS . 'isloading.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url(BOOTSTRAP_CSS . 'bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="<?php echo base_url(CSS . 'cover.css'); ?>" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo base_url(JS . 'jquery.isloading.js'); ?>"></script>
    <script src="<?php echo base_url(BOOTSTRAP_JS . 'alert.js'); ?>"></script>
    <!--[if lt IE 9]><script src="<?php echo base_url(JS . 'ie8-responsive-file-warning.js'); ?>"></script><![endif]-->
    <script src="<?php echo base_url(BOOTSTRAP_JS . 'ie-emulation-modes-warning.js'); ?>"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="site-wrapper">
        <div class="site-wrapper-inner">
            <div class="cover-container">
                <?php echo $this->load->view('logged',array('opts_mnu' => $mnu),TRUE);
                      echo "<div style='margin-top: 90px;'>&nbsp</div>";?>
                <?php echo $content ?>                
            </div>
        </div>
    </div>   
    <script src="<?php echo base_url(BOOTSTRAP_JS . 'bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url(BOOTSTRAP_JS . 'ie10-viewport-bug-workaround.js'); ?>"></script>
    <script src="<?php echo base_url(JS . 'jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url(JS . 'dataTables.tableTools.js'); ?>"></script>
    
    <script src="<?php echo base_url(JS . 'tooltip.js'); ?>"></script>
    <script type="text/javascript">
        window.onbeforeunload = showloader;
        function showloader()
        {
            $.isLoading({ text: "Cargando..." });    
        } 
    </script>
  </body>
</html>