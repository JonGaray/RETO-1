<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .preguntaGrupo{
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        margin: 20px;
        width: 90%;
        margin: 20px auto;;
    }
    .preguntaBlock {
        background-color: #364156;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 5px 5px 10px #dff8eb56;
        width: 100%;
        margin: 25px;
        position: relative;
    }
    .preguntaTopSection{
        display: flex;
        justify-content: center;
        margin: 5px;
        width: 100%;
    }
    .preguntaTopSection input{
        width: 100%;
        padding: 10px 0;
        border-radius: 15px;
        text-align: center;
        background-color: #CDCDCD;
    }
    .preguntaBottomSection{
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 10px;
    }
    .preguntaBottomLeft{
        flex: 1;
    }
    .preguntaBottomLeft input{
        width: 100%;
        height: 100%;
        padding: 10px;
        background-color: #CDCDCD;
        border-radius: 15px;
        border: none;
        resize: none;
        text-align: center;
    }
    .preguntasBottomRight {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex: 0.48;
        margin-top: 7px;
    }
    .annadirPregunta{
        margin: 15px auto;
        width: 30%;
        height: 100%;
        padding: 10px;
        background-color: #CDCDCD;
        border-radius: 15px;
        border: none;
        resize: none;
        text-align: center;
        display: flex;
        justify-content: center;
        align-content: center;
        text-decoration: none;
        color: #393939;
    }
    .preguntasBottomRight input {
        padding: 10px;
        background-color: #CDCDCD;
        border-radius: 15px;
        border: none;
        margin-bottom: 10px;
        text-align: center;
    }
    .preguntasBottomRight .enlaces {
        display: flex;
        justify-content: space-around;
        margin-top: 10px;
    }
    .preguntasBottomRight .enlaces a {
        text-decoration: none;
        padding: 8px 15px;
        background-color: #CDCDCD;
        border-radius: 10px;
        color: #393939;
        box-shadow: 3px 3px 5px rgba(0,0,0,0.2);
    }
    .boton-eliminar {
        text-decoration: none;
        padding: 8px 15px;
        border: 2px solid red;
        border-radius: 10px;
        color: red;
        background-color: #364156;
        display: block;
        width: fit-content;
        margin: 15px auto 0 auto;
        text-align: center;
        width: 60%;
    }
    .sin-respuesta{
        text-decoration: none;
        padding: 8px 15px;
        border: 2px solid red;
        border-radius: 10px;
        color: red;
        background-color: #393939;
        display: block;
        width: fit-content;
        margin: 15px auto 0 auto;
        text-align: center;
        width: 60%;
        margin-bottom: 20px;
    }
</style>

<div>
    <a href="index.php?controller=pregunta&action=create" class="annadirPregunta">¿Cual es tu pregunta?</a>
</div>

<div class="preguntaGrupo">
    <?php
    if (count($dataToView["data"]) > 0){
        foreach ($dataToView["data"] as $pregunta){
            ?>
            <div class="preguntaBlock">
                <div class="preguntaTopSection">
                    <input type="text" name="titulo" class="titulo" disabled value="<?php echo $pregunta["titulo"]; ?>">
                </div>
                <div class="preguntaBottomSection">
                    <div class="preguntaBottomLeft">
                        <input type="text" name="descripcion" disabled class="descripcion" value="<?php echo $pregunta["descripcion"]; ?>">
                    </div>
                    <div class="preguntasBottomRight">
                        <input type="text" name="usuario" disabled class="usuario" value="<?php echo $pregunta["nombre"]; ?>">
                        <input type="text" name="categoria" disabled class="categoria" value="<?php echo $pregunta["categoria"]; ?>">
                        <div class="enlaces">
                            <a href="index.php?controller=respuesta&action=responder&id=<?php echo $pregunta["id"]; ?>">Responder</a>
                            <a href="index.php?controller=pregunta&action=detalle&id=<?php echo $pregunta["id"]; ?>">Ver m&aacute;s</a>
                        </div>
                    </div>
                </div>
                <?php if (isset($_COOKIE["rol_usuario"]) && $_COOKIE["rol_usuario"] == "admin") { ?>
                    <form action="index.php?controller=pregunta&action=delete" method="post">
                        <input type="hidden" name="id" value="<?php echo $pregunta['id']; ?>">
                        <button type="submit" class="boton-eliminar">Eliminar</button>
                    </form>
                <?php } ?>
            </div>
            <?php
        }
    }else{
        ?>
        <div class="sin-respuesta">Actualmente no existen preguntas</div>
        <?php
    }
    ?>
</div>
