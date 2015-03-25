<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class administrar extends CI_Controller {
    public function __construct()
    {
        parent::__construct();       
        $this->load->database();
        $this->load->helper('url');
        $this->load->spark( 'grocery-crud/1.4.1');
    }   
    
    public function index()
    {       
        try{
            die(var_dump($this));
            
            $this->grocery_crud->set_theme('flexigrid');
            $this->grocery_crud->set_table('ca_perfiles');
            $this->grocery_crud->set_subject('Perfiles de usuario');
            $this->grocery_crud->set_language('spanish');
            $this->grocery_crud->required_fields(
              'perfil'
            );
            $this->grocery_crud->columns(
              'perfil'
            );
            $output = $this->grocery_crud->render();
            $this->load->view('administrar/perfiles', array('output' => $output));

        }catch(Exception $e){
            /* Si algo sale mal cachamos el error y lo mostramos */
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }
}