<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Clase que representa una entidad de producto.
 *
 * @property int    $id           ID único del producto.
 * @property string $nombre       Nombre del producto.
 * @property float  $precio       Precio del producto.
 * @property int    $disponibles  Cantidad disponible en stock del producto.
 */
class ProductoEntity extends Entity
{
     /**
     * Array estático para almacenar alertas de validación.
     *
     * @var array
     */
    protected static $alertas = [];

    /**
     * Valida la entidad de producto y agrega alertas si hay problemas.
     *
     * @return array Alertas de validación. Si está vacío, la validación fue exitosa.
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