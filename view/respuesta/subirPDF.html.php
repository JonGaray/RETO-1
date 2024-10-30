

<article class="subirPDF">
    <div class="container">
        <h2>Subir guía de reparación</h2>
        <form action="index.php?controller=respuesta&action=subirPDF" method="post" enctype="multipart/form-data">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="file" name="archivo" accept=".pdf" required>
            <div class="buttons">
                <button type="submit">Aceptar</button>
                <button type="button" onclick="window.location.href='index.php?controller=pregunta&action=list'">Cancelar</button>
            </div>
        </form>
    </div>
</article>