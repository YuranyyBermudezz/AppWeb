<?php

class Conexion{
    private static $conexion;

    public static function abrirConexion(){
        if(!isset(self::$conexion)){
            try{
                include_once 'config.php';
                self::$conexion = new PDO('pgsql:host='.SERVIDOR. '; dbname='.BASE_DATOS, NOMBRE_USUARIO,PASSWORD);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexion->exec("SET NAMES 'UTF8'");
            }
            catch(PDOException $ex){
                print "ERROR: ". $ex->getMessage() . "<br>"; 
            }
        }
    }

    public static function cerrarConexion(){
        if(isset(self::$conexion)){
            self::$conexion = null;
        }
    }

    public static function obtenerConexion(){
        if(isset(self::$conexion)){
            echo "conexion establecida";
            return self::$conexion;
        }else{
            echo "no se pudo conectar la base de datos";
        }
        

    }

}
Conexion::abrirConexion();
Conexion::obtenerConexion();
?>