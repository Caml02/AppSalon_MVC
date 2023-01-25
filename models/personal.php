<?php

namespace Model;


class Personal extends ActiveRecord {
        protected static $tabla = 'personal';
        protected static $columnasDB =  ['id', 'nombre', 'apellido',
         'telefono', 'email', 'password', 'admin', 'confirmado', 'token'];

        public $id;
        public $nombre;
        public $apellido;
        public $telefono;
        public $email;
        public $password;
        public $admin;
        public $confirmado;
        public $token;

        public function __construct($args = []) {
            
             $this->id = $args['id']?? null;
             $this->nombre = $args['nombre']?? '';
             $this->apellido = $args['apellido']?? '';
             $this->telefono = $args['telefono']?? '';
             $this->email = $args['email']?? '';
             $this->password = $args['password']?? '';
             $this->admin = $args['admin']?? '0';
             $this->confirmado = $args['confirmado']?? '0';
             $this->token = $args['token']?? '';


         }


//Método de validación

    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre Es Obligatorio';
            } 
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido Es Obligatorio';
            }
        if(!$this->telefono) {
            self::$alertas['error'][] = 'El Telefono Es Obligatorio';
            }
        if(!$this->email) {
            self::$alertas['error'][] = 'El E-mail Es Obligatorio';
            }
        if(!$this->password) {
            self::$alertas['error'][] = 'La Contraseña Es Obligatorio';
            }
        if (strlen($this->password) < 6){
            self::$alertas['error'][] = 'La contraseña debe tener almenos 6 caracteres';
        }
            return self::$alertas;
        }

        // Validar Personal
        public function validarLogin() {
            if(!$this->email) {
                self::$alertas['error'][] = 'Email Obligatorio';
            } if(!$this->password){
                self::$alertas['error'][] = 'Contraseña Obligatoria';
            }
            return self::$alertas;
        }
            //Validar Email
        public function validarEmail() {
            if(!$this->email) {
                self::$alertas['error'][] = 'Email Obligatorio';
            }
        }
            //Validar Password, recuperación. 
        public function validarPassword() {
            if(!$this->papssword) {
                self::$alertas['error'][] = 'Password Obligatorio';
            }
            if (strlen($this->password) < 6){
                self::$alertas['error'][] = 'La contraseña debe tener almenos 6 caracteres';
            }
                return self::$alertas;
        }

        //Revisar Usuario/Personal
        public function personalExistente() {
            $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
            $resultado = self::$db->query($query);
            
            if($resultado->num_rows) {
                self::$alertas['error'][] = 'Usuario Ya Registrado!';
            }
            return($resultado);
        }
        public function hashPassword() {
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        }

        public function crearToken() {
            $this->token = uniqid();
        }
        public function comprobarPasswordVerificacion($password){
        $resultado = password_verify($password, $this->password);
        
        if(!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Usuario No Confirmado O Contraseña Incorrecta';
        } else {
            return true;
        }

        }
}