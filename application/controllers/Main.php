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
                
                $path_to_upload = DATABASE_PATH . '/' . $_FILES['userfile']['name'] . '.' . utils::get_uniqueidentifier();
                $data = $this->uploader->do_upload($path_to_upload);
                
                if (is_array($data) && isset($data['success']) && $data['success']){
                    $this->load->library("decryptwhatsapp");
                    if ($this->decryptwhatsapp->do_decrypt($data)) {                        
                        $data['whatsapp_xtract']['file_name']['view'] = $this->load->view(WHATSAPP_XTRACT_OUTPUT_VIEW."/{$whatsapp_xtract['file_name']}",NULL,TRUE);                        
                        $this->uploader->remove_dir($path_to_upload, TRUE);                                                
                        @unlink($data['whatsapp_xtract']['output_file']);
                    }
                }
            }
            $this->load->view('main',array('data' => $data));
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
