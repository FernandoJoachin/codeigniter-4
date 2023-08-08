<?php $this->extend("template/layout"); ?>

<?php $this->section("titulo");?>
Enviar Email CodeIgniter 4
<?php $this->endSection("titulo");?> 


<?php $this->section("contenido");?>
<main class="auth">
    <h1 class="auth__titulo">Enviar Email</h1>

    <div class="acciones acciones--right">
        <a href="<?php echo base_url() . "/inicio" ;?>" class="acciones__boton">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Volver
        </a>
    </div>

    <form class="formulario" method="POST">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Tu Nombre">
        </div>
        <div class="formulario__campo">
            <label for="asunto" class="formulario__label">Asunto</label>
            <input type="text" class="formulario__input" name="asunto" id="asunto" placeholder="Asunto del correo">
        </div>
        <div class="formulario__campo">
            <label for="descripcion" class="formulario__label">Descripción</label>
            <textarea class="formulario__input" name="descripcion" id="descripcion" placeholder="Descripción del correo" rows="8"></textarea>
        </div>
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input type="email" class="formulario__input" name="email" id="email" placeholder="Email a enviar el correo">
        </div>

        <input type="submit" class="formulario__submit" value="Enviar">
    </form>
</main>
<?php $this->endSection("contenido"); ?>