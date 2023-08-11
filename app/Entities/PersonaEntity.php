<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PersonaEntity extends Entity
{
    protected static $alertas = [];

    public function validar_persona() {
        if(!$this->nombre) {
            self::$alertas["error"][] = "El nombre es obligatorio";
        }
        return self::$alertas;
    }
}