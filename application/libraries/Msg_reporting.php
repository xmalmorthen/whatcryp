<?php //defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Autor: Miguel Angel Rueda Aguilar
 * Fecha: 04-09-2012
 * Descripción: Metodos para la implementacion generica 
 * de salida y representacion de errores
 */
class msg_reporting {
    public function __construct() {}

/*
 * Autor: Miguel Angel Rueda
 * Descripción: envio de mensajes al log de errores del sistema
 * Parámetros:
 *        Entrada: $e - instancia de clase error
 */     
    public static function error_log($e = NULL){        
        if ($e !== NULL) {           
            if (get_class($e) == 'Exception') {
                $_msg = "Code : {$e->getCode()} | " . 
                        "File : {$e->getFile()} | " .                           
                        "Line : {$e->getLine()} | " .
                        "Message : " . utf8_encode($e->getMessage());
            } else {
                $_msg = "Ocurrió un error, pero el parámetro enviado no es un objeto de tipo Exception, no es posible desglosar la información del error...!!!";
            }
            log_message('error',$_msg);
        } 
    }

/*
 * Autor: Miguel Angel Rueda
 * Descripción: envio de mensajes de salida nativa utilizando inyeccion de cabeceras
 * Parámetros:
 *        Entrada: $msglog - mensaje que se almacenara en el log de errores
 *                 $msgoutput -  mensaje de salida al usuario
 *                 $httpcode - codigo de cabecera
 */     
    public static function system_error($msglog = NULL, $msgoutput = NULL, $httpcode = NULL){
        if (function_exists('log_message')) log_message('error',$msglog);
        
        $_msg = $msgoutput ? $msgoutput : "Ocurrió un error con el servicio, favor de contactár al administrador...!!!";
        
        header('Content-Type: text/html; charset=iso-8859-1');
        header('HTTP/1.1: 500');
        header('Status: ' . $httpcode ? $httpcode : '500');
        header('Content-Length: ' . strlen($msglog));
        header('Warning: ' . $_msg);
        
        exit(utf8_decode($_msg));
    }

/*
 * Autor: Miguel Angel Rueda
 * Descripción: envio de mensajes de salida por estructura de servicio REST
 * Parámetros:
 *        Entrada: $msglog - mensaje que se almacenara en el log de errores
 *                 $msgoutput -  mensaje de salida al usuario
 */    
    public static function output_error($msglog = NULL, $msgoutput = NULL){       
        log_message('error',$msglog);
        
        $HTTP_Code = 406;
        $_msg = $msgoutput ? $msgoutput : $msglog;
        
        $CI = & get_instance();
        
        if (method_exists($CI,'response')) {
            $CI->response(
                        reststruct::parse(
                                            FALSE,
                                            'Error',
                                            NULL,
                                            $_msg 
                                            ),
                        $HTTP_Code
                        );            
        } else {
            header('Content-Type: text/html; charset=iso-8859-1');
            header('HTTP/1.1: '. $HTTP_Code);
            header('Status: '. $HTTP_Code);
            header('Content-Length: ' . strlen($_msg));
            header('Warning: ' . $_msg);

            exit(utf8_decode($_msg));
        }
    }
}
