<article class="vistaPDF">
    <a href="index.php?controller=respuesta&action=subirPDF" class="subirDocu">Subir guia de reparacion</a>
    <div class="table-header">
        <span class="column">Documento:</span>
        <span class="column">Descargar: </span></a>
        <?php if (isset($_COOKIE['rol_usuario']) && $_COOKIE['rol_usuario'] == 'admin') { ?>
        <p><?php echo "Opciones:"?></p>
        <?php } ?>
    </div>
    <?php foreach ($dataToView["data"] as $pdf): ?>
    <div class="table-header">
        <span class="column"><?php echo $pdf["nombre_documento"]?></span>
        <form method="post" action="index.php?controller=respuesta&action=descargarPDF&id=<?php echo $pdf["id_documento"]?>">
            <button class="button">
                <span class="button-content">Descargar</span>
            </button>
        </form>
        <?php if (isset($_COOKIE['rol_usuario']) && $_COOKIE['rol_usuario'] == 'admin') { ?>
            <form action="index.php?controller=respuesta&action=deletePDF&id=<?php echo $pdf["id_documento"]?>" method="post">
                <button type="submit" class="boton-eliminarPDF">Eliminar</button>
            </form>
        <?php } ?>
    </div>
        <?php endforeach; ?>
</article>

