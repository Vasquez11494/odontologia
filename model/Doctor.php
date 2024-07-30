<?php

require_once 'Conexion.php';

class Doctor extends Conexion
{

    public  $doctor_id;
    public  $doctor_nombre;
    public  $doctor_telefono;
    public  $doctor_colegiado;
    public  $doctor_edad;
    public  $doctor_situacion;



    public function __construct($args = [])
    {
        $this->doctor_id = $args['doctor_id'] ?? null;
        $this->doctor_nombre = $args['doctor_nombre'] ?? '';
        $this->doctor_telefono = $args['doctor_telefono'] ?? '';
        $this->doctor_colegiado = $args['doctor_colegiado'] ?? '';
        $this->doctor_edad = $args['doctor_edad'] ?? '';
        $this->doctor_situacion = $args['doctor_situacion'] ?? '1';
    }

    public function guardar()
    {
        $sql = "INSERT into doctores (doctor_nombre, doctor_telefono, doctor_colegiado, doctor_edad) values ('$this->doctor_nombre','$this->doctor_telefono','$this->doctor_colegiado','$this->doctor_edad')";
        
        // echo json_encode($sql);
        // exit;
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    public function buscar(...$columnas)
    {
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT doctor_id, doctor_nombre, doctor_telefono, doctor_colegiado, doctor_edad FROM doctores WHERE doctor_situacion = 1 
";
        
        if ($this->doctor_id != '') {
            $sql .= " AND doctor_id = $this->doctor_id ";
        }
        if ($this->doctor_nombre != '') {
            $sql .= " AND doctor_nombre like '%$this->doctor_nombre%' ";
        }
        if ($this->doctor_telefono != '') {
            $sql .= " AND doctor_telefono = $this->doctor_telefono ";
        }
        if ($this->doctor_colegiado != '') {
            $sql .= " AND doctor_colegiado =  $this->doctor_colegiado ";
        }
        if ($this->doctor_edad != '') {
            $sql .= " AND doctor_edad = $this->doctor_edad ";
        }
        // echo json_encode($sql);
        // exit;
        $resultado = self::servir($sql);
        return $resultado;
    }



    public function modificar(){
        $sql = "UPDATE doctores SET doctor_nombre = '$this->doctor_nombre', doctor_telefono = '$this->doctor_telefono', doctor_colegiado = '$this->doctor_colegiado', doctor_edad = '$this->doctor_edad' WHERE doctor_situacion = 1 AND doctor_id = $this->doctor_id ";
  
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }

    public function eliminar(){
        $sql = " UPDATE doctores SET doctor_situacion = 0 WHERE doctor_id = $this->doctor_id ";

        $resultado = $this->ejecutar($sql);
        return $resultado;
    }


}