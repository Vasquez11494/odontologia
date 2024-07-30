<?php
require '../../model/Paciente.php';
header('Content-Type: application/json; charset=UTF-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_REQUEST['tipo'];

try {
    $mensaje = "";
    $codigo = 0;

    switch ($metodo) {
        case 'POST':
            if ($tipo === '1') {
                $paciente = new Paciente($_POST);
                $ejecucion = $paciente->guardar();
                $mensaje = "Paciente Guardado correctamente";
                $codigo = 1;
            } elseif ($tipo === "2") {
                $paciente = new Paciente($_POST);
                $ejecucion = $paciente->modificar();
                $mensaje = "paciente Modificado correctamente";
                $codigo = 2;
            } elseif ($tipo === "3") {
                $paciente = new Paciente($_POST);
                $ejecucion = $paciente->eliminar();
                $mensaje = "paciente Eliminado correctamente";
                $codigo = 3;
            } else {
                $mensaje = 'Tipo No encontrado';
                $codigo = 5;
            }
            break;

        case 'GET':
            $paciente = new Paciente($_GET);
            $pacienteNuevo = $paciente->buscar();
            echo json_encode($pacienteNuevo);
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
