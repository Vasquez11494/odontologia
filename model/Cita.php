<?php

require_once 'Conexion.php';

class Cita extends Conexion
{

    public  $cita_id;
    public  $cita_paciente;
    public  $cita_doctor;
    public  $cita_fecha;
    public  $cita_descripcion;
    public  $cita_situacion;



    public function __construct($args = [])
    {
        $this->cita_id = $args['cita_id'] ?? null;
        $this->cita_paciente = $args['cita_paciente'] ?? '';
        $this->cita_doctor = $args['cita_doctor'] ?? '';
        $this->cita_fecha = $args['cita_fecha'] ?? '';
        $this->cita_descripcion = $args['cita_descripcion'] ?? '';
        $this->cita_situacion = $args['cita_situacion'] ?? '1';
    }

    public function guardar()
    {
        $sql = "INSERT into citas (cita_paciente, cita_doctor, cita_fecha, cita_descripcion) values ('$this->cita_paciente','$this->cita_doctor', '$this->cita_fecha','$this->cita_descripcion')";

        // echo json_encode($sql);
        // exit;
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    public function buscarCitas()
    {

        $sql = "SELECT cita_id, cita_paciente, paciente_nombre, cita_doctor, doctor_nombre, cita_fecha, cita_descripcion FROM citas INNER JOIN pacientes ON cita_paciente = paciente_id INNER JOIN doctores ON cita_doctor = doctor_id WHERE cita_situacion = 1";
        
        $resultado = self::servir($sql);
        return $resultado;

    }

    public function modificar()
    {
        $sql = "UPDATE citas SET cita_paciente = '$this->cita_paciente', cita_doctor = '$this->cita_doctor', cita_fecha = '$this->cita_fecha', cita_descripcion = '$this->cita_descripcion' WHERE cita_situacion = 1 AND cita_id = $this->cita_id ";

        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    public function eliminar()
    {
        $sql = " UPDATE citas SET cita_situacion = 0 WHERE cita_id = $this->cita_id ";

        $resultado = $this->ejecutar($sql);
        return $resultado;
    }
}
