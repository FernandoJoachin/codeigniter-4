<?php $this->extend("template/layout"); ?>

<?php $this->section("titulo");?>
CRUD CodeIgniter 4
<?php $this->endSection("titulo");?> 


<?php $this->section("contenido");?>
<main class="inicio">
    <h1 class="inicio__titulo">CRUD de personas</h1>
    <div class="inicio__contenedor-boton">
        <a href="<?php echo base_url() . "inicio/personas/crear";?>" class="inicio__boton">
            <li class="fa-solid fa-circle-plus"></li>
            Agregar persona
        </a>
    </div>
    <div class="inicion__contenido">
        <?php if(!empty($personas)){?>
            <table class="table">
                <thead class="table__thead">
                    <tr>
                        <th scope="col" class="table__th">Nombre</th>
                        <th scope="col" class="table__th">Imagen</th>
                        <th scope="col" class="table__th">Acciones</th>
                    </tr>
                </thead>

                <tbody class="table__tbody">
                    <?php foreach($personas as $persona){?>
                        <tr class="table__tr">
                            <td class="table__td">
                                <?php echo $persona->nombre;?>
                            </td>
                            <td class="table__td">
                                <?php echo "imagen"?>
                            </td>
                            <td class="table__td--acciones">
                                <a href="<?php echo base_url() . "inicio/personas/editar/" . $persona->id;?>" class="table__accion table__accion--editar">
                                    <i class="fa-solid fa-user-pen"></i>
                                    Editar
                                </a>
                                <a href="<?php echo base_url() . "inicio/personas/eliminar/" . $persona->id;?>" class="table__accion table__accion--eliminar">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php }?>    
                </tbody>
            </table>
        <?php } else{?>
            <p class="text-center">No hay personas aún</p>
        <?php }?>
    </div>

    <div class="acciones">
        <a href="<?php echo base_url();?>" class="acciones__boton">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Voler a Inicio sesión
        </a>
        <a href="<?php echo base_url() . "inicio";?>" class="acciones__boton">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Volver a CRUD productos
        </a>
    </div>
</main>
<?php $this->endSection("contenido"); ?>