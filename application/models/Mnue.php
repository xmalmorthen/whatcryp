<?php defined('BASEPATH') OR exit('No direct script access allowed');
class mnue extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_mnu_from_bd($perfil){        
        /*
         * Implementar funcionalidad para obtener menu de bd
         */
        if ($perfil == 1) {
            $data = array(
                'id'        => 1,
                'opc'       => 'xmalmorthen',
                'html'      => '<li><a href="'.site_url('administrar').'"><i class="fa fa-cogs"></i>&nbsp; Administración</a></li><li><a href="'.site_url('ayuda').'"><i class="fa fa-question-circle"></i></i>&nbsp; Ayuda</a></li>',
                'perfil'    => 1,
            );            
        }
        /*
         * Implementar funcionalidad para obtener menu de bd
         */
        //opciones por default
        $data['html'] = ($this->users->verify_session() ? '<li><a href="'.site_url('main').'"><i class="fa fa-puzzle-piece"></i>&nbsp; Whatsapp Decrypter</a></li>' : '') . (isset($data['html']) ? $data['html'] : '') . '<li><a href="'.site_url('acerca_de').'"><i class="fa fa-info-circle"></i></i>&nbsp; Acerca de...</a></li>';        
        return $data;
    }

}
