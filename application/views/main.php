<div class="inner cover">
    <h1 class="cover-heading">Whatsapp Decrypter</h1>
    <br/>
    <!-- form -->
    <div class="row">
        <?php echo $this->load->view('form_decrypter',NULL,TRUE); ?>
    </div>
    <!-- end - form -->
    <br/><br/><br/>
    <?php if ($data['post']) { ?>
    <!-- cry response -->
    <div class="row">                    
        <?php echo $this->load->view('crypter_response',$data,TRUE); ?>                    
    </div>
    <!-- end - cry response -->
    <?php } ?>
</div>
