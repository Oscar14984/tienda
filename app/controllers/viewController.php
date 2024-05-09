<?php
    namespace app\controllers;
    use app\models\Producto_model; 

    class viewController extends Producto_model {
        public function getViewController($view){
            //si la vista es diferente de ""
            if($view != ""){
                $response= $this->getViewModel($view);
            }else {
                $response="index";
            }
            return $response;
        }
    }