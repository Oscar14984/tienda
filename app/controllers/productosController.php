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
									<a href="'.APP_URL.'update-view/'.$rows['id'].'/" class="button is-success is-rounded is-small">Actualizar</a>
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

		// public function editar(){

		// }
    }