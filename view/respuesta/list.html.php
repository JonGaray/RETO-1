
<article>
    <div class="general">
        <form method="post" action="index.php?controller=respuesta&action=save&id=<?php echo $_GET["id"]?>">
        <div class="segundo">
            <input type="text" class="id-hidden" name="id_preg" value="<?php echo $_GET["id"]?>">

            <div class="respuesta">
                <p  class="parrafo-resp"> <?php echo $dataToView["data"]["titulo"]; ?></p>
                <textarea name="respuesta" id="respuesta" cols="10" rows="10" class="area"></textarea>

            </div>

            <div class="botones">

                <input class="btn btn-primary" type="submit" value="Enviar">
                <input class="btn btn-danger" type="reset" value="Cancelar">

            </div>
        </div>
        </form>
    </div>
</article>

