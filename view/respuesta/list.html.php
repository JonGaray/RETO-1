<article>
    <div class="general">
        <form class="formResponderPregunta" method="post" action="index.php?controller=respuesta&action=save&id=<?php echo $_GET["id"]?>" enctype="multipart/form-data">
            <div class="segundo">
                <input type="text" class="id-hidden" name="id_preg" value="<?php echo $_GET["id"]?>">

                <div class="respuesta">
                    <p  class="parrafo-resp">¿ <?php echo $dataToView["data"]["titulo"]; ?> ?</p>
                    <textarea name="respuesta" id="respuesta" cols="10" rows="10" class="area"></textarea>
                    <div class="container">
                        <div class="folder">
                            <div class="front-side">
                                <div class="tip"></div>
                                <div class="cover"></div>
                            </div>
                            <div class="back-side cover"></div>
                        </div>
                        <label class="custom-file-upload">
                            <input class="title" type="file" name="archivo" id="archivo" onchange="verificarCampoTexto()"/>
                            Seleccionar archivo
                        </label>
                        <input type="text" id="nombre_archivo" name="nombre_archivo" class="nombre_archivo" placeholder="Nombre del archivo">
                    </div>
                    <script>
                        function verificarCampoTexto() {
                            const archivoInput = document.getElementById("archivo");
                            const textoInput = document.getElementById("nombre_archivo");
                            
                            if (archivoInput.files.length > 0) {
                                // Si hay un archivo seleccionado, hacer el campo de texto obligatorio
                                textoInput.required = true;
                            } else {
                                // Si no hay archivo seleccionado, el campo de texto no es obligatorio
                                textoInput.required = false;
                            }
                        }
                    </script>
                </div>
                <div class="botones">
                    <input class="btn btn-primary" type="submit" value="Enviar">
                    <input class="btn btn-danger" type="button" value="Cancelar" onclick="window.location.href='index.php?controller=pregunta&action=list'">
                </div>
            </div>
        </form>
    </div>
</article>
