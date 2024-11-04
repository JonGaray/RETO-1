<div class="pagina-usuario">
<div class="div-foto-perfil">
        <label for="foto">
           <img class="foto-perfil" src="<?php echo $dataToView["data"]["usuario"]["foto"]!="" ? $dataToView["data"]["usuario"]["foto"] : 'assets/Images/blank-profile-picture-973460_1280.webp';?>" alt="">
        </label>
           <form method="post" enctype="multipart/form-data" action="index.php?controller=usuario&action=guardarFotoPerfilPreguntas">
            <input style="display: none;" type="file" name="foto" id="foto">
            <input type="submit" class="btn-enviar-foto">
           </form>
        </div>
        <div class="div-principal-respuestas">
            <h3>PREGUNTAS</h3>
            <?php if(!empty($dataToView["data"]["preguntas"])): foreach($dataToView["data"]["preguntas"] as $preguntas):?>
            <div class="div-respuesta">
                <div class="titulo_pregunta">
                    <h2>¿ <?php echo $preguntas["titulo"]?> ?</h2>
                </div>
                <div class="respuesta-usuario">
                   <?php echo $preguntas["descripcion"] ?>
                </div>
                <div class="likes">
                    <a class="btn-ver-mas" href="index.php?controller=pregunta&action=detalle&id=<?php echo $preguntas["id"] ?>">Ver mas</a>
                    <form method="post" action="index.php?controller=usuario&action=deletePregunta">
                        <input type="hidden" id="id" name="id" value="<?php echo $preguntas["id"] ?>">
                        <button class="btn-eliminar-pregunta-usuario" type="submit">
                            <img class="papelera_usuario" src="assets/Images/papelera.png" alt="">
                        </button>
                    </form>
                </div>
            </div>
            <?php endforeach; else: ?>
            <?php endif; ?>
        </div>
        <div class="datos-usuario">
            <form id="formDatosUsuario" class="form-datos-usuario" action="index.php?controller=usuario&action=updateUsuarioPreguntas" method="post">
                <input name="id" id="id" type="hidden" value="<?php echo $dataToView["data"]["usuario"]["id"] ?>">
                <input name="nombre" id="nombre" type="text" value="<?php echo $dataToView["data"]["usuario"]["nombre"] ?>" placeholder="nombre">
                <input name="correo" id="correo" type="text" value="<?php echo $dataToView["data"]["usuario"]["correo"]  ?>" placeholder="correo">
                <input name="contrasenna" id="contrasenna" type="text" value="<?php echo $dataToView["data"]["usuario"]["contrasenna"]  ?>" placeholder="contraseña">
                <input type="submit" value="Guardar">
            </form>
        </div>
        <div class="acciones-usuario">
            <a class="link-acciones-usuario" href="#" onclick="habilitarInputs()">Editar perfil</a>
            <a class="link-acciones-usuario" href="index.php?controller=usuario&action=listRespuestas">Mostrar respuestas</a>
            <a class="link-acciones-usuario" href="#">Mostrar preguntas</a>
            <?php if (isset($_COOKIE["rol_usuario"]) && $_COOKIE["rol_usuario"] == "admin") { ?>
                <a class="link-acciones-usuario" href="index.php?controller=usuario&action=create">Crear usuario</a>
            <?php } ?>
        </div>
</div>
<script>
    function habilitarInputs() {
        var datosUsuarioDiv = document.querySelector('.datos-usuario');
        if (datosUsuarioDiv) {
            datosUsuarioDiv.classList.add('visible');
        }
    }
</script>