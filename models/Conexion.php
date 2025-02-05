<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
abstract class Conexion {

    protected static $conexion = null;

    private static function conectar(){
        try{
            self::$conexion = new PDO('informix:host=host.docker.internal; service=9088; database=clinica_medica; server=informix; protocol=onsoctcp;EnableScrollableCursors = 1','informix','in4mix'); 
            // DEFINIR EL MANEJO DE EXCEPCIONES
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "CONEXION EXITOSA";
        }catch(PDOException $e){
            // IMPRIME EN PANTALLA EL ERROR
            echo "Error de conexion en la Base de Datos";
            echo "<br>";
            echo $e->getMessage();
            exit;
        }

        return self::$conexion;
 
    }
    //Metodos para las sentencias sql

    public static function ejecutar($sql){
        // CONECTANDOSE A LA BD CON EL METODO CONECTAR
        self::conectar();
        // PREPARAMOS LA SENTENCIA
        $sentencia = self::$conexion->prepare($sql);
        // EJECUTAMOS A SENTENCIA
        $resultado = $sentencia->execute();
        $id = self::$conexion->lastInsertId();
        // CERRANDO LA CONEXION
        self::$conexion = null;
        // DEVOLVEMOS RESULTADOS
        return [
            'resultado' => $resultado,
            'id' => $id
        ];
    }
    //Metodo para consultar infomación

    public static function servir($sql){
        // CONECTANDOSE A LA BD CON EL METODO CONECTAR
        self::conectar();
        // PREPARAMOS LA SENTENCIA
        $sentencia = self::$conexion->prepare($sql);
        // EJECUTAMOS A SENTENCIA
   
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        

        // CERRANDO LA CONEXION
        self::$conexion = null;
        
        // DEVOLVEMOS RESULTADOS
        return $resultados;
    }
  
}

