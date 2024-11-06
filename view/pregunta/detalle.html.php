<style>

</style>
<div class="questionBlock">
    <div class="topSection">
        <input type="text" name="titulo" class="titulo" disabled value="¿ <?php echo $dataToView["data"]['pregunta']['titulo'] ?? ''; ?> ?" style="font-weight: bold">
    </div>
    <div class="bottomSection">
        <div class="bottomLeft">
            <textarea name="descripcion" disabled class="descripcion"><?php echo $dataToView["data"]['pregunta']['descripcion'] ?? ''; ?></textarea>
        </div>
        <div class="bottomRight">
            <input type="text" name="usuario" disabled class="usuario" value="- <?php echo $dataToView["data"]['pregunta']['nombre'] ?? ''; ?> -">
            <input type="text" name="categoria" disabled class="categoria" value="<?php echo $dataToView["data"]['pregunta']['categoria'] ?? ''; ?>">
        </div>
    </div>
</div>
<div class="respuestas">
    <?php if (!empty($dataToView["data"]['respuestas']["respuestas"])): ?>
        <?php foreach ($dataToView["data"]['respuestas']['respuestas'] as $index => $respuesta): ?>
            <div class="answerBlock">
                <div class="topSection">
                    <input type="text" name="usuario" class="usuario" disabled value="<?php echo isset($respuesta['usuario_nombre_respuesta']) ? $respuesta['usuario_nombre_respuesta'] : 'Desconocido'; ?>">
                </div>
                <div class="bottomSection">
                    <div class="bottomLeft">
                        <?php
                        if( isset($respuesta['contenido']) && $respuesta['contenido'] !== "" ){
                            // Asignar ids únicos basados en el índice o en el id de respuesta.
                            $textareaId = "contenido-" . $index;
                            $previewId = "preview-" . $index;
                            ?>
                            <textarea name="contenido" disabled class="contenido" id="<?php echo $textareaId; ?>"><?php echo $respuesta['contenido']; ?></textarea>
                            <div id="<?php echo $previewId; ?>"></div>
                        <?php } elseif(isset($respuesta['foto']) && $respuesta['foto'] !== "" ){ ?>
                            <img class="img-respuesta" src="<?php echo $respuesta["foto"] ?>" alt="">
                        <?php }elseif(isset($respuesta['archivo']) && $respuesta['archivo'] !== "" ){ ?>
                            <div class="contenido">
                                <h2>Documento a descargar</h2>
                                <a href="index.php?controller=respuesta&action=descargarPDFRespuesta&id=<?php echo $respuesta['id'] ?>">descargar<img src="assets/Images/download.png" alt=""></a>
                            </div>
                        <?php } ?> 
                    </div>
                    <div class="bottomRight">
                        <div class="like-section">
                            <form action="index.php?controller=respuesta&action=updatemegusta&id=<?php echo $respuesta['id']; ?>" method="post" class="formInteraccion">
                                <input type="hidden" name="pregunta_id" value="<?php echo $dataToView["data"]['pregunta']['pregunta_id']; ?>">
                                <label for="megusta-<?php echo $respuesta['id']; ?>" class="custom-checkbox">
                                    <input type="checkbox" id="megusta-<?php echo $respuesta['id']; ?>" name="megusta" <?php echo ($respuesta['megusta']) ? 'checked' : ''; ?> onchange="this.form.submit()">
                                    <span class="checkbox-icon">
                                        <img src="assets/Images/Iconos/megusta.png" alt="Me gusta">
                                    </span>
                                </label>
                            </form>
                            <input type="text" name="megusta" disabled class="megusta" value="<?php echo isset($respuesta['megusta']) ? $respuesta['megusta'] : 0; ?>">
                        </div>
                        <div class="dislike-section">
                            <form action="index.php?controller=respuesta&action=updatenomegusta&id=<?php echo $respuesta['id']; ?>" method="post" class="formInteraccion">
                                <input type="hidden" name="pregunta_id" value="<?php echo $dataToView["data"]['pregunta']['pregunta_id']; ?>">
                                <label for="nomegusta-<?php echo $respuesta['id']; ?>" class="custom-checkbox">
                                    <input type="checkbox" id="nomegusta-<?php echo $respuesta['id']; ?>" name="nomegusta" <?php echo ($respuesta['nomegusta']) ? 'checked' : ''; ?> onchange="this.form.submit()">
                                    <span class="checkbox-icon">
                                        <img src="assets/Images/Iconos/nomegusta.png" alt="No me gusta">
                                    </span>
                                </label>
                            </form>
                            <input type="text" name="nomegusta" disabled class="nomegusta" value="<?php echo isset($respuesta['nomegusta']) ? $respuesta['nomegusta'] : 0; ?>">
                        </div>
                    </div>
                </div>
                <?php if (isset($_COOKIE["rol_usuario"]) && $_COOKIE["rol_usuario"] == "admin"): ?>
                    <form action="index.php?controller=respuesta&action=delete" method="post">
                        <input type="hidden" name="id" value="<?php echo $respuesta['id']; ?>">
                        <input type="hidden" name="pregunta_id" value="<?php echo $dataToView["data"]['pregunta']['pregunta_id']; ?>">
                        <button type="submit" class="boton-eliminar">Eliminar</button>
                    </form>
                <?php endif; ?>
            </div>

        <?php endforeach; ?>
    <?php else: ?>
        <div class="noRespuestasBlock">
            <p>No existen respuestas para esta pregunta.</p>
        </div>
    <?php endif; ?>
</div>
<script>
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
