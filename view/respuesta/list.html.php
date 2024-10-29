<article>
    <div class="general">
        <form class="formResponderPregunta" method="post" action="index.php?controller=respuesta&action=save&id=<?php echo $_GET["id"]?>" enctype="multipart/form-data">
            <div class="segundo">
                <input type="text" class="id-hidden" name="id_preg" value="<?php echo $_GET["id"]?>">

                <div class="respuesta">
                    <p  class="parrafo-resp">¿ <?php echo $dataToView["data"]["titulo"]; ?> ?</p>
                    <textarea name="respuesta" id="respuesta" cols="10" rows="10" class="area"></textarea>
                    <div class="archivoRespuesta">
                        <label for="archivo">Subir archivo:</label>
                        <input type="file" name="archivo" id="archivo" class="archivo">
                    </div>
                    <div class="archivoRespuesta">
                        <label for="foto">Subir foto:</label>
                        <input type="file" name="foto" id="foto" class="foto">
                    </div>
                </div>

                <div class="botones">
                    <input class="btn btn-primary" type="submit" value="Enviar">
                    <input class="btn btn-danger" type="button" value="Cancelar" onclick="window.location.href='index.php?controller=pregunta&action=list'">
                </div>
            </div>
        </form>
    </div>
</article>
<script src="assets/JS/validaciones.js"></script>

