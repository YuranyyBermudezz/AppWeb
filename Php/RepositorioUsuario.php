<?php
    class RepositorioUsuario {
        public static function insertarUsuario($conexion, $usuario){

            $usuarioInsertado = false;

            if (isset($conexion)){ 

                try{
                    $sql = "INSERT INTO Usuarios(nombre_completo, correo, telefono, usuario, us_password) VALUES (:nombre_completo, :correo, :telefono, :usuario, :us_password)";
                    
                    $sentencia = $conexion->prepare($sql);

                    $Nombrecompleto = $usuario->obtenerNombre();
                    $Correo = $usuario->obtenerCorreo();
                    $Telefono = $usuario->obtenerTelefono();
                    $Usuario = $usuario->obtenerUsuario();
                    $Password = $usuario->obtenerPassword();

 
                    $sentencia->bindParam(':nombre_completo', $Nombrecompleto, PDO::PARAM_STR);
                    $sentencia->bindParam(':correo', $Correo, PDO::PARAM_STR);
                    $sentencia->bindParam(':telefono', $Telefono, PDO::PARAM_STR);
                    $sentencia->bindParam(':usuario', $Usuario, PDO::PARAM_STR);
                    $sentencia->bindParam(':us_password', $Password, PDO::PARAM_STR);


                    $usuarioInsertado = $sentencia->execute();
                }
                catch(PDOException $ex){
                    print "Error: ". $ex->getMessage();
                }
            }
            return $usuarioInsertado;
        }

        public static function obtenerUsuarioPorEmail($correo, $conexion){
            $eusuario = null;
        
            if(isset($conexion)){
                try{
                    include_once "./registro_usuario_be.php";
        
                    $sql = "SELECT * FROM Usuarios WHERE correo = :correo";  // Correcto: ':correo'
        
                    $sentencia = $conexion->prepare($sql);
                    $sentencia->bindParam(':correo', $correo, PDO::PARAM_STR);  // Correcto: ':correo'
                    $sentencia->execute();
        
                    $resultado = $sentencia->fetch();
        
                    if(!empty($resultado)){
                        $eusuario = new registro_usuario_be($resultado['id'], $resultado['nombre_completo'], $resultado['correo'], $resultado['telefono'], $resultado['usuario'], $resultado['us_password']);
                    }
        
                 } catch(PDOException $e){
                        print "ERROR". $e->getMessage();
                        die();
                    }
            }
        
            return $eusuario;
        }
        
        public static function nombreExiste($conexion, $Nombrecompleto){
            
            $nombreExiste = false;

            if(isset($conexion)){
              
                try{

                    $sql = "SELECT * FROM Usuarios WHERE nombre_completo = :Nombrecompleto";
                    $sentencia = $conexion->prepare($sql);
                    $sentencia->bindParam(':Nombrecompleto', $Nombrecompleto, PDO::PARAM_STR);
                    $sentencia->execute();
                    $resultado = $sentencia->fetchAll();

                    if(count($resultado)){
                         $nombreExiste = true;
                    }
                    else{
                        $nombreExiste = false;
                    }


                }catch(PDOException $e){
                    print "Error: ". $e->getMessage();
                }
            }
            return $nombreExiste;
        }

        public static function correoExiste($conexion, $Correo){
            
            $correoExiste = false;

            if(isset($conexion)){
              
                try{

                    $sql = "SELECT * FROM Usuarios WHERE correo = :Correo";
                    $sentencia = $conexion->prepare($sql);
                    $sentencia->bindParam(':Correo', $Correo, PDO::PARAM_STR);
                    $sentencia->execute();
                    $resultado = $sentencia->fetchAll();

                    if(count($resultado)){
                         $correoExiste = true;
                    }

                }catch(PDOException $e){
                    print "Error: ". $e->getMessage();
                }
            }
            return $correoExiste;
        }

        public static function usuarioExiste($conexion, $Usuario) {
            $usuarioExiste = false;
    
            if (isset($conexion)) {
                try {
                    $sql = "SELECT * FROM Usuarios WHERE usuario = :Usuario";
                    $sentencia = $conexion->prepare($sql);
                    $sentencia->bindParam(':Usuario', $Usuario, PDO::PARAM_STR);
                    $sentencia->execute();
                    $resultado = $sentencia->fetchAll();
    
                    if (count($resultado)) {
                        $usuarioExiste = true;
                    }
                } catch (PDOException $e) {
                    print "Error: " . $e->getMessage();
                }
            }
            return $usuarioExiste;
        }

    }

?>