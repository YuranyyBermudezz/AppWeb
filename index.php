<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Y Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Login/Assets/Css/estilos.css">
</head>

<body>
    <main>
        
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__Registrarse">Regístrarse </button>
                </div>
            </div>
            <!--Formulario de login y Registro-->
                <div class="contenedor__login-register">
                    <!--Login-->
                    <form action="./Php/ingresar-usuario.php" method="post" class="formulario__login" >
                        <h2>Iniciar sesión</h2>
                        <input type="email"  placeholder="Correo Electrónico" name="correo" required>
                        <input type="password"  placeholder="Contraseña" name="password" required>
                        <button type="submit" >Entrar</button>
                    </form>
                    <!--Registro-->
                    <form id="registerForm" action="./Php/registro-usu.php" method="post" class="formulario__register">
                        <h2>Registrarse</h2> 
                        
                        <input id="nombrecompleto" type="text" placeholder="Nombre Completo" name="nombrecompleto">
                        <div id="errorNombrecompleto" class="error-popup"></div>
                        
                        <input id="correo" type="email" placeholder="Correo Electrónico" name="correo">
                        <div id="errorCorreo" class="error-popup"></div>
    
                        <input id="telefono" type="text" placeholder="Telefóno" name="telefono">
                        <div id="errorTelefono" class="error-popup"></div>
    
                        <input id="usuario" type="text" placeholder="Usuario" name="usuario">
                        <div id="errorUsuario" class="error-popup"></div>
                        
                        <input id="password1" type="password" placeholder="Contraseña" name="password1">
                        <div id="errorPassword" class="error-popup"></div>
    
                        <button id="submitRegister" type="submit">Registrarse</button>
                        <div id="errorGeneral" class="error-popup"></div>
                    </form>
                </div>
        </div>
    </main>
    <script src="Login/Assets/Js/script.js"></script>

</body>
</html>