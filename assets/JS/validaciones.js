/*Validaciones Login*/
const formLogin = document.getElementById("loginform");
formLogin.addEventListener("submit",function(enviarFormulario){
    const nombreInput = document.querySelector(".loginNombre");
    const contrasennaInput = document.querySelector(".loginContrasenna");
    let error = false;
    if (nombreInput.value.trim() === ""){
        nombreInput.classList.add("invalid");
        nombreInput.setAttribute("placeholder","El nombre es obligatorio");
        error = true;
    }else{
        nombreInput.classList.remove("invalid")
    }
    if (contrasennaInput.value.trim() === ""){
        contrasennaInput.classList.add("invalid");
        contrasennaInput.setAttribute("placeholder","La contraseña es obligatoria");
        error = true
    }else{
        contrasennaInput.classList.remove("invalid")
    }
    if (error){
        enviarFormulario.preventDefault();
    }
});