<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of uploader
 *
 * @author Rana
 */
class decryptwhatsapp {
    public function __construct() {
        set_time_limit(0);
    }
    
    public function do_decrypt($database_folder,&$data){        
        try
        {
            $file_name = utils::get_uniqueidentifier();
            $output_file = WHATSAPP_XTRACT_OUTPUT_FOLDER . $file_name;
            $cmd = PYTHON . ' ' . APPPATH . WHATSAPP_XTRACT_FOLDER . WHATSAPP_XTRACT . ' -i ' . $database_folder . '/' . $data['uploaded_file']['file_name'] . ' -o ' . $output_file;            
            ob_implicit_flush(true);		
            $exe_command = $cmd;
            $descriptorspec = array(
                    0 => array("pipe", "r"),  // stdin
                    1 => array("pipe", "w"),  // stdout -> we use this
                    2 => array("pipe", "w")   // stderr 
            );
            $process = proc_open($exe_command, $descriptorspec, $pipes, getcwd());
	
            $this->time_start();
	
            stream_set_blocking($pipes[1], 0);
            stream_set_blocking($pipes[2], 0);
	
            $output = '';
            $output_err = '';
            if (is_resource($process))
            {	                
                while( ! feof($pipes[1]))
                {
                    if ($this->time_end() >= 30) { 
                        cancel($process);
                        break;
                    }

                    $output .= fgets($pipes[1], 1024);
                    $output_err .= fgets($pipes[2], 1024);
                }
                @fclose($pipes[1]);

                if (empty($output)){
                    while( ! feof($pipes[2]))
                    {
                        $output_err .= fgets($pipes[2], 1024);
                    }
                    @fclose($pipes[2]);
                }
            }
            
            if (!$output) {
                throw new Exception($output_err);
            } else {
                if (!file_exists(APPPATH."views/".WHATSAPP_XTRACT_OUTPUT_VIEW."/{$file_name}".EXT)){
                    throw new Exception($output . ' <br/>' . $output_err);
                } else {
                    $data['whatsapp_xtract']['success'] = TRUE;
                    $data['whatsapp_xtract']['message'] = 'Base de datos procesada correctamente...!!!';
                    $data['whatsapp_xtract']['cmd_response'] = $output;
                    $data['whatsapp_xtract']['cmd_response_err'] = $output_err;
                    $data['whatsapp_xtract']['output_file'] = $output_file;
                    $data['whatsapp_xtract']['file_name'] = $file_name;
                }
                return TRUE;
            }                        
        }
        catch(Exception $err)
        {
            $data['whatsapp_xtract']['success'] = FALSE;
            $data['whatsapp_xtract']['message'] = $err->getMessage();
            return FALSE;
        }        
    }
    
    function time_start() {
		global $starttime;
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime; 
	}	
	 
    function time_end() {
            global $starttime;
            $mtime = microtime();
            $mtime = explode(" ",$mtime);
            $mtime = $mtime[1] + $mtime[0];
            return ($mtime - $starttime); 
    }

    function cancel($process){
            $pstatus = proc_get_status($process);
            if (!strlen($pstatus["exitcode"]) || $pstatus["running"]) {
                    if ($pstatus["running"])
                            proc_terminate($process);
                    $ret = proc_close($process);
            } else {
                    if ((($first_exitcode + 256) % 256) == 255 
                                    && (($pstatus["exitcode"] + 256) % 256) != 255)
                            $ret = $pstatus["exitcode"];
                    elseif (!strlen($first_exitcode))
                            $ret = $pstatus["exitcode"];
                    elseif ((($first_exitcode + 256) % 256) != 255)
                            $ret = $first_exitcode;
                    else
                            $ret = 0; /* we "deduce" an EXIT_SUCCESS ;) */
                    proc_close($process);
            }
            return ($ret + 256) % 256;
    }
}