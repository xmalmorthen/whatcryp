<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {
    public function __construct()
    {
        parent::__construct();       
        $this->load->library("uploader");
    }
    
    public function index()
    {
        try
        {
            $data['post'] = FALSE;
            if($this->input->post("submit")){
                $path_to_upload = DATABASE_PATH . '/' . utils::get_uniqueidentifier();
                $data = $this->uploader->do_upload($path_to_upload);
                $data['post'] = TRUE;
                if (is_array($data) && isset($data['success']) && $data['success']){
                    $this->load->library("decryptwhatsapp");
                    if ($this->decryptwhatsapp->do_decrypt($path_to_upload,$data)) {                         
                        $data['whatsapp_xtract']['success'] = TRUE;
                        $data['whatsapp_xtract']['message'] = 'Base de datos procesada correctamente...!!!'; 
                        
                        $params = array(
                            'data'  => $data,
                            'path_to_upload' => $path_to_upload,
                            'view'  => $data['whatsapp_xtract']['file_name']
                        );
                        $this->session->set_flashdata('params',$params);
                        redirect("main/show_result");
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
    
    public function show_result(){        
        $params = $this->session->flashdata('params');
        $data = $params['data'];
        $path_to_upload = $params['path_to_upload'];
        $data['whatsapp_xtract']['view'] = $this->load->view(WHATSAPP_XTRACT_OUTPUT_VIEW."/{$params['view']}",NULL,TRUE);
        @$this->uploader->remove_dir($path_to_upload, TRUE);
        @unlink($data['whatsapp_xtract']['output_file']. EXT);
        
        $this->load->view('main',array('data' => $data));
    }
    
    public function administracion(){
        
    }
}
