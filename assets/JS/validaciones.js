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
    const
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