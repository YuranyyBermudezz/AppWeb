<?php

class registro_usuario_be{

    private $Id;
    private $Nombrecompleto;
    private $Correo;
    private $Telefono;
    private $Usuario;
    private $Password;

    public function __construct ($Id, $Nombrecompleto, $Correo, $Telefono, $Usuario, $Password){
        $this->Id =$Id;
        $this->Nombrecompleto = $Nombrecompleto;
        $this->Correo = $Correo;
        $this->Telefono = $Telefono;
        $this->Usuario = $Usuario;
        $this->Password = $Password;
    }

    public function obtenerID(){
        return $this->Id;
    }

    public function obtenerNombre(){
        return $this->Nombrecompleto;
    }

    public function obtenerCorreo(){
        return $this->Correo;
    }

    public function obtenerTelefono(){
        return $this->Telefono;
    }

    public function obtenerUsuario(){
        return $this->Usuario;
    }

    public function obtenerPassword(){
        return $this->Password;
    }

}

?>