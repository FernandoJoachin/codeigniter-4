<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Clase que representa una entidad de persona.
 *
 * @property string $nombre Nombre de la persona.
 */
class PersonaEntity extends Entity
{
    /**
     * Array estático para almacenar alertas de validación.
     *
     * @var array
     */
    protected static $alertas = [];

    /**
     * Valida la entidad de persona y agrega alertas si hay problemas.
     *
     * @return array Alertas de validación. Si está vacío, la validación fue exitosa.
     */
    public function validar_persona() {
        if(!$this->nombre) {
            self::$alertas["error"][] = "El nombre es obligatorio";
        }
        return self::$alertas;
    }
}