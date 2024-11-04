<style>
    .custom-checkbox {
        display: inline-block;
        position: relative;
        cursor: pointer;
    }

    .custom-checkbox input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .custom-checkbox .checkbox-icon {
        width: 24px;
        height: 24px;
        display: inline-block;
    }
    .custom-checkbox img {
        width: 100%;
        height: 100%;
        transition: opacity 0.2s ease;
    }
    .custom-checkbox input[type="checkbox"]:not(:checked) + .checkbox-icon img {
        opacity: 0.5;
    }
    .custom-checkbox input[type="checkbox"]:checked + .checkbox-icon img {
        opacity: 1;
    }
    .custom-checkbox:hover img {
        opacity: 0.8;
    }
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
        <?php foreach ($dataToView["data"]['respuestas']['respuestas'] as $respuesta): ?>
            <div class="answerBlock">
                <div class="topSection">
                    <input type="text" name="usuario" class="usuario" disabled value="<?php echo isset($respuesta['usuario_nombre_respuesta']) ? $respuesta['usuario_nombre_respuesta'] : 'Desconocido'; ?>">
                </div>
                <div class="bottomSection">
                    <div class="bottomLeft">
                    <?php 
                    if( isset($respuesta['contenido']) && $respuesta['contenido'] !== "" ){ ?>
                        <textarea name="contenido" disabled class="contenido"><?php echo $respuesta['contenido'] ; ?></textarea>
                        <?php }elseif(isset($respuesta['foto']) && $respuesta['foto'] !== "" ){ ?>
                            <img class="img-respuesta" src="<?php echo $dataToView["data"]['imagen'] ?>" alt="">
                        <?php } ?>
                    </div>
                    <div class="bottomRight">
                        <div class="like-section">
                            <form action="index.php?controller=respuesta&action=updatemegusta&id=<?php echo $respuesta['id']; ?>" method="post" class="formInteraccion">
                                <input type="hidden" name="pregunta_id" value="<?php echo $dataToView["data"]['pregunta']['pregunta_id']; ?>">
                                <label for="megusta-<?php echo $respuesta['id']; ?>" class="custom-checkbox">
                                    <input type="checkbox" id="megusta-<?php echo $respuesta['id']; ?>" name="megusta" <?php echo ($respuesta['megusta']) ? 'checked' : ''; ?> onchange="this.form.submit()">
                                    <span class="checkbox-icon">
                                        <img src="assets/Images/megusta.png" alt="Me gusta">
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
                                        <img src="assets/Images/nomegusta.png" alt="No me gusta">
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

