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
                <?php if( isset($respuesta['contenido']) && $respuesta['contenido'] !== "" ){ ?>
                   <p><?php echo $respuesta["contenido"] ?></p>
                   <?php }elseif(isset($respuesta['foto']) && $respuesta['foto'] !== "" ){ ?>
                            <img class="img-respuesta-usuario" src="<?php echo $respuesta["foto"] ?>" alt="">
                        <?php } ?>
                </div>
                <div class="likes">
                    <img class="img-like" src="assets/Images/Iconos/like.png" alt=""><?php echo $respuesta["megusta"] ?>
                    <img class="img-dislike" src="assets/Images/Iconos/dislike.png" alt=""><?php echo $respuesta["nomegusta"] ?>
                    <a class="btn-ver-mas" href="index.php?controller=pregunta&action=detalle&id=<?php echo $respuesta["id_pregunta"] ?>">Ver mas</a>
                    <form method="post" action="index.php?controller=usuario&action=deleteRespuesta">
                    <input type="hidden" id="id" name="id" value="<?php echo $respuesta["id"] ?>">
                        <button class="btn-eliminar-pregunta-usuario" type="submit">
                            <img class="papelera_usuario" src="assets/Images/Iconos/papelera.png" alt="">
                        </button>
                    </form>
                </div>
            </div>
            <?php endforeach; else: ?>
            <?php endif; ?>
        </div>
        <div class="datos-usuario">
            <form id="formDatosUsuario" class="form-datos-usuario" action="index.php?controller=usuario&action=updateUsuarioRespuestas" method="post">
                <input name="id" id="id" type="hidden" value="<?php echo $dataToView["data"]["usuario"]["id"] ?>">
                <input name="nombre" id="nombre" type="text" value="<?php echo $dataToView["data"]["usuario"]["nombre"] ?>" placeholder="nombre">
                <input name="correo" id="correo" type="text" value="<?php echo $dataToView["data"]["usuario"]["correo"]  ?>" placeholder="correo">
                <input name="contrasenna" id="contrasenna" type="text" value="<?php echo $dataToView["data"]["usuario"]["contrasenna"]  ?>" placeholder="contraseña">
                <input class="guardarDatos" type="submit" value="Guardar">
            </form>
        </div>
        <div class="acciones-usuario">
            <a class="link-acciones-usuario" href="#" onclick="habilitarInputs()">Editar perfil <img src="assets/Images/Iconos/edit.png"></a>
            <a class="link-acciones-usuario" href="#">Mostrar respuestas <img src="assets/Images/Iconos/respuesta.png"></a>
            <a class="link-acciones-usuario" href="index.php?controller=usuario&action=listGuia">Guias de reparacion <img src="assets/Images/Iconos/guia.png"></a>
            <a class="link-acciones-usuario" href="index.php?controller=usuario&action=listPreguntas">Mostrar preguntas <img src="assets/Images/Iconos/pregunta.png"></a>
            <?php if (isset($_COOKIE["rol_usuario"]) && $_COOKIE["rol_usuario"] == "admin") { ?>
                <a class="link-acciones-usuario" href="index.php?controller=usuario&action=create">Crear usuario <img src="assets/Images/Iconos/adduser.png"> </a>
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