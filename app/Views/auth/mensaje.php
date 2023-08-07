<?php $this->extend("template/layoutAuth"); ?>

<?php $this->section("titulo");?>
Cuenta confirmada CodeIgniter 4
<?php $this->endSection("titulo");?> 


<?php $this->section("contenido");?>
<main class="auth">
    <h1 class="auth__titulo">Cuenta confirmada</h1>
    <div class="alerta alerta__exito">Cuenta Creada Exitosamente</div>
    <div class="acciones">
    <a href="<?php echo base_url();?>" class="acciones__enlace">Regresar al Inicio sesión</a>
    </div>
</main>
<?php $this->endSection("contenido"); ?>
