<?php

include_once './RepositorioUsuario.php';

class ValidadorRegistro{

    private $nombreCompleto;
    private $correo;
    private $telefono;
    private $usuario;
    private $password;

    private $errorNombreCompleto;
    private $errorCorreo;
    private $errorTelefono;
    private $errorUsuario;
    private $errorPassword;

    public function __construct($nombreCompleto, $correo, $telefono, $usuario, $password, $conexion){
        
        $this->nombreCompleto = "";
        $this->correo = "";
        $this->telefono = "";
        $this->usuario = "";
        $this->password = "";

        $this->errorNombreCompleto = $this->validarNombre($nombreCompleto, $conexion);
        $this->errorCorreo = $this->validarCorreo($correo, $conexion);
        $this->errorTelefono = $this->validarTelefono($telefono);
        $this->errorUsuario = $this->validarUsuario($usuario, $conexion);
        $this->errorPassword = $this->validarPassword($password, $conexion);

        if($this->errorPassword === ""){
            $this->password = $password;
        }
    
    }

    private function variableIniciada($variable){

        return isset($variable) && !empty($variable);

    }

    private function validarNombre($nombreCompleto, $conexion){
        if(!$this->variableIniciada($nombreCompleto)){
            return "Ingrese sus Nombres y Apellidos";
        }
        else{
            $this->nombreCompleto = $nombreCompleto;
        }
        if(strlen($nombreCompleto) < 6){
            return "El nombre de usuario debe contener al menos 6 caracteres";
        }
        if(strlen($nombreCompleto) > 60){
            return "El nombre de usuario no debe superar los 60 caracteres";
        }
        if(RepositorioUsuario::nombreExiste($conexion, $nombreCompleto)){
            return "El nombre ya está en uso, por favor ingrese otro nombre de usuario";
        }
        return "";

    }

    private function validarCorreo($correo, $conexion){

        if(!$this->variableIniciada($correo)){
            return "Ingrese su correo por favor";
        }
        else{
            $this->correo = $correo;
        }
        if(RepositorioUsuario::correoExiste($conexion, $correo)){
            return "El correo ya se encuentra en uso";
        }
        if(filter_var($correo, FILTER_VALIDATE_EMAIL) == false){
            return "El correo ($correo) no es válido; ejemplo: email@gmail.com";
        }

        return "";

    }

    private function validarTelefono($telefono){

        if (!$this->variableIniciada($telefono)) {
            return "El teléfono no puede estar vacío";
        } else {
            $this->telefono = $telefono;
        }

        if (!preg_match('/^[0-9]{10}$/', $telefono)) {
            return "El teléfono debe tener 10 dígitos";
        }
        return "";

    }

    private function validarUsuario($usuario, $conexion){

            if (!$this->variableIniciada($usuario)) {
                return "El nombre de usuario no puede estar vacío";
            } else {
                $this->usuario = $usuario;
            }
    
            if (RepositorioUsuario::usuarioExiste($conexion, $usuario)) {
                return "El nombre de usuario ya está en uso, por favor ingrese otro";
            }
            return "";
    }

    private function validarPassword($password, $conexion){

        if(!$this->variableIniciada($password)){

            return "Ingrese su contraseña antes de continuar";

        }
        if (strlen($password) < 6){
            return "Por tu seguridad debe contener al menos 6 caracteres";
        }
        if($this->nombreCompleto === $password){
            return "Por tu seguridad el nombre no debe ser igual a tu contraseña";
        }

        return "";

    }

    //Variables 


        public function obtenerNombre(){

            return $this->nombreCompleto;

        }

        public function obtenerCorreo(){

            return $this->correo;

        }

        public function obtenerTelefono(){

            return $this->telefono;

        }

        public function obtenerUsuario(){

            return $this->usuario;


        }

        public function obtenerPassword(){

            return $this->password;


        }


        //Errores

        public function obtenerErrorNombreCompleto(){

            return $this->errorNombreCompleto;


        }

        public function obtenerErrorCorreo(){

            return $this->errorCorreo;


        }

        public function obtenerErrorTelefono(){

            return $this->errorTelefono;


        }

        public function obtenerErrorUsuario(){

            return $this->errorUsuario;


        }

        public function obtenerErrorPassword(){

            return $this->errorPassword;

        }


        public function registroValido(){

            if($this->errorNombreCompleto === "" && $this->errorCorreo === "" && $this->errorTelefono === "" && $this->errorUsuario === "" && $this->errorPassword === ""){

                return true;

            }
            else {
                return false;
            }
    
    }


}

?>
