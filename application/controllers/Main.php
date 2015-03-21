<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

    public function index()
    {
        try
        {
            $data = NULL;

            if($this->input->post("submit")){                     
                $this->load->library("uploader");
                $data = $this->uploader->do_upload();
                
                if (is_array($data) && isset($data['success']) && $data['success']){
                    $this->load->library("decryptwhatsapp");
                    if ($this->decryptwhatsapp->do_decrypt($data)) {
//die(var_dump(APPPATH."views/".WHATSAPP_XTRACT_OUTPUT_VIEW."/{$data['whatsapp_xtract']['file_name']}".EXT));
                        $data['whatsapp_xtract']['success'] = file_exists(APPPATH."views/".WHATSAPP_XTRACT_OUTPUT_VIEW."/{$data['whatsapp_xtract']['file_name']}".EXT) ? TRUE : FALSE;                        
                    }
                }
            }
            $this->load->view('main',$data);
        }
        catch(Exception $err)
        {
            log_message("error",$err->getMessage());
            return show_error($err->getMessage());
        }
    }
    
    public function loadxtract($view){
        $this->load->view(WHATSAPP_XTRACT_OUTPUT_VIEW . '/' . $view);
    }
}
