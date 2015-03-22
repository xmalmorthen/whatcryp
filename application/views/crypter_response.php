<link href="<?php echo base_url(CSS . 'jquery.dataTables.css'); ?>" rel="stylesheet">

<style type="text/css">    
    .crypter_response {
         text-align: left;
    }
    .crypter_response .sidebar-module-inset hr {
        margin: -4px 15% 14px 15%;
        border: .1em solid #494949;
    }    
    .crypter_response .upload_file_info{
        font-size: .9em;
        line-height: 2em;
    }
    .err_proc {
        text-align: center;
    }
</style>

<div id="crypter_response" class="row crypter_response" style="">
    
    <?php if (isset($success) && $success === TRUE) {?>    
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">        
            <div class="sidebar-module sidebar-module-inset">
                <h3><i class="fa fa-info-circle fa-2x"></i>&nbsp; Base de datos</h3>
                <hr/>
            </div>       
            <div class="row upload_file_info">
                <div class="col-md-3">Archivo</div>
                <div class="col-md-9"><?php echo $uploaded_file['file_name']; ?></div>                
            </div>
            <div class="row upload_file_info">
                <div class="col-md-3">Extensión</div>
                <div class="col-md-9"><?php echo $uploaded_file['file_ext']; ?></div>                
            </div>
            <div class="row upload_file_info">
                <div class="col-md-3">Tamaño</div>
                <div class="col-md-9"><?php echo $uploaded_file['file_size'] . ' kb'; ?></div>                
            </div>

        </div><!-- /.blog-sidebar -->
        <div class="col-sm-8 blog-main" >
            <?php if (isset($whatsapp_xtract) && $whatsapp_xtract['success'] === TRUE) {?>
                <h2>Resultado procesado</h2>
                <div style="width: 100%;height: 600px;max-height: 600px;overflow: scroll;">
                    <?php echo $whatsapp_xtract['view']; ?>
                </div> 
            <?php } else {?>
                <div class="err_proc">
                    <h2><i class="fa fa-times fa-3x" style="color: red;"></i>&nbsp; Error al procesar la base de datos!!!</h2>
                    <p><?php echo $whatsapp_xtract['message']; ?></p>
                    <p>Favor de intentarlo de nuevo, si el problema persiste contacte al administrador...!!!</p>
                </div>
            <?php }?>
        </div>
    <?php } else {?>
        <div class="err_proc">
            <h2><i class="fa fa-times fa-3x" style="color: red;"></i>&nbsp; Error al procesar la base de datos...!!!</h2>
            <br/>
            <p><?php echo $message; ?></p>
            <p>Favor de intentarlo de nuevo, si el problema persiste contacte al administrador...!!!</p>
        </div>
    <?php }?>
</div><!-- /.row -->

<script src="<?php echo base_url(JS . 'jquery-1.11.1.min.js'); ?>"></script>
<script src="<?php echo base_url(JS . 'jquery.dataTables.min.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#chatsession').DataTable();
    });
</script>