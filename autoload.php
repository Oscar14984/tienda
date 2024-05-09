<?php
    spl_autoload_register(
        function($clase)
        {
            //Se obtiene la ruta absoluta del directorio actual donde se ejecuta este archivo)
            $archivo = __DIR__."/".$clase.".php"; 
            $archivo=str_replace("\\","/",$archivo); 

            if(is_file($archivo)){
                require_once $archivo;
            }
        }   
    );