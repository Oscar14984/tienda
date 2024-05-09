<?php
    namespace app\models;
    use \PDO;

    if(file_exists(__DIR__."/../../config/server.php")){
        require_once __DIR__."/../../config/server.php";
    }

    class Producto_model {
        private $server=DB_SERVER;
        private $db=DB_NAME;
        private $user=DB_USER;
        private $pass=DB_PASS;

        protected function conectar(){
            $conexion = new PDO("mysql:host=".$this->server.";dbname=".$this->db, $this->user,$this->pass);
            $conexion->exec("SET CHARACTER SET utf8");
            return $conexion;
        }

        protected function getViewModel($view) {
            // redirecciona a dashboard si se pone index

            $pages = ["dashboard","update"];

            if (in_array($view, $pages)){
                if(is_file("./app/views/content/".$view."-view.php")){
                    $content = "./app/views/content/".$view."-view.php";
                } else {
                    $content = "404";
                }

            }elseif($view=="dashboard" || $view=="index"){
                $content="dashboard";
            } else {
                $content="404";
            }
            return $content;
        }  


        //get_all_products(): Devuelve todos los productos.
        public function  get_all_products() {
            $query = "SELECT * FROM productos";
            $sql = $this->conectar()->prepare($query);
            $sql->execute();
            return $sql;
        }

        // get_product_by_id($id): Devuelve los detalles de un producto por su ID.
        public function get_product_by_id($id){
            $query = "SELECT * FROM productos WHERE id=$id";
            $sql = $this->conectar()->prepare($query);
            $sql->execute();
            return $sql;
        }
        // create_product($data): Inserta un nuevo producto en la base de datos.
        public function create_product($data) {

                $query =  "INSERT INTO productos(";
    
                $c=0;
                foreach($data AS $clave){
                    if($c>=1){ $query.=","; } 
                    $query.=$clave["campo_nombre"];
                    $c++;
                }
    
                $query .=")VALUES(";
    
                $c=0;
                foreach($data AS $clave){
                    if($c>=1){ $query.=","; } 
                    $query.=$clave["campo_marcador"];
                    $c++;
                }
    
                $query.=")";
                $sql=$this->conectar()->prepare($query);
    
                foreach($data AS $clave) {
                    $sql->bindParam($clave["campo_marcador"],$clave["campo_valor"]);
                }
    
                $sql->execute();
    
                return $sql;
            
        }

        public function update_product($data, $id){
            $query="UPDATE productos SET ";
            
            $C=0;
            foreach ($data AS $clave) {
                if($C>=1){ $query.= ","; }
                $query.=$clave["campo_nombre"]."=".$clave["campo_marcador"];
                $C++;
            }

            $query.=" WHERE ".$id["condicion_campo"]."=".$id["condicion_marcador"];

            $sql=$this->conectar()->prepare($query);

            foreach ($data AS $clave) {
                $sql->bindParam($clave["campo_marcador"],$clave["campo_valor"]);
            }

            $sql->bindParam($id["condicion_marcador"],$id["condicion_valor"]);

            $sql->execute();
            
            return $sql;
        }

        // update_product($id, $data): Actualiza los detalles de un producto.
        // delete_product($id): Elimina un producto de la base de datos por su ID
    }