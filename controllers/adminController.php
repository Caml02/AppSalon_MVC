<?php

namespace Controllers;

use MVC\Router;
use Model\adminCita;

class adminController {
    public static function index(Router $router) {
        session_start();

        isAdmin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);
        if (!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header('Location: /404');
        }

         // Consultar la base de datos.
         $consulta = "SELECT citas.id, citas.hora, CONCAT( personal.nombre, ' ', personal.apellido) as cliente, ";
         $consulta .= " personal.email, personal.telefono, servicios.nombre as servicio, servicios.precio  ";
         $consulta .= " FROM citas  ";
         $consulta .= " LEFT OUTER JOIN personal ";
         $consulta .= " ON citas.usuarioId=personal.id  ";
         $consulta .= " LEFT OUTER JOIN citaservicios ";
         $consulta .= " ON citaservicios.citaId=citas.id ";
         $consulta .= " LEFT OUTER JOIN servicios ";
         $consulta .= " ON servicios.id=citaservicios.servicioId ";
         $consulta .= " WHERE fecha =  '${fecha}' ";

        $citas = adminCita::SQL($consulta); 
        
        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}
            

