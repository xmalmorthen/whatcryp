<?php defined('BASEPATH') OR exit('No direct script access allowed');

class log extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();       
        $this->load->helper('url');
    }   
    
    function index(){
        redirect('log/show');
    }
    
    function show(){                
        $this->load->spark( 'fire_log/0.8.2');
    }
}

/* End of file errorlog.php */
/* Location: ./application/controllers/errorlog.php */