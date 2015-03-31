<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class administrar extends CI_Controller {
    public function __construct()
    {
        parent::__construct();       
        //$this->load->database();
        $this->load->spark( 'grocery-crud/1.4.1');
        $this->load->library('grocery_CRUD');
        $this->grocery_crud->set_theme('flexigrid');
        $this->grocery_crud->set_language('spanish');
    }   
    
    public function index()
    {       
        redirect('administrar/perfiles');
    }
    
    private function _renderoutput($title, $output){
        $data_user = $this->users->get_user();
        $profile = $this->users->get_user_profile($data_user['id'],$data_user['username']);
        $menu = $this->mnue->get_mnu_from_bd($profile);
        $method = $this->router->method;
        $this->load->view('administrar/master_page',array('content' => $output, 'mnu' => $menu['html'], 'title' => $title, 'opc_active' => $method));
    }
    
    public function perfiles(){
        try{           
            $output = $this->load->view('administrar/perfiles',NULL,TRUE);
            $this->_renderoutput('Perfiles', $output);
        }catch(Exception $e){
            /* Si algo sale mal cachamos el error y lo mostramos */
            msg_reporting::error_log($e);
        }
    }
    
    public function usuarios(){
        try{
            $output = $this->load->view('administrar/usuarios',NULL,TRUE);
            $this->_renderoutput('Usuarios', $output);
        }catch(Exception $e){
            /* Si algo sale mal cachamos el error y lo mostramos */
            msg_reporting::error_log($e);
        }
    }
    
    public function perfiles_usuarios(){
        try{
            $output = $this->load->view('administrar/perfiles_usuarios',NULL,TRUE);
            $this->_renderoutput('Perfil de Usuarios', $output);
        }catch(Exception $e){
            msg_reporting::error_log($e);
        }
    }
}