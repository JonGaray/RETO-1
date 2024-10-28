<div class="pagina-usuario">
        <div class="div-foto-perfil">
        <label for="foto">
           <img class="foto-perfil" src="<?php echo $dataToView["data"]["usuario"]["foto"]!="" ? $dataToView["data"]["usuario"]["foto"] : 'assets/Images/blank-profile-picture-973460_1280.webp';?>" alt="">
        </label>
           <form method="post" enctype="multipart/form-data" action="index.php?controller=usuario&action=guardarFotoPerfilRespuestas">
            <input style="display: none;" type="file" name="foto" id="foto">
            <input type="submit" class="btn-enviar-foto">
           </form>
        </div>
        <div class="div-principal-respuestas">
            <h3>RESPUESTAS</h3>
            <?php if(!empty($dataToView["data"]["respuestas"])): foreach($dataToView["data"]["respuestas"] as $respuesta):?>
            <div class="div-respuesta">
                <div class="respuesta-usuario">
                   <p><?php echo $respuesta["contenido"] ?></p>
                </div>
                <div class="likes">
                    <img class="img-like" src="assets/Images/like.png" alt=""><?php echo $respuesta["megusta"] ?>
                    <img class="img-dislike" src="assets/Images/dislike.png" alt=""><?php echo $respuesta["nomegusta"] ?>
                    <a class="btn-ver-mas" href="index.php?controller=pregunta&action=detalle&id=<?php echo $respuesta["id_pregunta"] ?>">Ver mas</a>
                    <form method="post" action="index.php?controller=usuario&action=deleteRespuesta">
                    <input type="hidden" id="id" name="id" value="<?php echo $respuesta["id"] ?>">
                        <button class="btn-eliminar-pregunta-usuario" type="submit">
                            <img class="papelera_usuario" src="assets/Images/papelera.png" alt="">
                        </button>
                    </form>
                </div>
            </div>
            <?php endforeach; else: ?> <p>hola</p>;<?php endif; ?>
        </div>
        <div class="datos-usuario">
            <form class="form-datos-usuario" action="index.php?controller=usuario&action=updateUsuarioRespuestas" method="post">
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
            <a class="link-acciones-usuario" href="#">Mostrar respuestas</a>
            <a class="link-acciones-usuario" href="index.php?controller=usuario&action=listPreguntas">Mostrar preguntas</a>
            <a class="link-acciones-usuario" href="#">Crear usuario</a>
        </div>
</div>