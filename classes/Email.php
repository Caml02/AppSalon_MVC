<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function  __construct($email, $nombre, $token) {
        
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;

    }

    public function enviarConfirmacion() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '8b928292eaca99';
        $mail->Password = '50ab0f988def45';

        
        $mail->setFrom('cuentas@dbsicor.com');
        $mail->addAddress('cuentas@dbsicor.com'. 'dbsicor.com');
        $mail->Subject = 'Confirmar Cuenta';

        // Set HTML // Avisar HTML 
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .="<p><strong>Hola, " . $this->email .
         "</strong>, Has creado tu cuenta en la app salon , presiona el siguiente enlace para confirmar tu cuenta</p>";
        $contenido .= "<p> Presiona Aqui: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, Ignora este mensaje</p>";
        $contenido .= '</html';
        $mail->Body = $contenido;

    //Enviar email 

    $mail->send();
    }

    public function enviarInstrucciones() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '8b928292eaca99';
        $mail->Password = '50ab0f988def45';

        
        $mail->setFrom('cuentas@dbsicor.com');
        $mail->addAddress('cuentas@dbsicor.com'. 'dbsicor.com');
        $mail->Subject = 'Reestablacer Contraseña';
        // Set HTML // Avisar HTML 
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .="<p><strong>Hola, " . $this->nombre .
         "</strong>, Recupera tu contraseña dando click en el siguiente enlace.</p>";
        $contenido .= "<p> Presiona Aqui: <a href='http://localhost:3000/recuperar?token=" . $this->token . "'>Recuperar Contraseña</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, Ignora este mensaje</p>";
        $contenido .= '</html';
        $mail->Body = $contenido;


    //Enviar email 

    $mail->send();
    }
}