<div class="pagina-usuario">
        <div class="div-foto-perfil">
           <img class="foto-perfil" src="assets/Images/blank-profile-picture-973460_1280.webp" alt="">
        </div>
        <div class="div-principal-respuestas">
            <h3>PREGUNTAS</h3>
            <?php if(!empty($dataToView["data"]["preguntas"])): foreach($dataToView["data"]["preguntas"] as $preguntas):?>
            <div class="div-respuesta">
                <div class="titulo_pregunta">
                    <h2><?php echo $preguntas["titulo"]?></h2>
                </div>
                <div class="respuesta">
                   <?php echo $preguntas["descripcion"] ?>
                </div>
                <div class="likes">
                    <a class="ver-mas" href="#">Ver mas</a>
                    <a href="#"><img class="papelera_usuario" src="assets/Images/papelera.png" alt=""></a>
                </div>
            </div>
            <?php endforeach; else: ?> <p>hola</p>;<?php endif; ?>
            <div class="botones-respuestas">
                <a class="btn-anterior" href="#">Anterior</a>
                <a class="btn-siguiente" href="#">Siguiente</a>
            </div>
        </div>
        <div class="datos-usuario">
            <form class="form-datos-usuario" action="index.php?controller=usuario&action=update" method="post">
                <input name="id" id="id" type="hidden" value="<?php echo $dataToView["data"]["usuario"]["id"] ?>">
                <input name="nombre" id="nombre" class="deshabilitado" type="text" value="<?php echo $dataToView["data"]["usuario"]["nombre"] ?>" placeholder="nombre" disabled>
                <input name="correo" id="correo" class="deshabilitado" type="text" value="<?php echo $dataToView["data"]["usuario"]["correo"]  ?>" placeholder="correo" disabled>
                <input name="contrasenna" id="contrasenna" class="deshabilitado" type="text" value="<?php echo $dataToView["data"]["usuario"]["contrasenna"]  ?>" placeholder="contraseña" disabled>
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
            <a class="link-acciones-usuario" href="index.php?controller=usuario&action=listRespuestas">Mostrar respuestas</a>
            <a class="link-acciones-usuario" href="#">Mostrar preguntas</a>
        </div>
</div>