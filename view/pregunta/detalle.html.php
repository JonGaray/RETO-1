<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .preguntaBlock {
            background-color: #364156;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 5px 5px 10px #dff8eb56;
            width: 60%;
            margin: 20px auto;
        }

        .respuestaBlock {
            background-color: #364156;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 5px 5px 10px #dff8eb56;
            width: 60%;
            margin: 20px auto;
        }

        .noRespuestasBlock {
            text-decoration: none;
            padding: 8px 15px;
            border: 2px solid red;
            border-radius: 10px;
            color: red;
            background-color: #393939;
            display: block;
            width: fit-content;
            margin: 15px auto 0 auto;
            text-align: center;
            width: 60%;
            margin-bottom: 20px;
        }

        .topSection {
            display: flex;
            justify-content: center;
            margin: 5px;
            width: 100%;
        }

        .topSection input {
            width: 100%;
            padding: 10px 0;
            border-radius: 15px;
            text-align: center;
            background-color: #CDCDCD;
        }

        .bottomSection {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 10px;
        }

        .bottomLeft {
            flex: 1;
        }

        .bottomLeft input {
            width: 100%;
            height: 100%;
            padding: 10px;
            background-color: #CDCDCD;
            border-radius: 15px;
            border: none;
            resize: none;
            text-align: center;
        }
        .bottomRight {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            flex: 0.48;
            margin-top: 7px;
        }
        .bottomRight input {
            padding: 10px;
            background-color: #CDCDCD;
            border-radius: 15px;
            border: none;
            margin-bottom: 10px;
            text-align: center;
        }
        .like-section,
        .dislike-section {
            display: flex;
            align-items: center;
            justify-content: space-around;
        }
        .like-section img,
        .dislike-section img {
            height: 35.5px;
            border-radius: 5px;
        }
        .like-section input,
        .dislike-section input {
            padding: 10px;
            background-color: #CDCDCD;
            border-radius: 15px;
            border: none;
            text-align: center;
            width: 80%;
        }
        form {
            display: flex;
            align-items: center;
        }
        form button {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }
        form button img {
            height: 35.5px;
        }
        .boton-eliminar {
            text-decoration: none;
            padding: 8px 15px;
            border: 2px solid red;
            border-radius: 10px;
            color: red;
            background-color: #364156;
            display: block;
            width: fit-content;
            margin: 15px auto 0 auto;
            text-align: center;
            width: 60%;
            transition: background-color 0.5s ease;
        }
        .boton-eliminar:hover {
            background-color: red;
            color: white;
        }
        .descripcion, .contenido {
            resize: none;
            white-space: normal;
            overflow-wrap: break-word;
            background-color: #CDCDCD;
            border-radius: 15px;
            margin: 0 auto;
            text-align: center;
            display: flex;
            justify-content: center;
            padding: 10px;
            height: 100%;
            width: 100%;
            line-height: 1.5;
            border: 1px solid #ccc;
        }
</style>

<div class="preguntaBlock">
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
            <div class="respuestaBlock">
                <div class="topSection">
                    <input type="text" name="usuario" class="usuario" disabled value="<?php echo isset($respuesta['usuario_nombre_respuesta']) ? $respuesta['usuario_nombre_respuesta'] : 'Desconocido'; ?>">
                </div>
                <div class="bottomSection">
                    <div class="bottomLeft">
                        <textarea name="contenido" disabled class="contenido"><?php echo isset($respuesta['contenido']) ? $respuesta['contenido'] : 'Sin contenido'; ?></textarea>
                    </div>
                    <div class="bottomRight">
                        <div class="like-section">
                            <form action="index.php?controller=respuesta&action=updatemegusta&id=<?php echo $respuesta['id']; ?>" method="post">
                                <input type="hidden" name="pregunta_id" value="<?php echo $dataToView["data"]['pregunta']['pregunta_id']; ?>">
                                <button type="submit" name="megusta">
                                    <img src="assets/Images/megusta.png" alt="Me gusta">
                                </button>
                            </form>
                            <input type="text" name="megusta" disabled class="megusta" value="<?php echo isset($respuesta['megusta']) ? $respuesta['megusta'] : 0; ?>">
                        </div>
                        <div class="dislike-section">
                            <form action="index.php?controller=respuesta&action=updatenomegusta&id=<?php echo $respuesta['id']; ?>" method="post">
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

