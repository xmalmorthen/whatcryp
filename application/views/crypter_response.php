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
    .crypter_response .upload_file_info .title {
        text-align: right;
    }
    .crypter_response .crypter_data_response{
        width: 700px!Important;
        max-width: 700px!Important;
        height: 800px;
        max-height: 800px;
        overflow: scroll;
        padding: 10px 20px;
    }
    .section_session_list {
        line-height: 2em;
        font-size: 1.2em;
    }
    .section_session_list a {
        text-decoration: none;
    }
    .section_session_list li i {
        margin-left: 80px;
    }
    .tooltip_template_info{
       line-height: 2em;
       text-align: left;
    }
    .tooltip-inner {
        max-width: 350px;    
        width: 350px;
    }
    .tooltip_template_info .title{
        text-align: right;
    }
    .crypter_data_response table {
        width: 80%!Important;
    }
    .err_proc {
        text-align: center;
    }
</style>

<div id="crypter_response" class="row crypter_response" style="">
    
    <?php if (isset($success) && $success === TRUE) {?>    
        <div class="col-sm-4 col-sm-offset-1 blog-sidebar">        
            <div class="sidebar-module sidebar-module-inset">
                <section>
                    <h3><i class="fa fa-info-circle fa-2x"></i>&nbsp; Base de datos</h3>
                    <hr/>
                    <div class="row upload_file_info">
                        <div class="col-md-3 title">Archivo</div>
                        <div class="col-md-8"><?php echo $uploaded_file['file_name']; ?></div>                
                    </div>
                    <div class="row upload_file_info">
                        <div class="col-md-3 title">Extensión</div>
                        <div class="col-md-8"><?php echo $uploaded_file['file_ext']; ?></div>                
                    </div>
                    <div class="row upload_file_info">
                        <div class="col-md-3 title">Tamaño</div>
                        <div class="col-md-8"><?php echo $uploaded_file['file_size'] . ' kb'; ?></div>                
                    </div>
                </section>
                <br/>
                <section id="section_session_list" class="section_session_list">
                    <h3><i class="fa fa-list-alt fa-2x"></i>&nbsp; Sesiones</h3>
                    <hr/>    
                </section>
            </div>       
        </div>
        <div class="col-sm-7" >
            <?php if (isset($whatsapp_xtract) && $whatsapp_xtract['success'] === TRUE) {?>
                <h2>Resultado procesado</h2>
                <div class="crypter_data_response">                    
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

<script type="text/javascript">
    $(document).ready(function() {
        $.isLoading({ text: "Cargando..." });
        setTimeout( function(){ 
            $.isLoading( "hide" );
        }, 2000 );
        
        
        $('#section_session_list').append($('#session_list').html());
        
        $('[data-toggle="tooltip"]').tooltip({
            placement   : 'right',
            html        : true,
            title       : function(){
                            var $data = $(this).data('own');
                            $data = jQuery.parseJSON("{" + $data + "}");
                            return '<div class="tooltip_template_info"><div class="row"><div class="col-md-4 title">Id</div><div class="col-md-6">'+$data.id+'</div></div><div class="row"><div class="col-md-4 title">Estatus</div><div class="col-md-6">'+$data.status+'</div></div><div class="row"><div class="col-md-4 title"># Msg</div><div class="col-md-6">'+$data.msg+'</div></div><div class="row"><div class="col-md-4 title"># Msg sin leer</div><div class="col-md-6">'+$data.msg_nr+'</div></div></div>'
                        }
        });
        
        $('#chatsession a').click(function(){           
            $('.sel_seccion_icon').remove();
            $(this).parent().append('<i class="fa fa-check sel_seccion_icon"></i>');               
        });
        
        $('#msg_5215527411341').DataTable();
    });
</script>