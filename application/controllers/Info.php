<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class info extends CI_Controller {
    public function __construct()
    {
        parent::__construct();       
        $this->load->library("uploader");
    }
    
    public function ayuda()
    {
        try
        {            
            $this->load->view('ayuda',NULL);
        }
        catch(Exception $err)
        {
            log_message("error",$err->getMessage());
            return show_error($err->getMessage());
        }
    }
    
    public function acerca_de()
    {
        try
        {            
            $this->load->view('acerca_de',NULL);
        }
        catch(Exception $err)
        {
            log_message("error",$err->getMessage());
            return show_error($err->getMessage());
        }
    }
}
