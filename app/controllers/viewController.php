<?php
    namespace app\controllers;
    use app\models\Producto_model; 

    class viewController extends Producto_model {
        public function getViewController($view){
            if($view != ""){
                $response= $this->getViewModel($view);
            }else {
                $response="index";
            }
            return $response;
        }
    }