<?php
    spl_autoload_register(
        function($clase)
        {
            // __DIR__ (obtiene la ruta absoluta del directorio actual donde se ejecuta este archivo)
            $archivo = __DIR__."/".$clase.".php"; 
            $archivo=str_replace("\\","/",$archivo); //para sistemas linux ya que no admiten \\ en sus rutas

            if(is_file($archivo)){
                require_once $archivo;
            }
        }   
    );