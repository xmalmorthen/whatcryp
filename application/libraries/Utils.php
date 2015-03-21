<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * funciones varias
 *
 * @author xmalmorthen
 */

class utils {
#function: obtiene la fecha del sistema en formato DD/MM/YYYY
    public static function fecha(){       
        return date('d/m/Y');
    }

#function: obtiene la hora del sistema en formato hh:mm:ss    
    public static function hora(){       
        return date("H:i:s");
    }    
    
#function: genera un uniqueidentifier
    public static function get_uniqueidentifier(){
        try {               
            if ( function_exists('uniqid') ) {
                return uniqid();
            } else {
                return NULL;
            }           
        } catch (Exception $e) {                      
            msg_reporting::output_error($e->getMessage());
        } 
    }    

#function: obtener datos de archivo de configuracion
    public static function get_ini(){
        $CI = &get_instance();
        
        $CI->load->library('ini_cnfg');
        return $CI->ini_cnfg->parse();                  
    }    

#function: desencriptar cadena en base a una semilla    
    public static function decrypt($string, $key) {
        $result = '';
        $string = base64_decode($string);
        for($i=0; $i<strlen($string); $i++) {
           $char = substr($string, $i, 1);
           $keychar = substr($key, ($i % strlen($key))-1, 1);
           $char = chr(ord($char)-ord($keychar));
           $result.=$char;
        }
        return $result;
    }

#function: encriptar cadena en base a una semilla        
    public static function encrypt($string, $key) {
        $result = '';
        for($i=0; $i<strlen($string); $i++) {
           $char = substr($string, $i, 1);
           $keychar = substr($key, ($i % strlen($key))-1, 1);
           $char = chr(ord($char)+ord($keychar));
           $result.=$char;
        }
        return base64_encode($result);
    }
    
#function: borrar elemento de un array
    public static function array_delete ($needle, $haystack, $all = true) {
        $haystack_updated = $haystack;
        foreach ($haystack as $num => $val) {
            if ($val == $needle && $all) {
                unset ($haystack_updated [$num]);
            }
            elseif ($val == $needle && $all === false && !isset ($done)) {
                $done = true;
                unset ($haystack_updated [$num]);
            }
        }
        $haystack_updated = array_values ($haystack_updated);
        return $haystack_updated;
    }   
    
    public static function truncateString($str, $chars, $to_space, $replacement="...") {
        if($chars >= strlen($str)) return $str;
        $str = substr($str, 0, $chars);
        $space_pos = strrpos($str, " ");
        if($to_space && $space_pos >= 0) {
            $str = substr($str, 0, strrpos($str, " "));
        }
        return($str . $replacement);
    }
    
    public static function to_html($data, $headings = TRUE)
    {
        $ci = get_instance();
        $ci->load->library('table');

        $plantilla = array ( 'table_open'  => '<table class="bordered-table">' );
        $ci->table->set_template($plantilla);       
        
        // Multi-dimensional array
        if (isset($data[0]) && is_array($data[0]))
        {
            $headings = array_keys($data[0]);
        }
        // Single array
        else
        {
            $headings = array_keys($data);
            $data = array($data);
        }

        if ( $headings == TRUE) {            
            $ci->table->set_heading($headings);
        }

        foreach ($data as &$row)
        {
            $ci->table->add_row(array_values($row));
        }

        return $ci->table->generate();
    }
    
    
}

class benchmark {
    public function __construct(){}
    
#function: benchmark
    public static function mark($name){
        $CI = &get_instance();
        if (!array_key_exists($name.'_start', $CI->benchmark->marker)) {
            $CI->benchmark->mark($name.'_start');
        } else {       
            $CI->benchmark->mark($name.'_end');
        }
    }

#function: elapsed_time    
    public static function elapsed_time($name){
        $CI = &get_instance();
        return $CI->benchmark->elapsed_time($name.'_start',$name.'_end');
    }
    
}