<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class parseoutput{
    public function do_output(){
        $CI = & get_instance();    

        $controller = $CI->router->class;
        
        $data_user = $CI->users->get_user();        
        $profile = $CI->users->get_user_profile($data_user['id'],$data_user['username']);        
        $menu = $this->make_menu($profile);
        
        if ($controller != 'log') {        
            $CI->output->set_output($CI->load->view('master_page',array('content' => $CI->output->get_output(), 'mnu' => $menu['html']),TRUE));
        }
	$CI->output->_display();
    }	
    
    private function make_menu($profile){
        $CI = & get_instance();
        $CI->load->model('mnue');
        return $CI->mnue->get_mnu_from_bd($profile);
    }
    
}