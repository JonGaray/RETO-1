<div class="questionBlock">
    <div class="topSection">
        <input type="text" name="titulo" class="titulo" disabled value="<?php echo $dataToView["data"]['pregunta']['titulo'] ?? ''; ?>">
    </div>
    <div class="bottomSection">
        <div class="bottomLeft">
            <textarea name="descripcion" disabled class="descripcion"><?php echo $dataToView["data"]['pregunta']['descripcion'] ?? ''; ?></textarea>
        </div>
        <div class="bottomRight">
            <input type="text" name="usuario" disabled class="usuario" value="<?php echo $dataToView["data"]['pregunta']['nombre'] ?? ''; ?>">
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
                    <?php if( isset($respuesta['contenido']) && $respuesta['contenido'] !== "" ){ ?>
                        <textarea name="contenido" disabled class="contenido"><?php echo $respuesta['contenido'] ; ?></textarea>
                        <?php }elseif(isset($respuesta['foto']) && $respuesta['foto'] !== "" ){ ?>
                            <img  src="<?php echo $respuesta["foto"] ?>" alt="">
                        <?php } ?>
                    </div>
                    <div class="bottomRight">
                        <div class="like-section">
                            <form action="index.php?controller=respuesta&action=updatemegusta&id=<?php echo $respuesta['id']; ?>" method="post" class="formInteraccion">
                                <input type="hidden" name="pregunta_id" value="<?php echo $dataToView["data"]['pregunta']['pregunta_id']; ?>">
                                <button type="submit" name="megusta">
                                    <img src="assets/Images/megusta.png" alt="Me gusta">
                                </button>
                            </form>
                            <input type="text" name="megusta" disabled class="megusta" value="<?php echo isset($respuesta['megusta']) ? $respuesta['megusta'] : 0; ?>">
                        </div>
                        <div class="dislike-section">
                            <form action="index.php?controller=respuesta&action=updatenomegusta&id=<?php echo $respuesta['id']; ?>" method="post" class="formInteraccion">
                                <input type="hidden" name="pregunta_id" value="<?php echo $dataToView["data"]['pregunta']['pregunta_id']; ?>">
                                <button type="submit" name="nomegusta">
                                    <img src="assets/Images/nomegusta.png" alt="No me gusta">
                                </button>
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

