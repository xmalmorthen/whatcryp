<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();       
        $this->load->helper('form');
        
        /*$array_items = array('user_session','id','username');
        $this->session->unset_userdata($array_items);
        die();*/
        
    }   
    
    public function index()
    {       
        $to_go = $this->session->flashdata('togourl');
        if($this->input->post("submit")){
            $usr = $this->input->post("usr");
            $pwd = $this->input->post("pwd");            
            $to_go = $this->input->post("to_go") ? $this->input->post("to_go") : 'main';
            
            $this->load->library('form_validation');
            $this->form_validation->set_message('required', ' El dato es requerido');
            $this->form_validation->set_error_delimiters('<div class="error"><i class="fa fa-exclamation-triangle"></i><span style="color: red;margin-left: 25px;">','</span></div>');
            $this->form_validation->set_rules('usr', 'Usuario',     'required');
            $this->form_validation->set_rules('pwd', 'Contraseña',  'required');
                 
            if ( $this->form_validation->run() ) {
                $response = $this->users->verify_user($usr,$pwd);
                if ($response) {
                    $this->users->set_session_user($usr);
                    redirect ($to_go);                    
                }else {
                    $this->session->set_flashdata('err_login','Usuario y/o contraseña incorrectos !!!');
                }
            }
        }        
        $data = array(
            'to_go' => $to_go
        );        
        $this->load->view('login',$data);
    }
    
    public function logout(){
        $array_items = array('user_session','username');
        $this->session->unset_userdata($array_items);
        redirect('main');
    }
}