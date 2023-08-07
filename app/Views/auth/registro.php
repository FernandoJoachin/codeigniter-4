<?php $this->extend("template/layoutAuth"); ?>

<?php $this->section("titulo");?>
Registro CodeIgniter 4
<?php $this->endSection("titulo");?> 


<?php $this->section("contenido");?>
<main class="auth">
    <h1 class="auth__titulo">Crear cuenta</h1>
    <?php echo view("template/alertas", [
        "alertas" => $alertas
    ]); ?>
    <form class="formulario" method="POST" action="<?php echo base_url() . "/registro";?>">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Tu Nombre">
        </div>
        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input type="text" class="formulario__input" name="apellido" id="apellido" placeholder="Tu Apellido">
        </div>
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input type="email" class="formulario__input" name="email" id="email" placeholder="Tu Email">
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password</label>
            <input type="password" class="formulario__input" name="password" id="password" placeholder="Tu Password">
        </div>

        <input type="submit" class="formulario__submit" value="Crear cuenta">
    </form>
    <div class="acciones">
    <a href="<?php echo base_url();?>" class="acciones__enlace">¿Ya tienes una cuesta? Inicia sesión</a>
    </div>
</main>
<?php $this->endSection("contenido"); ?>