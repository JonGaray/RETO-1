<?php 

if(isset($dataToView["data"]["nombre"])) $nombre=$dataToView["data"]["nombre"];
if(isset($dataToView["data"]["correo"])) $correo=$dataToView["data"]["correo"];
if(isset($dataToView["data"]["contrasenna"])) $contrasenna=$dataToView["data"]["contrasenna"];

?>

<div class="pagina-usuario">
        <div class="div-foto-perfil">
           <img class="foto-perfil" src="assets/Images/blank-profile-picture-973460_1280.webp" alt="">
        </div>
        <div class="div-principal-respuestas">
            <h3>RESPUESTAS</h3>
            <div class="div-respuesta">
                <div class="respuesta">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Non perspiciatis magnam inventore ut unde iusto.
                </div>
                <div class="likes">
                    <img class="img-like" src="assets/Images/like.png" alt="">234
                    <img class="img-dislike" src="assets/Images/dislike.png" alt="">34
                    <a class="ver-mas" href="#">Ver mas</a>
                </div>
            </div>
            <div class="botones-respuestas">
                <a class="btn-anterior" href="#">Anterior</a>
                <a class="btn-siguiente" href="#">Siguiente</a>
            </div>
        </div>
        <div class="datos-usuario">
            <form class="form-datos-usuario" action="" method="post">
                <input class="deshabilitado" type="text" value="<?php echo $nombre ?>" placeholder="nombre" disabled>
                <input class="deshabilitado" type="text" value="<?php echo $correo ?>" placeholder="correo" disabled>
                <input class="deshabilitado" type="text" value="<?php echo $contrasenna ?>" placeholder="contraseña" disabled>
                <input class="deshabilitado" type="submit" value="Guardar" disabled>
            </form>
        </div>
        <script>
            function habilitarInputs() {
            var inputs = document.getElementsByClassName("deshabilitado");
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].disabled = false;
            }
        }
        </script>
        <div class="acciones-usuario">
            <a class="link-acciones-usuario" href="#" onclick="habilitarInputs()">Editar perfil</a>
            <a class="link-acciones-usuario" href="usuario_respuestas.html">Mostrar respuestas</a>
            <a class="link-acciones-usuario" href="#">Mostrar preguntas</a>
        </div>
</div>