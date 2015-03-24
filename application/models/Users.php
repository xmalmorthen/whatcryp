<?php defined('BASEPATH') OR exit('No direct script access allowed');
class users extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function set_session_user($usr){
        $data = $this->get_user($usr);
                        
        $user_session = array(
            'user_session'  => TRUE,
            'id'            => $data['id_user'],
            'username'      => $data['username']
        );
        $this->session->set_userdata($user_session);
    }
        
    public function unset_session_user(){
        $array_items = array(
            'user_session',
            'id',
            'username'
        );
        $this->session->unset_userdata($array_items);        
    }
    
    public function verify_session(){
        return $this->session->has_userdata('user_session') != NULL && $this->session->has_userdata('user_session') === TRUE;
    }
    
    public function get_user($usr = NULL){        
        $data = NULL;
        if (!$usr) {
            $data = $this->get_user_from_session();            
        } else {
            $data = $this->get_user_from_bd($usr);
        }        
        return $data;
    }
    
    private function get_user_from_bd($usr){
        /*
         * Implementar funcionalidad para obtener usuario de bd
         */
        $data = array(
            'id_user'   => 1,
            'username'  => 'xmalmorthen',
            'pwd'       => '..121212qw',
            'ap1'       => 'Morthen',
            'ap2'       => '',
            'nombre'    => 'Xmal',
            'correo'    => 'xmal.morthen@gmail.com',
            'perfil'    => 1
        );
        return $data;
    }
    
    private function get_user_from_session(){
        if (!$this->verify_session()) return NULL;
        $data = array(
            'id'        => $this->session->userdata('id'),
            'username'  => $this->session->userdata('username')
        );
        return $data;
    }
    
    public function verify_user($usr,$pwd){
        $data = $this->get_user($usr);        
        return $data && $data['pwd'] == $pwd;
    }
    
    public function get_user_profile($id,$usr){
        if (!$this->verify_session()) return NULL;
        
        
        die(var_dump($this->verify_session()));
        
        $data = $this->get_user($usr);
        if ($data['id'] == $id && $data['username'] == $usr){
            return  $data['perfil'];
        } else {
            return NULL;
        }
    }

}
