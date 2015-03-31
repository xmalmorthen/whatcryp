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
    
    <link href="<?php echo base_url(CSS . 'isloading.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url(BOOTSTRAP_CSS . 'bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="<?php echo base_url(CSS . 'cover.css'); ?>" rel="stylesheet">    
    <!--[if lt IE 9]><script src="<?php echo base_url(JS . 'ie8-responsive-file-warning.js'); ?>"></script><![endif]-->
    <script src="<?php echo base_url(BOOTSTRAP_JS . 'ie-emulation-modes-warning.js'); ?>"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->    
    <script src="<?php echo base_url(JS . 'jquery.isloading.js'); ?>"></script>                
    <style type="text/css">
        #admin_mnue .masthead-nav {
            text-align: right;
        }
        #admin_mnue .masthead-nav li{
            display: inline;
        }
    </style>
  </head>
  <body>
    <div class="site-wrapper">
        <div class="site-wrapper-inner">
            <div class="cover-container">
                <?php echo $this->load->view('logged',array('opts_mnu' => $mnu),TRUE);?>                
                <div class="row">
                    <div id="admin_mnue" class="col-sm-2">
                        <h3><i class="fa fa-cog"></i> Menú</h3>
                        <br/>
                        <ul class="nav masthead-nav">
                            <li class="<?php echo (strtolower($opc_active) == 'perfiles' ? 'active' : ''); ?>"><a href="<?php echo site_url('administrar/perfiles'); ?>"><i class="fa fa-newspaper-o"></i> Perfiles</a></li>
                            <li class="<?php echo (strtolower($opc_active) == 'usuarios' ? 'active' : ''); ?>"><a href="<?php echo site_url('administrar/usuarios'); ?>"><i class="fa fa-users"></i></i> Usuarios</a></li>
                            <li class="<?php echo (strtolower($opc_active) == 'perfilusuario' ? 'active' : ''); ?>"><a href="<?php echo site_url('administrar/perfiles_usuarios'); ?>"><i class="fa fa-street-view"></i></i> Perfile de Usuarios</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-10" style="padding: 15px 8%">
                        <h1><i class="fa fa-database fa-2x"></i>&nbsp;&nbsp;<?php echo 'Administrar ' . $title; ?></h1>
                        <br/>
                        <div>
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>      
    <script type="text/javascript">
        window.onbeforeunload = showloader;
        function showloader()
        {
            $.isLoading({ text: "Cargando..." });    
        } 
    </script>
  </body>
</html>