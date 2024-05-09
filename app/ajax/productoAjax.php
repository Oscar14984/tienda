<?php
    require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";

    use app\controllers\productosController;

    if(isset($_POST['producto_id'])){

        $insUsuario = new productosController();

        if ($_POST['producto_id'] == "eliminar") {
            echo $insUsuario->eliminar();
        }

        if ($_POST['producto_id'] == "editar") {
            echo $insUsuario->editar();
        }


    } 