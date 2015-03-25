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

<div class="inner cover">                    
    <div class="row">
        <div class="col-sm-6 col-md-8 col-md-offset-2 form_content" >                            
            <h1 class="text-center login-title">Inicie sesión</h1>
            <br/>
            <?php if ($this->session->flashdata('err_login') != NULL) { ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Error !!!</strong> <?php echo $this->session->flashdata('err_login'); ?>
            </div>
            <?php } ?>
            <div class="account-wall">
                <form class="form-horizontal" action="login" method="POST">                                    
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Usuario</label>
                      <div class="col-sm-9" style="text-align: left;">
                          <i class="fa fa-user fa-4x"></i>
                          <input type="text" class="form-control" id="usr" name="usr" placeholder="Usuario" autofocus="true" value="<?php //echo set_value('usr'); ?>">
                          <?php echo form_error('usr'); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-3 control-label">Contraseña</label>
                      <div class="col-sm-9" style="text-align: left;">
                          <i class="fa fa-key fa-4x"></i>
                          <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Contraseña" value="<?php //echo set_value('pwd'); ?>">
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
                    <input type="hidden" id="to_go" name="to_go" value="<?php echo $to_go; ?>">
                </form>
            </div>
        </div>
    </div>
</div>