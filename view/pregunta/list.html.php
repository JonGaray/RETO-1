<a href="index.php?controller=pregunta&action=create" class="crearPregunta">¿Cual es tu pregunta?</a>
<div class="preguntaGrupo">
    <?php if (isset($data) && count($data) > 0): ?>
        <?php foreach ($data as $pregunta): ?>
            <div class="preguntaBlock">
                <div class="preguntaTopSection">
                    <input type="text" name="titulo" class="titulo" disabled value="¿ <?php echo $pregunta['titulo']; ?> ?" style="font-weight: bold">
                </div>
                <div class="preguntaBottomSection">
                    <div class="preguntaBottomLeft">
                        <textarea name="descripcion" disabled class="descripcion"><?php echo $pregunta['descripcion']; ?></textarea>
                    </div>
                    <div class="preguntasBottomRight">
                        <input type="text" name="usuario" disabled class="usuario" value="- <?php echo $pregunta['nombre']; ?> -">
                        <input type="text" name="categoria" disabled class="categoria" value="<?php echo $pregunta['categoria']; ?>">
                        <div class="enlaces">
                            <a href="index.php?controller=respuesta&action=responder&id=<?php echo $pregunta['id']; ?>&user=<?php echo $pregunta['nombre']; ?>"><img src="assets/Images/Iconos/responderTodo.png"></a>
                            <a href="index.php?controller=pregunta&action=detalle&id=<?php echo $pregunta['id']; ?>"><img src="assets/Images/Iconos/info.png"></a>
                        </div>
                    </div>
                </div>
                <?php if (isset($_COOKIE['rol_usuario']) && $_COOKIE['rol_usuario'] == 'admin') { ?>
                    <form action="index.php?controller=pregunta&action=delete" method="post">
                        <input type="hidden" name="id" value="<?php echo $pregunta['id']; ?>">
                        <button type="submit" class="boton-eliminar">Eliminar</button>
                    </form>
                <?php } ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="sin-respuesta">Actualmente no existen preguntas</div>
    <?php endif; ?>
</div>

<!-- Botones de paginación -->
<div class="paginacion">
    <?php if ($paginaActual > 1): ?>
        <a href="index.php?controller=pregunta&action=list&page=<?php echo $paginaActual - 1; ?>" class="cambiarPagina">Anterior</a>
    <?php endif; ?>

    <?php if ($paginaActual < $totalPaginas): ?>
        <a href="index.php?controller=pregunta&action=list&page=<?php echo $paginaActual + 1; ?>" class="cambiarPagina">Siguiente</a>
    <?php endif; ?>
</div>

