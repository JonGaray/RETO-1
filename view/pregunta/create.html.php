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
                <input type="text" name="categoria" class="categoria" placeholder="Categoria"> <!-- Este campo se llenará con JS -->
            </div>
        </div>
        <div class="annadirPregunta">
            <input type="submit" value="Añadir pregunta" name="submit">
        </div>
    </div>
    <div class="seccionCategoria">
        <h3>CATEGORIAS</h3>
        <p>Motores</p>
        <p>Alerones</p>
        <p>Tren de aterrizaje</p>
        <p>Ventanas</p>
    </div>

</form>
    <script>
        const form = document.querySelector('.form');
        const categoriaItems = form.querySelectorAll('.seccionCategoria p');
        const categoriaInput = form.querySelector('input[name="categoria"]');
        categoriaItems.forEach(item => {
            item.addEventListener('click', () => {
                categoriaInput.value = item.textContent;
            });
        });
    </script>

