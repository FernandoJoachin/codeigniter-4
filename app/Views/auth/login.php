<?php $this->extend("template/layoutAuth"); ?>

<?php $this->section("titulo");?>
Inicio de sesión CodeIgniter 4
<?php $this->endSection("titulo");?> 


<?php $this->section("contenido");?>
<main class="auth">
    <h1 class="auth__titulo">Registro de usuarios</h1>
    
    <?php 
        $errors = session()->get('errors') ?? [];
        echo view("template/alertas", [
            "alertas" => $errors
        ]);
    ?>

    <form class="formulario" method="POST" action="<?php echo base_url();?>">
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input type="email" class="formulario__input" name="email" id="email" placeholder="Tu Email" value="<?= old('email') ?>">
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password</label>
            <input type="password" class="formulario__input" name="password" id="password" placeholder="Tu Password">
        </div>

        <input type="submit" class="formulario__submit" value="Iniciar sesión">
    </form>
    <div class="acciones">
        <a href="<?php echo base_url() . "registro" ;?>" class="acciones__enlace">¿Aún no tiene una cuesta? Crea una</a>
    </div>
</main>
<?php $this->endSection("contenido"); ?>