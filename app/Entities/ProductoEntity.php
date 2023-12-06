<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Representa una entidad de producto con métodos para validar la información del producto.
 * 
 * @extends Entity Clase padre para representar una entidad
 */
class ProductoEntity extends Entity
{
    /**
     * Arreglo de mensajes de error.
     *
     * Contiene los mensajes de error correspondientes a las validaciones que no fueron superadas.
     * 
     * @var array
     */
    protected static $alertas = [];

    /**
     * Validar la información del producto.
     * 
     * Este método valida los datos de un producto, para luego retornar el arreglo
     * de los errores cuyas validaciones no fueron superadas.
     *
     * @return array Variable que contiene los mensajes de error.
     */
    public function validar_producto() {
        if(!$this->nombre) {
            self::$alertas["error"][] = "El nombre del producto es obligatorio";
        }
        if(!$this->precio) {
            self::$alertas["error"][] = "El precio del producto es obligatorio";
        }
        if(!$this->disponibles) {
            self::$alertas["error"][] = "El stock del producto es obligatorio";
        }
        return self::$alertas;
    }
}