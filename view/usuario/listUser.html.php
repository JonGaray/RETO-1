<article class="vistaPDF">

    <?php foreach ($dataToView["data"] as $user): ?>
        <div class="table-header">
            <span class="column"><?php echo $user["nombre"]?></span>
            <span class="column"><?php echo $user["correo"]?></span>
            <span class="column"><?php echo $user["rol"]?></span>
            <?php if (isset($_COOKIE['rol_usuario']) && $_COOKIE['rol_usuario'] == 'admin') { ?>
                <form action="index.php?controller=usuario&action=deleteUser&id=<?php echo $user["id"]?>" method="post">
                    <button type="submit" class="boton-eliminarPDF">Eliminar</button>
                </form>
            <?php } ?>
        </div>
    <?php endforeach; ?>
</article>

