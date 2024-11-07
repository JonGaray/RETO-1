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
            <?php if(!empty($dataToView["data"]["respuestas"]["respuesta"])): foreach($dataToView["data"]["respuestas"]["respuesta"] as $index => $respuesta):?>
            <div class="div-respuesta">
                <div class="respuesta-usuario">
                <?php if( isset($respuesta['contenido']) && $respuesta['contenido'] !== "" ){
                    $textareaId = "contenido-" . $index;
                    $previewId = "preview-" . $index;
                    ?>
                    <div id="<?php echo $previewId; ?>"></div>
                   <textarea name="contenido" disabled class="contenido" id="<?php echo $textareaId; ?>"><?php echo $respuesta["contenido"] ?></textarea>
                   <?php }elseif(isset($respuesta['foto']) && $respuesta['foto'] !== "" ){ ?>
                            <img class="img-respuesta-usuario" src="<?php echo $respuesta["foto"] ?>" alt="">
                    <?php }elseif(isset($respuesta['archivo']) && $respuesta['archivo'] !== "" ){ ?>
                        <h2 class="titulo-documento">Documento a descargar: <?php echo $respuesta["nombre_archivo"] ?></h2>
                        <form method="post" action="index.php?controller=respuesta&action=descargarPDFRespuesta&id=<?php echo $respuesta['id'] ?>">
                        <button class="button">
                            <span class="button-content">Descargar</span>
                        </button>
                        </form>
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
    <div class="acciones-usuario">
        <a class="link-acciones-usuario" href="#">Mostrar respuestas <img src="assets/Images/Iconos/respuesta.png"></a>
        <a class="link-acciones-usuario" href="index.php?controller=usuario&action=listGuia">Guias de reparacion <img src="assets/Images/Iconos/guia.png"></a>
        <a class="link-acciones-usuario" href="index.php?controller=usuario&action=listPreguntas">Mostrar preguntas <img src="assets/Images/Iconos/pregunta.png"></a>
        <?php if (isset($_COOKIE["rol_usuario"]) && $_COOKIE["rol_usuario"] == "admin") { ?>
            <a class="link-acciones-usuario" href="index.php?controller=usuario&action=create">Crear usuario <img src="assets/Images/Iconos/adduser.png"> </a>
        <?php } ?>
        <a class="link-acciones-usuario" href="#" onclick="habilitarInputs()">Editar perfil<img src="assets/Images/Iconos/edit.png"></a>
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
</div>
<script>
    function habilitarInputs() {
        var datosUsuarioDiv = document.querySelector('.datos-usuario');
        if (datosUsuarioDiv) {
            datosUsuarioDiv.classList.add('visible');
        }
    }
        function extractYouTubeID(url) {
        const regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
        const match = url.match(regex);
        return match ? match[1] : null;
    }
        function previewYouTubeVideos() {
        const textareas = document.querySelectorAll('textarea.contenido');
        textareas.forEach(textarea => {
        const videoURL = textarea.value;
        const videoID = extractYouTubeID(videoURL);
        const previewDiv = document.getElementById('preview-' + textarea.id.split('-')[1]);
        if (previewDiv) {
        previewDiv.innerHTML = '';
        if (videoID) {
        textarea.style.display = "none";
        const iframe = document.createElement('iframe');
        iframe.src = `https://www.youtube.com/embed/${videoID}`;
        iframe.setAttribute('frameborder', '0');
        iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
        iframe.setAttribute('allowfullscreen', 'true');
        previewDiv.appendChild(iframe);
        iframe.style.display = "block";
    } else {
        textarea.style.display = "block";
    }
    }
    });
    }
        document.addEventListener('DOMContentLoaded', previewYouTubeVideos);
</script>