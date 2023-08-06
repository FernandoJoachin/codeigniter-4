<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ProductoEntity extends Entity
{
    protected static $alertas = [];

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