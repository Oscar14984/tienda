<?php
    namespace app\controllers;
    use app\models\Producto_model;

    # Controlador para registrar un usuario #
    class productosController extends Producto_model {
        public function index(){

            //obtengo la data desde el modelo Productos
			$data = $this->get_all_products(); //Ejecuto
			$data = $data->fetchAll(); //guardo los datos en un arraya asociativo
            //muestro la data
			$table="";
			$table.= '
						<div class="table-container">
							<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
								<thead>
									<tr>
										<th class="has-text-centered">id</th>
										<th class="has-text-centered">Nombre</th>
										<th class="has-text-centered">Descripcion</th>
										<th class="has-text-centered">Precio</th>
										<th class="has-text-centered">Cantidad</th>
										<th class="has-text-centered">Modificar producto</th>
										<th class="has-text-centered">Eliminar</th>
									</tr>
								</thead>
								<tbody>
				';
				foreach($data AS $rows) {
					$table.='
							<tr class="has-text-centered">
								<td>'.$rows['id'].'</td>
								<td>'.$rows['nombre'].'</td>
								<td>'.$rows['descripcion'].'</td>
								<td>'.$rows['precio'].'</td>
								<td>$'.$rows['cantidad'].'</td>
								<td>
									<a href="'.APP_URL.'update/'.$rows['id'].'/" class="button is-success is-rounded is-small">Actualizar</a>
								</td>
								<td>
									<form class="FormularioAjax" action="'.APP_URL.'app/ajax/productosAjax.php" method="POST" autocomplete="off">

										<input type="hidden" name="prducto_id" value="eliminar">
										<input type="hidden" name="producto_id" value="'.$rows['id'].'">

										<button type="submit" class="button is-danger is-rounded is-small">Eliminar</button>
									</form>
								</td>
							</tr>
					';
				}

			$table.= '
							</tbody>
						</table>
					</div>
			';
			return $table;
        }

		public function editar($id){

			//obtengo la data desde el modelo Productos
			$data = $this->get_product_by_id($id); 

			// si no hay registros no existe el producto
			if($data->rowCount()<=0){
		        $alert=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El id del producto no se encuatra en el sistema",
					"icono"=>"error"
				];
				return json_encode($alert);
		        exit();
		    }else{
				//este fetch no es necesario
		    	$data=$data->fetch();

				# Almacenamos datos enviados por el formulario #
				$nombre=$_POST['nombre'];
				$descripcion=$_POST['descripcion'];
				$precio=$_POST['precio'];
				$cantidad=$_POST['cantidad'];
		    }

			# Verificando campos obligatorios #
            if($descripcion=="" || $cantidad =="" || $precio==""){
		    	$alert=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>" Alguno de los campos esta vacio ",
					"icono"=>"error"
				];
				return json_encode($alert);
		        exit();
		    }


			$data_update =[
				[
					"campo_nombre"=>"nombre",
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
				[
					"campo_nombre"=>"descripcion",
					"campo_marcador"=>":Descripcion",
					"campo_valor"=>$descripcion
				],
				[
					"campo_nombre"=>"precio",
					"campo_marcador"=>":Precio",
					"campo_valor"=>$precio
				],
				[
					"campo_nombre"=>"cantidad",
					"campo_marcador"=>":Cantidad",
					"campo_valor"=>$cantidad
				],
			];
			
			$id_condition =[
				"condicion_campo"=>"id",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
				
			];

			if ($this->update_product($data_update, $id_condition)){
				$alert=[
					"tipo"=>"recargar",
					"titulo"=>"Usuario Actualizadp",
					"texto"=>"El producto ".$data['nombre']." se actulizo con exito" ,
					"icono"=>"success"
				];
			}else{
				$alert=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No se pudo actulizar el producto por favor intente nuevamente",
					"icono"=>"error"
				];
			}
			return json_encode($alert);
		}
    }