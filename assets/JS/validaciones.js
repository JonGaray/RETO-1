/*Validaciones Buscar Por Categoria*/
const formBuscar = document.getElementById("formBuscar");
formBuscar.addEventListener("submit",function(realizarBusqueda){
    const categoriaInput = document.querySelector(".buscar");
    let error = false;
    if (categoriaInput.value.trim() === ""){
        categoriaInput.classList.add("invalid");
        categoriaInput.setAttribute("placeholder","La categoria es obligatoria");
        error = true;
    }else{
        categoriaInput.classList.remove("invalid")
    }
    if (error){
        realizarBusqueda.preventDefault();
    }
});
/*Validaciones Formulario*/
document.addEventListener("DOMContentLoaded", function (){
    const formContacto = document.getElementById("formContacto");
    formContacto.addEventListener("submit", function (contactar){
        const correoInput = document.querySelector(".correo-contacto");
        const descripcionInput = document.querySelector(".descripcion-contacto");
        let error = false;
        if (correoInput.value.trim() === ""){
            correoInput.classList.add("invalid");
            correoInput.setAttribute("placehorder", "El correo es obligatorio");
            error = true;
        }else{
            correoInput.classList.remove("invalid");
        }
        if (descripcionInput.value.trim() === ""){
            descripcionInput.classList.add("invalid");
            descripcionInput.setAttribute("placeholder", "La descripcion es necesaria");
            error = true;
        }else{
            descripcionInput.classList.remove("invalid");
        }if (error){
            contactar.preventDefault();
        }
    });
});
/*Validaciones Crear Pregunta*/
document.addEventListener("DOMContentLoaded", function() {
    const formCrearPregunta = document.getElementById("form-createPregunta");
    formCrearPregunta.addEventListener("submit", function (crearPregunta) {
        const tituloInput = document.querySelector(".titulo");
        const descripcionInput = document.querySelector(".descripcion");
        const categoriaInput = document.querySelector(".categoria");
        let error = false;
        if (tituloInput.value.trim() === "") {
            tituloInput.classList.add("invalid");
            tituloInput.setAttribute("placeholder", "El título es obligatorio");
            error = true;
        } else {
            tituloInput.classList.remove("invalid");
        }
        if (descripcionInput.value.trim() === "") {
            descripcionInput.classList.add("invalid");
            descripcionInput.setAttribute("placeholder", "La descripción es obligatoria");
            error = true;
        } else {
            descripcionInput.classList.remove("invalid");
        }
        if (!categoriaInput.hasAttribute('readonly') && categoriaInput.value.trim() === "") {
            categoriaInput.classList.add("invalid");
            categoriaInput.setAttribute("placeholder", "La categoría es obligatoria");
            error = true;
        } else {
            categoriaInput.classList.remove("invalid");
        }
        if (error) {
            crearPregunta.preventDefault();
        }
    });
});
/*Validaciones Editar Perfil Usuario*/
document.addEventListener("DOMContentLoaded", function (){
    const formDatosUsuarioPreguntas = document.getElementById("formDatosUsuario")
    formDatosUsuarioPreguntas.addEventListener("submit", function (editarDatos){
        const nombreInput = document.getElementById("nombre");
        const correoInput = document.getElementById("correo");
        const contrasennaInput = document.getElementById("contrasenna");
        let error = false;
        if (nombreInput.value.trim() === ""){
            nombreInput.classList.add("invalid");
            nombreInput.setAttribute("placeholder", "Nombre obligatorio");
            error = true;
        }else{
            nombreInput.classList.remove("invalid");
        }
        if (correoInput.value.trim() === ""){
            correoInput.classList.add("invalid");
            correoInput.setAttribute("placeholder", "Correo obligatorio");
            error = true;
        }else{
            correoInput.classList.remove("invalid");
        }
        if (contrasennaInput.value.trim() === ""){
            contrasennaInput.classList.add("invalid");
            contrasennaInput.setAttribute("placeholder", "Contraseña obligatorio");
            error = true;
        }else{
            contrasennaInput.classList.remove("invalid");
        }
        if (error){
        editarDatos.preventDefault();
        }
    });
});
/*Validaciones Crear Usuario*/
document.addEventListener("DOMContentLoaded", function (){
    const formCrearUsuario = document.getElementById("form_registro")
    formCrearUsuario.addEventListener("submit", function (crearUsuario){
        const nombreInput = document.querySelector(".registroNombre");
        const correoInput = document.querySelector(".registroCorreo");
        const contrasennaInput = document.querySelector(".registroContrasenna");
        let error = false;
        if (nombreInput.value.trim() === ""){
            nombreInput.classList.add("invalid");
            nombreInput.setAttribute("placeholder", "Nombre obligatorio");
            error = true;
        }else{
            nombreInput.classList.remove("invalid");
        }
        if (correoInput.value.trim() === ""){
            correoInput.classList.add("invalid");
            correoInput.setAttribute("placeholder", "Correo obligatorio");
            error = true;
        }else{
            correoInput.classList.remove("invalid");
        }
        if (contrasennaInput.value.trim() === ""){
            contrasennaInput.classList.add("invalid");
            contrasennaInput.setAttribute("placeholder", "Contraseña obligatorio");
            error = true;
        }else{
            contrasennaInput.classList.remove("invalid");
        }
        if (error){
            crearUsuario.preventDefault();
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const formResponderPregunta = document.querySelector(".formResponderPregunta");
    formResponderPregunta.addEventListener("submit", function (event) {
        const textareaInput = document.querySelector(".area");
        const archivoInput = document.querySelector("#archivo");
        const fotoInput = document.querySelector("#foto");
        let error = false;
        if (textareaInput.value.trim() === "" && archivoInput.files.length === 0 && fotoInput.files.length === 0) {
            textareaInput.classList.add("invalid");
            textareaInput.setAttribute("placeholder", "Es obligatorio añadir contenido, una foto o un archivo");
            error = true;
        } else {
            textareaInput.classList.remove("invalid");
        }
        if (error) {
            event.preventDefault();
        }
    });
});