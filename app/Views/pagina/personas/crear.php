<?php $this->extend("template/layout"); ?>

<?php $this->section("titulo");?>
Crear persona CodeIgniter 4
<?php $this->endSection("titulo");?> 


<?php $this->section("contenido");?>
<main class="auth">
    <h1 class="auth__titulo">Crear persona</h1>
    
    <?php echo view("template/alertas", [
        "alertas" => $alertas
    ]); ?>

    <div class="acciones acciones--right">
        <a href="<?php echo base_url() . "/inicio/personas" ;?>" class="acciones__boton">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Volver
        </a>
    </div>

    <form class="formulario" method="POST" enctype="multipart/form-data">
       <input type="hidden" name="id" value="<?php echo $persona->id;?>">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Nombre del producto" value="<?php echo $persona->nombre;?>">
        </div>
        <div class="formulario__campo">
            <label for="image" class="formulario__label">Imagen</label>
            <input type="file" class="formulario__input" name="archivo[]" data-max-files="10" multiple >
        </div>
        <input type="submit" class="formulario__submit" value="Enviar">
    </form>
</main>
<?php $this->endSection("contenido"); ?>

<?php $this->section("js");?>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement);
    FilePond.setOptions({
        labelIdle:
            'Arrastra y suelta tu imagen o  <u style="cursor:pointer;">Selecciona</u>',
        server:{
            process: "http://codeigniter.cm/public/inicio/personas/process",
            revert: "http://codeigniter.cm/public/inicio/personas/revert"
        }
    })
</script>
<?php $this->endSection("js"); ?>