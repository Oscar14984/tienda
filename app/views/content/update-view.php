<?php 
        // include "./app/views/inc/btn_back.php";
        $idProduct = $url[1];
        $data = $viewsController->get_product_by_id($idProduct);

        if($data->rowCount()==1){
            $data =$data->fetch();
        }
?>
<div class="container is-fluid mt-3 mb-3">
	<h1 class="title">Detalles del producto: <?php echo $data['nombre']; ?></h1>
	<h2 class="subtitle">Escriba los datos que desea actulizar</h2>
</div>
<div class="container pt-3 pb-3 "></div>

<form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/productosAjax.php" method="POST" autocomplete="off">

		<input type="hidden" name="select_controller" value="editar">
		<input type="hidden" name="producto_id" value="<?php echo $data['id'];?>">

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<!-- <label>Nombre</label> -->
				  	<input class="input" type="hidden" name="nombre" value="<?php echo $data['nombre'];?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}" maxlength="100" required >
				</div>
		  	</div>
		</div>

        <div class="columns">
            <div class="column">
		    	<div class="control">
					<label>Descripcion</label>
				  	<textarea class="textarea is-small" name="descripcion" value="<?php echo $data['descripcion'];?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,4000}" maxlength="4000" required><?php echo htmlspecialchars($data['descripcion']); ?></textarea>
				</div>
		  	</div>
        </div>
            
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Precio</label>
                    <input class="input" type="number" name="precio" value="<?php echo isset($data['precio']) ? $data['precio'] : ''; ?>" step="0.01" min="0.01" max="99999999.99" required>
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Cantidad</label>
                    <input class="input" type="number" name="cantidad" value="<?php echo isset($data['cantidad']) ? $data['cantidad'] : ''; ?>" step="1" min="0" max="200" required>
				</div>
		  	</div>
		</div>
		
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Actualizar</button>
		</p>
    </form>