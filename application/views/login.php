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

    <title>Whatsapp Decrypter - Login</title>
    
    <link href="<?php echo base_url(CSS . 'isloading.css'); ?>" rel="stylesheet">
    
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(BOOTSTRAP_CSS . 'bootstrap.min.css'); ?>" rel="stylesheet">
    
    <!-- font-awesome -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(CSS . 'cover.css'); ?>" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo base_url(JS . 'jquery.isloading.js'); ?>"></script>
    
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="<?php echo base_url(JS . 'ie8-responsive-file-warning.js'); ?>"></script><![endif]-->
    <script src="<?php echo base_url(BOOTSTRAP_JS . 'ie-emulation-modes-warning.js'); ?>"></script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style type="text/css">
        .form_content {
            border:1px solid rgb(77, 77, 77);
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            padding: 15px;
        }
        .form_content form label {
            font-size: 1.5em;
            line-height: 2.5em;
        }
        .form_content form i {
            position: absolute;
            color: #6B6B6B;  
            margin: 3px 0 0 5px;
        }
        .form_content form input {
            padding-left: 65px;
            font-size: 2em;
            line-height: 2em;
            height: 65px;
        }
    </style>
  </head>

  <body>
    <div class="site-wrapper">
        <div class="site-wrapper-inner">
            <div class="cover-container">
                <div class="inner cover">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-md-offset-4 form_content" >
                            <h1 class="text-center login-title">Inicie sesión</h1>
                            <br/>
                            <div class="account-wall">
                                <form class="form-horizontal" action="login" method="POST">
                                    <div class="form-group">
                                      <label for="inputEmail3" class="col-sm-3 control-label">Usuario</label>
                                      <div class="col-sm-9" style="text-align: left;">
                                          <i class="fa fa-user fa-4x"></i>
                                          <input type="text" class="form-control" id="usr" name="usr" placeholder="Usuario" autofocus="true" value="<?php echo set_value('usr'); ?>">
                                          <?php echo form_error('usr'); ?>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="inputPassword3" class="col-sm-3 control-label">Contraseña</label>
                                      <div class="col-sm-9" style="text-align: left;">
                                          <i class="fa fa-key fa-4x"></i>
                                          <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Contraseña" value="<?php echo set_value('pwd'); ?>">
                                          <?php echo form_error('pwd'); ?>
                                      </div>
                                    </div>                                    
                                    <!--<div class="form-group">                                        
                                      <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox pull-right">
                                          <label>
                                            <input type="checkbox"> Recordarme !!!
                                          </label>
                                        </div>
                                      </div>
                                    </div>-->
                                    
                                    <div class="form-group">
                                      <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" name="submit" value="login" class="btn btn-default btn-lg  pull-right">Iniciar sesión</button>
                                      </div>
                                    </div>                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(BOOTSTRAP_JS . 'bootstrap.min.js'); ?>"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url(BOOTSTRAP_JS . 'ie10-viewport-bug-workaround.js'); ?>"></script>
        
    <script type="text/javascript">
        window.onbeforeunload = showloader;
        function showloader()
        {
            $.isLoading({ text: "Cargando..." });    
        } 
    </script>
    
  </body>
</html>
