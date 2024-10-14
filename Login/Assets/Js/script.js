document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
document.getElementById("btn__Registrarse").addEventListener("click", register);
window.addEventListener("resize", anchoPagina);

// Declaración de variables
var contenedor_login_register = document.querySelector(".contenedor__login-register");
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");

function anchoPagina() {
    if (window.innerWidth > 850) {
        caja_trasera_login.style.display = "block";
        caja_trasera_register.style.display = "block";
    } else {
        caja_trasera_register.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "0px";
    }
}

anchoPagina();

function iniciarSesion() {
    if (window.innerWidth > 850) {
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "10px";
        formulario_login.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";
    } else {
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "block";
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "none";
    }
}

function register() {
    if (window.innerWidth > 850) {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "410px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    } else {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.opacity = "1";
    }
}

// Validación del formulario y manejo de la respuesta del servidor
document.getElementById('submitRegister').addEventListener('click', function(event) {
    event.preventDefault();

    // Limpia los mensajes de error previos
    clearErrors();

    // Obtener los valores de los campos
    var nombrecompleto = document.getElementById('nombrecompleto').value;
    var correo = document.getElementById('correo').value;
    var telefono = document.getElementById('telefono').value;
    var usuario = document.getElementById('usuario').value;
    var password1 = document.getElementById('password1').value;

    // Validar los campos
    var isValid = true;

    if (nombrecompleto === '') {
        showError('errorNombrecompleto', 'Ingrese sus Nombres y Apellidos', 'nombrecompleto');
        isValid = false;
    }

    if (correo === '') {
        showError('errorCorreo', 'Ingrese su correo por favor', 'correo');
        isValid = false;
    } else if (!validateEmail(correo)) {
        showError('errorCorreo', 'El correo no es válido', 'correo');
        isValid = false;
    }

    if (telefono === '') {
        showError('errorTelefono', 'El teléfono no puede estar vacío', 'telefono');
        isValid = false;
    } else if (!validatePhone(telefono)) {
        showError('errorTelefono', 'El teléfono debe tener 10 dígitos', 'telefono');
        isValid = false;
    }

    if (usuario === '') {
        showError('errorUsuario', 'El nombre de usuario no puede estar vacío', 'usuario');
        isValid = false;
    }

    if (password1 === '') {
        showError('errorPassword', 'Ingrese su contraseña antes de continuar', 'password1');
        isValid = false;
    } else if (password1.length < 6) {
        showError('errorPassword', 'Por tu seguridad debe contener al menos 6 caracteres', 'password1');
        isValid = false;
    }

    // Si todos los campos son válidos, enviar el formulario
    if (isValid) {
        var formData = new FormData();
        formData.append('nombrecompleto', nombrecompleto);
        formData.append('correo', correo);
        formData.append('telefono', telefono);
        formData.append('usuario', usuario);
        formData.append('password1', password1);

        fetch('./Php/registro-usu.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '/paginaweb/index.php';
            } else {
                if (data.errors) {
                    if (data.errors.errorNombrecompleto) {
                        showError('errorNombrecompleto', data.errors.errorNombrecompleto, 'nombrecompleto');
                    }
                    if (data.errors.errorCorreo) {
                        showError('errorCorreo', data.errors.errorCorreo, 'correo');
                    }
                    if (data.errors.errorTelefono) {
                        showError('errorTelefono', data.errors.errorTelefono, 'telefono');
                    }
                    if (data.errors.errorUsuario) {
                        showError('errorUsuario', data.errors.errorUsuario, 'usuario');
                    }
                    if (data.errors.errorPassword) {
                        showError('errorPassword', data.errors.errorPassword, 'password1');
                    }
                }
                if (data.errorGeneral) {
                    showError('errorGeneral', data.errorGeneral, 'submitRegister');
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }
});

function clearErrors() {
    var errorElements = document.querySelectorAll('.error-popup');
    errorElements.forEach(function(element) {
        element.style.display = 'none';
    });
}

function showError(elementId, message, inputId) {
    var errorElement = document.getElementById(elementId);
    var inputElement = document.getElementById(inputId);
    var rect = inputElement.getBoundingClientRect();
    errorElement.innerText = message;
    errorElement.style.display = 'block';
    errorElement.style.top = (rect.top + window.scrollY + inputElement.offsetHeight + 5) + 'px';
    errorElement.style.left = (rect.left + window.scrollX) + 'px';
}

function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePhone(phone) {
    var re = /^[0-9]{10}$/;
    return re.test(phone);
}
