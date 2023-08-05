<?php $this->extend("template/layout"); ?>

<?php $this->section("titulo");?>
CRUD CodeIgniter 4
<?php $this->endSection("titulo");?> 


<?php $this->section("contenido");?>
<main class="auth">
    <h1 class="auth__titulo">CRUD de productos</h1>
    <a href="<?php echo base_url();?>" class="acciones__enlace">Regresar a Inicio sesión</a>
    </div>
</main>
<?php $this->endSection("contenido"); ?>