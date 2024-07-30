<?php
require_once 'Conexion.php';

class Detalle extends Conexion{
    public $det_id;
    public $det_pac;
    public $det_ser;
    public $det_sit;


    public function __construct($args = []){
        $this->det_id = $args['det_id'] ?? null;
        $this->det_pac = $args['det_pac'] ?? '';
        $this->det_ser = $args['det_ser'] ?? '';
        $this->det_sit = $args['det_sit'] ?? '';

    }


    public function guardar (){
        $sql = "INSERT INTO detalle (det_pac, det_ser) 
        VALUES ('$this->det_pac', '$this->det_ser')";
        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function buscar() {
        $sql = "SELECT 
            det_id, pac_id, ser_id,
            p.pac_nombre, 
            p.pac_tel, 
            p.pac_direccion, 
            p.pac_correo, 
            s.ser_nombre, 
            s.ser_fecha
        FROM 
            paciente p
        JOIN 
            detalle d ON p.pac_id = d.det_pac
        JOIN 
            servicio s ON d.det_ser = s.ser_id
        WHERE 
            p.pac_sit = 1 
            AND s.ser_sit = 1 
            AND d.det_sit = 1";
        
    
        $resultado = self::servir($sql);
        return $resultado;
    }
    
    public function modificar(){
        $sql = "UPDATE detalle SET det_pac = '$this->det_pac', det_ser = '$this->det_ser' 
         WHERE det_id = $this->det_id";
        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function eliminar(){
        $sql = "UPDATE detalle SET det_sit = 0 WHERE det_id = $this->det_id";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }
}