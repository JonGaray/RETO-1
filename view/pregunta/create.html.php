<form class="form-createPregunta" action="index.php?controller=pregunta&action=save" method="post">
    <div class="createPreguntaBlock">
        <h3>NUEVA PREGUNTA</h3>
        <div class="preguntaTopSection">
            <input type="text" name="titulo" class="titulo" placeholder="Título">
        </div>
        <div class="preguntaBottomSection">
            <div class="preguntaBottomLeft">
                <input type="text" name="descripcion" class="descripcion" placeholder="Descripción">
            </div>
            <div class="preguntasBottomRight">
                <input type="text" name="nombre" class="nombre" placeholder="Usuario" value="<?php echo isset($_COOKIE['nombre_usuario']) ? htmlspecialchars($_COOKIE['nombre_usuario']) : ''; ?>">
                <!-- Si el rol = usuario, no dejar crear categorias -->
                <?php if (isset($_COOKIE['rol_usuario']) && $_COOKIE['rol_usuario'] === 'usuario'): ?>
                    <input type="text" name="categoria" class="categoria" placeholder="Categoria" readonly>
                <?php else: ?>
                    <input type="text" name="categoria" class="categoria" placeholder="Categoria">
                <?php endif; ?>
            </div>
        </div>
        <div class="annadirPregunta">
            <input type="submit" value="Añadir pregunta" name="submit">
        </div>
    </div>
    <div class="seccionCategoria">
        <h3>CATEGORIAS</h3>
        <?php
        foreach ($dataToView["data"] as $categoriaItem) {
            echo '<p>' . htmlspecialchars($categoriaItem['categoria']) . '</p>';
        }
        ?>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('.form-createPregunta');
        const categoriaItems = form.querySelectorAll('.seccionCategoria p');
        const categoriaInput = form.querySelector('input[name="categoria"]');
        if (!categoriaInput.disabled) {
            categoriaItems.forEach(item => {
                item.addEventListener('click', () => {
                    categoriaInput.value = item.textContent;
                });
            });
        }
    });
</script>