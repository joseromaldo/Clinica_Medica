<?php
require_once 'Conexion.php';

class Paciente extends Conexion{
    public $pac_id;
    public $pac_nombre;
    public $pac_tel;
    public $pac_direccion;
    public $pac_correo;
    public $pac_sit;


    public function __construct($args = []){
        $this->pac_id = $args['pac_id'] ?? null;
        $this->pac_nombre = $args['pac_nombre'] ?? '';
        $this->pac_tel = $args['pac_tel'] ?? '';
        $this->pac_direccion = $args['pac_direccion'] ?? '';
        $this->pac_correo = $args['pac_correo'] ?? '';
        $this->pac_sit = $args['pac_sit'] ?? '';
    }

    public function guardar (){
        $sql = "INSERT INTO paciente (pac_nombre, pac_tel, pac_direccion, pac_correo) 
        VALUES ('$this->pac_nombre', '$this->pac_tel', '$this->pac_direccion', '$this->pac_correo')";
        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function buscar(){
        $sql = "SELECT * FROM paciente WHERE pac_sit = 1";

        if($this->pac_nombre !=''){
            $sql .= " and pac_nombre like '%$this->pac_nombre%' ";
        }

        
        if($this->pac_tel !=''){
            $sql .= " and pac_tel like '%$this->pac_tel%' ";
        }

        
        if($this->pac_direccion !=''){
            $sql .= " and pac_direccion like '%$this->pac_direccion%' ";
        }

        
        if($this->pac_correo !=''){
            $sql .= " and pac_correo like '%$this->pac_correo%' ";
        }

        if($this->pac_id != null){
            $sql .= " and pac_id = $this->pac_id";
        }

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function modificar(){
        $sql = "UPDATE paciente SET pac_nombre = '$this->pac_nombre', pac_tel = '$this->pac_tel', pac_direccion = '$this->pac_direccion', 
        pac_correo = '$this->pac_correo' WHERE pac_id = $this->pac_id";
        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function eliminar(){
        $sql = "UPDATE paciente SET pac_sit = 0 WHERE pac_id = $this->pac_id";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }
}