<?php
    require_once "../../config/app.php";
	require_once "../views/templates/session_start.php";
	require_once "../../autoload.php";

    use app\controllers\productosController;

    if(isset($_POST['select_controller'])) {
        $insProdutos = new productosController();
    
        switch ($_POST['select_controller']) {
            case "eliminar":
                // echo $insProdutos->eliminar();
                break;
    
            case "editar":
                $idProduct = $_POST['producto_id'];
                echo $insProdutos->editar($idProduct);
                break;

            default:
                echo "no hay un caso disponible en los métodos del controlador";
                break;
        }
    }