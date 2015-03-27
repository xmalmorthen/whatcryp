<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class administrar extends CI_Controller {
    public function __construct()
    {
        parent::__construct();       
        $this->load->database();
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
            $this->grocery_crud->set_table('ca_perfiles');
            $this->grocery_crud->set_subject('Perfil');                        
            $this->grocery_crud->columns('id','perfil','activo','f_act');            
            $this->grocery_crud->fields('perfil','activo');            
            $this->grocery_crud->display_as('id','Identificador');
            $this->grocery_crud->display_as('perfil','Perfil');
            $this->grocery_crud->display_as('activo','Activo');
            $this->grocery_crud->display_as('f_act','Fecha de actualización');
            $this->grocery_crud->required_fields('perfil');            
            $this->grocery_crud->set_rules('perfil','Perfil','max_length[50]');                        
            $output = $this->grocery_crud->render();
            $this->_renderoutput('Perfiles',$output);
        }catch(Exception $e){
            /* Si algo sale mal cachamos el error y lo mostramos */
            msg_reporting::error_log($e);
        }
    }
    
    public function usuarios(){
        try{
            $this->grocery_crud->set_table('ca_usuarios');
            $this->grocery_crud->set_subject('Usuario');                        
            $this->grocery_crud->columns('id','nombre','apellido1','apellido2','nombre','activo','f_act');
            $this->grocery_crud->fields('nombre','apellido1','apellido2','correo','activo','usuario','pwd');
            $this->grocery_crud->display_as('id','Identificador');
            $this->grocery_crud->display_as('nombre','Nombre');
            $this->grocery_crud->display_as('apellido1','Primer apellido');
            $this->grocery_crud->display_as('apellido2','Segundo apellido');
            $this->grocery_crud->display_as('correo','Correo electrónico');
            $this->grocery_crud->display_as('activo','Activo');
            $this->grocery_crud->display_as('f_act','Fecha de actualización');
            $this->grocery_crud->display_as('usuario','Nombre de usuario');
            $this->grocery_crud->display_as('pwd','Contraseña');
            $this->grocery_crud->required_fields('nombre');
            $this->grocery_crud->required_fields('apellido1');
            $this->grocery_crud->set_rules('nombre','Nombre','max_length[50]');
            $this->grocery_crud->set_rules('apellido1','Primer apellido','max_length[50]');
            $this->grocery_crud->set_rules('apellido2','Segundo apellido','max_length[50]');
            $this->grocery_crud->set_rules('correo','Correo electrónico','max_length[100]|valid_email');
            $this->grocery_crud->set_rules('usuario','Nombre de usuario','max_length[50]');
            $this->grocery_crud->set_rules('pwd','Contraseña','max_length[50]');
            $output = $this->grocery_crud->render();
            $this->_renderoutput('Usuarios',$output);
        }catch(Exception $e){
            /* Si algo sale mal cachamos el error y lo mostramos */
            msg_reporting::error_log($e);
        }
    }
}