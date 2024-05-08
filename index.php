<?php
    require_once "./config/app.php"; //archivo con información basica del sitio (titulo, nombre, nombre de sesion)
    require_once "./autoload.php"; // Archivo que carga automaticamentes el archivo que necesita
    require_once "./app/views/inc/session_start.php"; // Asigna el nombre de sesión y la inicia

    if( isset($_GET['views'] )) {
        $url = explode("/",$_GET['views']);
    } else {
        $url=["login"];
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require_once "./app/views/inc/head.php"?>
    </head>

    <body>
        <?php 
            use app\controllers\viewsController;
            use app\controllers\loginController;

            $insLogin = new loginController(); //isntancia del  
            $viewsController = new viewsController();

            $vista = $viewsController->obtenerVistasControlador($url[0]);
            
            if ($vista=="login" || $vista=="404") {
                require_once "./app/views/content/".$vista."-view.php";
            } else {

                # Cerrar sesion (filtro de seguridad para no navegar entre pestañas)#
                if( !isset($_SESSION['id']) || !isset($_SESSION['nombre']) || !isset($_SESSION['usuario']) || $_SESSION['id'] == "" ||$_SESSION['nombre'] == "" || $_SESSION['usuario'] == "" )
                {
                    $insLogin->cerrarSesionControlador();
                    exit();
                }
                require_once "./app/views/inc/navbar.php";
                require_once $vista;
            }
            require_once "./app/views/inc/script.php";
        ?>
    </body>
</html>