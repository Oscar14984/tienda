<div class="container is-fluid mb-6">
	<h1 class="title">Productos</h1>
	<h2 class="subtitle">Lista de productos</h2>
</div>
<div class="container pb-6 pt-6">

    <?php
        use app\controllers\productosController;
        
        $list = new productosController();
		
        echo $list->index();
    ?>