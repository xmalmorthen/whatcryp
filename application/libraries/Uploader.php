<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of uploader
 *
 * @author Rana
 */
class uploader {
    var $config;
    public function __construct() {
        $this->ci =& get_instance();
        
        $this->config =  array(
                  'upload_path'     => DATABASE_PATH,
                  'allowed_types'   => "*",
                  'overwrite'       => TRUE
                );
    }
    
    public function do_upload(){        
        //$this->remove_dir($this->config["upload_path"], false);
        $data = array();
        $this->ci->load->library('upload', $this->config);        
        if($this->ci->upload->do_upload())
        {
            $data['message'] = "File Uploaded Successfully";
            $data['success'] = TRUE;
            $data['uploaded_file'] = $this->ci->upload->data();
        }
        else
        {
            $data['message'] = $this->ci->upload->display_errors();
            $data['success'] = FALSE;
        }
        return $data;
    }
    
    function remove_dir($dir, $DeleteMe) {
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