<?php
require_once 'Conexion.php';

class Servicio extends Conexion{
    public $ser_id;
    public $ser_nombre;
    public $ser_fecha;
    public $ser_sit;


    public function __construct($args = []){
        $this->ser_id = $args['ser_id'] ?? null;
        $this->ser_nombre = $args['ser_nombre'] ?? '';
        $this->ser_fecha = $args['ser_fecha'] ?? '';
        $this->ser_sit = $args['ser_sit'] ?? '';
    }

    public function guardar (){
        $sql = "INSERT INTO servicio (ser_nombre, ser_fecha) 
        VALUES ('$this->ser_nombre', '$this->ser_fecha')";
        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function buscar(){
        $sql = "SELECT * FROM servicio WHERE ser_sit = 1";

        if($this->ser_nombre !=''){
            $sql .= " and ser_nombre like '%$this->ser_nombre%' ";
        }

        
        if($this->ser_fecha !=''){
            $sql .= " and ser_fecha like '%$this->ser_fecha%' ";
        }

        if($this->ser_id != null){
            $sql .= " and ser_id = $this->ser_id";
        }

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function modificar(){
        $sql = "UPDATE servicio SET ser_nombre = '$this->ser_nombre', ser_fecha = '$this->ser_fecha'
         WHERE ser_id = $this->ser_id";
        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function eliminar(){
        $sql = "UPDATE servicio SET ser_sit = 0 WHERE ser_id = $this->ser_id";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }
}