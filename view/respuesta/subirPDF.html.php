<article class="subirPDF">
    <div class="container1">
        <h2>Subir guía de reparación</h2>
        <form action="index.php?controller=respuesta&action=subirPDF" method="post" enctype="multipart/form-data">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <div class="container">
                <div class="folder">
                    <div class="front-side">
                        <div class="tip"></div>
                        <div class="cover"></div>
                    </div>
                    <div class="back-side cover"></div>
                </div>
                <label class="custom-file-upload">
                    <input class="title" type="file" name="archivo" id="archivo"/>
                    Seleccionar archivo
                </label>
            </div>
            <div class="buttons">
                <button type="submit">Aceptar</button>
                <button type="button" onclick="window.location.href='index.php?controller=pregunta&action=list'">Cancelar</button>
            </div>
        </form>
    </div>
</article>