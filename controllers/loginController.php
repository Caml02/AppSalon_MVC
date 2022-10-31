<?php

namespace Controllers;

use Classes\Email;
use Model\Personal;
use MVC\Router;

    class loginController {
        public static function login(Router $router) {
            $alertas = [];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $auth = new Personal($_POST);
                $alertas = $auth->validarLogin();

            if(empty($alertas)) {
            //Verifica Usuario
                $personal = Personal::where('email', $auth->email);
             if ($personal) {
            //Verifica Contraseña
                if ($personal->comprobarPasswordVerificacion($auth->password)) {
            //Autenticar Usuario
                    session_start();
                    $_SESSION['id'] = $personal->id;
                    $_SESSION['nombre'] = $personal->nombre . " " . $personal->apellido;
                    $_SESSION['email'] = $personal->email;
                    $_SESSION['login'] = true;

            //Redireccionamiento

        if($personal->admin === "1") {
            $_SESSION['admin'] = $personal->admin ?? null;
            header ('Location: /admin');
        } else {
            header ('Location: /cita');
            }
        }
            } else {
                Personal::setAlerta('error', 'Usuario No Encotrado');
            }
        }
    }
            $alertas = Personal::getAlertas();
            $router->render('auth/login', [
                'alertas' => $alertas
            ]);
}
        public static function logout() {
            session_start();
            $_SESSION = [];
            header ('Location: /');

        }
        public static function olvide(Router $router) {
            $alertas = [];
            if($_SERVER['REQUEST_METHOD'] === 'POST');
            $auth = new Personal($_POST);
            $alertas = $auth->validarEmail();
            if (empty($alertas0)) {
                $personal = Personal::where('email', $auth->email);

                if ($personal && $personal->confirmado === '1') {

                    //Generar Un token de recuperación
                    $personal->crearToken();
                    $personal->guardar();

                    //Enviar Email Recuperación.
                    $email = new Email($personal->email, $personal->nombre, $personal->token);
                    $email-> enviarInstrucciones();
                    //Alertas envio correco o no.
                    $personal::setAlerta('exito', 'Correo Enviado Correctamente.');
                } else {
                    personal::setAlerta('error', 'Correo Inexistente O Sin Confirmar. ');
                }
            }
            $alertas = Personal::getAlertas();
            $router->render('auth/olvide-contraseña', [
            'alertas' => $alertas
        ]);
        }
        public static function recuperar(Router $router) {
            $alertas = [];
            $error = false;
            
            $token = s($_GET['token']);

            //Buscar Usuario por Token.

            $personal = personal::where('token', $token);
            if(empty($personal)) {
              personal::setAlerta('error', 'Token No Valido.');
              $error = true;
            }

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                 //Leer contraseña y guardarla.
                $password = new Personal($_POST);
                $alertas = $password->validarPassword();

                if(empty($password)) {
                    $personal->password = null;
                    $personal->password = $password->password;
                    $personal->hashPassword();
                    $personal->token = null;
                    $personal->guardar();
                }
                $resultado = $personal->guardar();
                        if ($resultado) {
                            header ('Location: /');
                        }
            }

            $alertas = personal::getAlertas();
            $router->render('auth/recuperar-contraseña', [
                'error' => $error,
                'alertas' => $alertas
            ]);
        }
        public static function crear(Router $router) {
            $personal = new Personal;
            //Alertas vacias 
            $alertas = [];
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $personal->sincronizar($_POST);
                $alertas = $personal->validarNuevaCuenta();
            
                //Revisar que la alerta este vacia
                if(empty($alertas)) {
                    //Verifica que el usuario ya este registrado
                    $resultado = $personal->personalExistente();
                    if($resultado->num_rows) {
                        $alertas = Personal::getAlertas();
                    } else {

                        //Hashear Password.
                        $personal->hashPassword();

                        // Crear Token
                        $personal->crearToken();

                        $email = new Email($personal->nombre,
                        $personal->email, $personal->token);

                        $email -> enviarConfirmacion();

                        // Crear al usuario
                        $resultado = $personal->guardar();
                        if ($resultado) {
                            header ('Location: /mensaje');
                        }
                    }
                }
            }
            $router->render('auth/crear-cuenta', [
                'personal' => $personal,
                'alertas' => $alertas
            ]);
        }
        public static function mensaje(Router $router) {
            $router->render('auth/mensaje');
        }
        public static function confirmar(Router $router) {
            $alertas = [];
            $token = s($_GET['token']);
            $personal = Personal::where('token', $token);
            if(empty($personal)) { 
                //mostrar mensaje de error
                Personal::setAlerta('error', 'Token no válido...');
            } else {
                //cambiar valor de columna confirmado
                $personal->confirmado = "1";
                //eliminar tokens
                $personal->token = null;
                //Guardar y Actualizar 
                $personal->guardar();
                //mostrar mensaje de exito
                Personal::setAlerta('exito', 'Cuenta verificada exitosamente...');
            }
            $alertas = Personal::getAlertas();
            $router->render('auth/confirmar-cuenta', [
                'alertas' => $alertas
            ]);
        }
    }
