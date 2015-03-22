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
    
    public function do_decrypt(&$data){        
        try
        {
            $file_name = utils::get_uniqueidentifier();
            $output_file = WHATSAPP_XTRACT_OUTPUT_FOLDER . $file_name;
            $cmd = PYTHON . ' ' . APPPATH . WHATSAPP_XTRACT_FOLDER . WHATSAPP_XTRACT . ' -i ' . DATABASE_PATH . '/' . $data['uploaded_file']['file_name'] . ' -o ' . $output_file;            
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
	
            if (is_resource($process))
            {	
                $output = '';
                while( ! feof($pipes[1]))
                {
                        if ($this->time_end() >= 2) { 
                                cancel($process);
                                break;
                        }

                        $return_message = fgets($pipes[1], 1024);
                        if (strlen($return_message) == 0) break;
                        $output .= $return_message .'<br />';
                        ob_flush();
                        flush();
                }
                @fclose($pipes[1]); 		
            }
            $data['whatsapp_xtract']['cmd_response'] = $output;
            $data['whatsapp_xtract']['output_file'] = $output_file;
            $data['whatsapp_xtract']['file_name'] = $file_name;
            return TRUE;
        }
        catch(Exception $err)
        {
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