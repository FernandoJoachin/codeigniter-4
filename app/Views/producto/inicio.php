<?php $this->extend("template/layout"); ?>

<?php $this->section("titulo");?>
CRUD CodeIgniter 4
<?php $this->endSection("titulo");?> 


<?php $this->section("contenido");?>
<main class="inicio">
    <h1 class="inicio__titulo">CRUD de productos</h1>
    <div class="inicio__contenedor-boton">
        <a href="<?php echo base_url() . "inicio/producto/crear";?>" class="inicio__boton">
            <li class="fa-solid fa-circle-plus"></li>
            Agregar Producto
        </a>
    </div>
    <div class="inicion__contenido">
        <?php if(!empty($productos)){?>
            <table class="table">
                <thead class="table__thead">
                    <tr>
                        <th scope="col" class="table__th">Nombre</th>
                        <th scope="col" class="table__th">Precio</th>
                        <th scope="col" class="table__th">Disponibles</th>
                        <th scope="col" class="table__th">Acciones</th>
                    </tr>
                </thead>

                <tbody class="table__tbody">
                    <?php foreach($productos as $producto){?>
                        <tr class="table__tr">
                            <td class="table__td">
                                <?php echo $producto->nombre;?>
                            </td>
                            <td class="table__td">
                                <?php echo $producto->precio;?>
                            </td>
                            <td class="table__td">
                                <?php echo $producto->disponibles;?>
                            </td>
                            <td class="table__td--acciones">
                                <a href="<?php echo base_url() . "inicio/producto/editar/" . $producto->id;?>" class="table__accion table__accion--editar">
                                    <i class="fa-solid fa-user-pen"></i>
                                    Editar
                                </a>
                                <a href="<?php echo base_url() . "inicio/producto/eliminar/" . $producto->id;?>" class="table__accion table__accion--eliminar">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php }?>    
                </tbody>
            </table>
        <?php } else{?>
            <p class="text-center">No hay productos aún</p>
        <?php }?>
    </div>

    <div class="acciones">
        <a href="<?php echo base_url();?>" class="acciones__boton">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Voler a Inicio sesión
        </a>
    </div>
</main>
<?php $this->endSection("contenido"); ?>