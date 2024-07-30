<?php
require '../../model/Cita.php';
header('Content-Type: application/json; charset=UTF-8');

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);


$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_REQUEST['tipo'];

try {
    $mensaje = "";
    $codigo = 0;
    
    switch ($metodo) {
        case 'POST':
            
            ($_POST['cita_fecha'] = date('Y-m-d H:i', strtotime($_POST['cita_fecha'])));
            if ($tipo === '1') {
                
                $cita = new Cita($_POST);
                $ejecucion = $cita->guardar();
                $mensaje = "Cita Guardada correctamente";
                $codigo = 1;
            } elseif ($tipo === "2") {
                
                $cita = new cita($_POST);
                $ejecucion = $cita->modificar();
                $mensaje = "Cita Modificada correctamente";
                $codigo = 2;
            } elseif ($tipo === "3") {
                $cita = new cita($_POST);
                $ejecucion = $cita->eliminar();
                $mensaje = "Cita Eliminada correctamente";
                $codigo = 3;
            } else {
                $mensaje = 'Tipo No encontrado';
                $codigo = 5;
            }
            break;

        case 'GET':
            $cita = new cita($_GET);
            $citaNuevo = $cita->buscarCitas();
            echo json_encode($citaNuevo);
            exit;

        default:
            http_response_code(405);
            $mensaje = "Método no permitido";
            $codigo = 9;
            break;
    }

    echo json_encode([
        "mensaje" => $mensaje,
        "codigo" => $codigo
    ]);
} catch (Exception $e) {
    echo json_encode([
        "detalle" => $e->getMessage(),
        "mensaje" => "Error de ejecución",
        "codigo" => 0,
    ]);
}

exit;


