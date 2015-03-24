<div class="masthead clearfix">
    <div class="inner">
        <?php if ($this->users->verify_session()) { ?>
            <div class="masthead-brand">
                Info de usuario !!!
            </div>
        <?php } ?>        
        <nav>
            <ul class="nav masthead-nav">
                <?php echo $opts_mnu; ?>
            </ul>            
        </nav>
    </div>
</div>
