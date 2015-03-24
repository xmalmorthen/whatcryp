<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class verifyuser{
    private $_CI;

    public function  __construct() {
    	$this->_CI = & get_instance();        
    }    

    public function validateUser($params = NULL){
        $method = $this->_CI->router->method;
        $controller = $this->_CI->router->class;
                
        if (in_array($controller, $params)) {return;}
        
        $user = $this->_CI->session->has_userdata('user_session');
        if($user == FALSE){ //Si no está el usuario autentificado, redirecciona a login.
            $this->_CI->session->set_flashdata('togourl',$this->_CI->uri->uri_string());
            redirect('login');
            //exit();
        }
    }	
}