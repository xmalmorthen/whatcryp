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

    <title>Whatsapp Decrypter</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(BOOTSTRAP_CSS . 'bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(CSS . 'cover.css'); ?>" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="<?php echo base_url(JS . 'ie8-responsive-file-warning.js'); ?>"></script><![endif]-->
    <script src="<?php echo base_url(BOOTSTRAP_JS . 'ie-emulation-modes-warning.js'); ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="site-wrapper">
        <div class="site-wrapper-inner">
            <div class="cover-container">

                <div class="inner cover">
                    <h1 class="cover-heading">Whatsapp Decrypter.</h1>
                    <br/>
                    <form action="" method="POST" enctype="multipart/form-data" style="text-align: left;">
                        <div class="form-group">
                            <label for="userfile">Selecciona la base de datos</label>                        
                            <input type="file" id="userfile" name="userfile" class="form-control" />            
                        </div>
                        <input type="submit" name="submit" value="Upload" class="btn btn-success pull-right" />
                    </form>
                    <?php if (isset($whatsapp_xtract) && $whatsapp_xtract['success'] === TRUE) {?>
                        <br/><br/>
                        <h1 class="cover-heading">Base de datos procesada.</h1>
                        <div style="width: 100%;height: 600px;max-height: 600px;overflow: scroll;">
                            <?php echo $this->load->view(WHATSAPP_XTRACT_OUTPUT_VIEW."/{$whatsapp_xtract['file_name']}",NULL,TRUE); ?>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo base_url(BOOTSTRAP_JS . 'bootstrap.min.js'); ?>"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url(BOOTSTRAP_JS . 'ie10-viewport-bug-workaround.js'); ?>"></script>
  </body>
</html>
