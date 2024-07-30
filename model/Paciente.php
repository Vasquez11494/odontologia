<?php

require_once 'Conexion.php';

class Paciente extends Conexion
{

    public  $paciente_id;
    public  $paciente_nombre;
    public  $paciente_telefono;
    public  $paciente_correo;
    public  $paciente_edad;
    public  $paciente_situacion;



    public function __construct($args = [])
    {
        $this->paciente_id = $args['paciente_id'] ?? null;
        $this->paciente_nombre = $args['paciente_nombre'] ?? '';
        $this->paciente_telefono = $args['paciente_telefono'] ?? '';
        $this->paciente_correo = $args['paciente_correo'] ?? '';
        $this->paciente_edad = $args['paciente_edad'] ?? '';
        $this->paciente_situacion = $args['paciente_situacion'] ?? '1';
    }

    public function guardar()
    {
        $sql = "INSERT into pacientes (paciente_nombre, paciente_telefono, paciente_correo, paciente_edad) values ('$this->paciente_nombre','$this->paciente_telefono','$this->paciente_correo','$this->paciente_edad')";
        
        // echo json_encode($sql);
        // exit;
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    public function buscar(...$columnas)
    {
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT paciente_id, paciente_nombre, paciente_telefono, paciente_correo, paciente_edad FROM pacientes WHERE paciente_situacion = 1 
";
        
        if ($this->paciente_id != '') {
            $sql .= " AND paciente_id = $this->paciente_id ";
        }
        if ($this->paciente_nombre != '') {
            $sql .= " AND paciente_nombre like '%$this->paciente_nombre%' ";
        }
        if ($this->paciente_telefono != '') {
            $sql .= " AND paciente_telefono = $this->paciente_telefono ";
        }
        if ($this->paciente_correo != '') {
            $sql .= " AND paciente_correo like  '%$this->paciente_correo%' ";
        }
        if ($this->paciente_edad != '') {
            $sql .= " AND paciente_edad = $this->paciente_edad ";
        }
        // echo json_encode($sql);
        // exit;
        $resultado = self::servir($sql);
        return $resultado;
    }



    public function modificar(){
        $sql = "UPDATE pacientes SET paciente_nombre = '$this->paciente_nombre', paciente_telefono = '$this->paciente_telefono', paciente_correo = '$this->paciente_correo', paciente_edad = '$this->paciente_edad' WHERE paciente_situacion = 1 AND paciente_id = $this->paciente_id ";
  
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }

    public function eliminar(){
        $sql = " UPDATE pacientes SET paciente_situacion = 0 WHERE paciente_id = $this->paciente_id ";

        $resultado = $this->ejecutar($sql);
        return $resultado;
    }


}