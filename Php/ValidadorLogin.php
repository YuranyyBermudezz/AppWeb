<?php

class ValidadorLogin { 

    private $eusuario;

    private $error;

    public function __construct($correo, $Password, $conexion){

        $this->error = "";

        if(!$this->variable_iniciada($correo) || !$this->variable_iniciada($Password)){
            $this->eusuario = null;
            $this->error = " Sus datos ingresados no son correctos";
        }
        else{
            $this->eusuario = RepositorioUsuario::obtenerUsuarioPorEmail($correo, $conexion);

            if(is_null($this->eusuario) || !password_verify($Password, $this->eusuario->obtenerPassword())){
                $this->error = "Datos incorrectos";
            }

        }

    }

    private function variable_iniciada($variable){
        return isset($variable) && !empty($variable);
    }

    public function obtenerUsuario(){

        return $this->eusuario;
    }

    public function obtenerError(){
        return $this->error;
    }

}



?>