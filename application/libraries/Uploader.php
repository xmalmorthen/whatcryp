<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of uploader
 *
 * @author Rana
 */
class uploader {
    public function __construct() {
        $this->ci =& get_instance();
    }
    
    public function do_upload($path){        
        $config =  array(
            'upload_path'     => $path,
            'allowed_types'   => "crypt|db|sqlite",
            'overwrite'       => TRUE
        );      
        
        if(!$this->add_dir($config['upload_path'])) {
            $data['message'] = "Imposible crear directorio {$config['upload_path']}, favor de intentarlo mas tarde...!!!";
            $data['success'] = FALSE;
        } else {                   
            $data = array();
            $this->ci->load->library('upload', $config); 

            if($this->ci->upload->do_upload())
            {
                $data['message'] = "Archivo Cargado exitosamente...!!!";
                $data['success'] = TRUE;
                $data['uploaded_file'] = $this->ci->upload->data();
            }
            else
            {            
                $data['message'] = $this->ci->upload->display_errors();
                $data['success'] = FALSE;
            }
        }
        return $data;   
        //$this->remove_dir($config["upload_path"], false);
    }
    
    public function add_dir($dir,$permisions = 0777, $recursive = true) {
        try
        {
            mkdir($dir, $permisions, $recursive);
            return TRUE;
        } catch(Exception $err) {
            return FALSE;
        } 
    }
    
    public function remove_dir($dir, $DeleteMe) {
        if(!$dh = @opendir($dir)) return;
        while (false !== ($obj = readdir($dh))) {
            if($obj=='.' || $obj=='..') continue;
            if (!@unlink($dir.'/'.$obj)) $this->remove_dir($dir.'/'.$obj, true);
        }
 
        closedir($dh);
        if ($DeleteMe){
            @rmdir($dir);
        }    
    }
}