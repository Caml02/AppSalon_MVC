<?php

namespace Model;


class Servicio extends ActiveRecord {
    // Base de datos 
    protected static $tabla ='servicios';
    protected static $columnasDB =['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = []) {
        $this->id = $args['id']?? null;
        $this->nombre = $args['nombre']?? '';
        $this->precio = $args['precio']?? '';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'Nombre del servicio Obligatorio';
        }
        if(!$this->precio) {
            self::$alertas['error'][] = 'Precio del servicio Obligatorio';
        }
        if(!is_numeric($this->precio)) {
            self::$alertas['error'][] = 'Precio No valido';
        }
        return self::$alertas;
    }

}