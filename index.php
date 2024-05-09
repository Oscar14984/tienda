<?php
    require_once "./config/app.php"; //archivo con información basica del sitio (titulo, nombre, nombre de sesion)
    require_once "./autoload.php"; // Archivo que carga automaticamentes el archivo que necesita
    require_once "./app/views/templates/session_start.php"; // Asigna el nombre de sesión y la inicia

    //obtengo el nombre de la vista desde la URL 
    if( isset($_GET['views'] )) {
        $url = explode("/",$_GET['views']);
    } else {
        $url=["dashboard"];
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require_once "./app/views/templates/head.php"?>
    </head>

    <body>
        <!-- <h1><?php //echo $url[0]?></h1> -->
        <?php 
            use app\controllers\viewController;

            //Objeto que hereda los metodos de PrductsController
            $viewsController = new viewController();

            $view = $viewsController->getViewController($url[0]);
            
            if ($view=="dashboard" || $view=="404") {
                require_once "./app/views/content/".$view."-view.php";
            } else {
                require_once $view;
            }

            require_once "./app/views/templates/script.php";
            
        ?>
    </body>
</html>