/*Validaciones Buscar Por Categoria*/
const formLogin = document.getElementById("formBuscar");
formLogin.addEventListener("submit",function(realizarBusqueda){
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