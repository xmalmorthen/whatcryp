<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {
    public function index()
    {
        try
        {
            $data['post'] = FALSE;
            if($this->input->post("submit")){
                $this->load->library("uploader");
                
                $path_to_upload = DATABASE_PATH . '/' . utils::get_uniqueidentifier();
                $data = $this->uploader->do_upload($path_to_upload);
                if (is_array($data) && isset($data['success']) && $data['success']){
                    $this->load->library("decryptwhatsapp");
                    if ($this->decryptwhatsapp->do_decrypt($path_to_upload,$data)) {
                        $data['whatsapp_xtract']['view'] = $this->load->view(WHATSAPP_XTRACT_OUTPUT_VIEW."/{$data['whatsapp_xtract']['file_name']}",NULL,TRUE);
                        $this->uploader->remove_dir($path_to_upload, TRUE);                                                
                        @unlink($data['whatsapp_xtract']['output_file']. EXT);
                    }                    
                }
                
                $data['whatsapp_xtract']['success'] = TRUE;
                $data['whatsapp_xtract']['message'] = 'Base de datos procesada correctamente...!!!';
                $data['whatsapp_xtract']['view'] = $this->load->view(WHATSAPP_XTRACT_OUTPUT_VIEW."/550d730710cf6",NULL,TRUE);
                $data['post'] = TRUE;
            }
            $this->load->view('main',array('data' => $data));
        }
        catch(Exception $err)
        {
            log_message("error",$err->getMessage());
            return show_error($err->getMessage());
        }
    }
    
    public function administracion(){
        
    }
}
