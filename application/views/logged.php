<style type="text/css">
    #header_area {
        z-index: 09;
        background-color: #333;
        padding-bottom: 13px;
    }
    #header_area .user_icon {
        float: left;
        border: 1px solid #4F4F4F;
        padding: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }
    #header_area .user_session_data{
        float: left;
        margin: 15px 0 0 7px;
        text-align: left;
    }
    #header_area #logout {
        float: left;
        margin: 20px 0 0px 11px;
        color: #B61515;
    }
</style>

<div id="header_area" class="masthead clearfix">
    <div class="inner">
        <?php if ($this->users->verify_session()) { ?>
            <div class="masthead-brand ">
                <i class="fa fa-user fa-3x user_icon"></i>
                <div class="user_session_data">
                    <span style="display: block; font-size: .8em;">Bienvenido !!!</span>
                    <span><?php $data = $this->users->get_user(); echo $data['nombre']; ?></span>                    
                </div>
                <a id="logout" href="<?php echo site_url('login/logout'); ?>" title="Cerrar sesión !!!"><i class="fa fa-user-times fa-2x"></i></a>                
            </div>
        <?php } ?>        
        <nav>
            <ul class="nav masthead-nav">
                <?php echo $opts_mnu; ?>
            </ul>            
        </nav>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#header_area #logout').tooltip({
            placement   : 'bottom'
        });
    });

</script>
