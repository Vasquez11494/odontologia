<?php
require '../../model/Doctor.php';
header('Content-Type: application/json; charset=UTF-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_REQUEST['tipo'];

try {
    $mensaje = "";
    $codigo = 0;

    switch ($metodo) {
        case 'POST':
            if ($tipo === '1') {
                $doctor = new Doctor($_POST);
                $ejecucion = $doctor->guardar();
                $mensaje = "Odontologo Guardado correctamente";
                $codigo = 1;
            } elseif ($tipo === "2") {
                $doctor = new Doctor($_POST);
                $ejecucion = $doctor->modificar();
                $mensaje = "Odontologo Modificado correctamente";
                $codigo = 2;
            } elseif ($tipo === "3") {
                $doctor = new Doctor($_POST);
                $ejecucion = $doctor->eliminar();
                $mensaje = "Odontologo Eliminado correctamente";
                $codigo = 3;
            } else {
                $mensaje = 'Tipo No encontrado';
                $codigo = 5;
            }
            break;

        case 'GET':
            $doctor = new Doctor($_GET);
            $doctorNuevo = $doctor->buscar();
            echo json_encode($doctorNuevo);
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
