<?php $this->extend("template/layout"); ?>

<?php $this->section("titulo");?>
Editar producto CodeIgniter 4
<?php $this->endSection("titulo");?> 


<?php $this->section("contenido");?>
<main class="auth">
    <h1 class="auth__titulo">Editar producto</h1>
    
    <?php echo view("template/alertas", [
        "alertas" => $alertas
    ]); ?>

    <div class="acciones acciones--right">
        <a href="<?php echo base_url() . "/inicio" ;?>" class="acciones__boton">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Volver
        </a>
    </div>

    <form class="formulario" method="POST">
        <input type="hidden" name="id" value="<?php echo $producto->id;?>">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Nombre del producto" value="<?php echo $producto->nombre;?>">
        </div>
        <div class="formulario__campo">
            <label for="precio" class="formulario__label">Precio</label>
            <input type="number" class="formulario__input" name="precio" id="precio" placeholder="Precio del producto" value="<?php echo $producto->precio;?>">
        </div>
        <div class="formulario__campo">
            <label for="disponibles" class="formulario__label">Disponibles</label>
            <input type="number" class="formulario__input" name="disponibles" id="disponibles" placeholder="Stock del producto" value="<?php echo $producto->disponibles;?>">
        </div>

        <input type="submit" class="formulario__submit" value="Enviar">
    </form>
</main>
<?php $this->endSection("contenido"); ?>