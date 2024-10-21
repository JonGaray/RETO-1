<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .preguntaBlock {
        background-color: #364156;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 5px 5px 10px #dff8eb56;
        width: 50%;
        height: 25%;
        margin: 0 auto;
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
        height: 10%;
        padding: 10px;
        background-color: #CDCDCD;
        border-radius: 15px;
        border: none;
        resize: none;
        text-align: center;
        display: flex;
        justify-content: center;
        align-content: center;
    }
    .preguntasBottomRight input {
        padding: 10px;
        background-color: #CDCDCD;
        border-radius: 15px;
        border: none;
        margin-bottom: 10px;
        text-align: center;
    }
</style>
<form action="index.php?controller=pregunta&action=save">
    <div class="preguntaBlock">
        <div class="preguntaTopSection">
            <input type="text" name="titulo" class="titulo" placeholder="Título">
        </div>
        <div class="preguntaBottomSection">
            <div class="preguntaBottomLeft">
                <input type="text" name="descripcion"  class="descripcion" placeholder="Descripción">
            </div>
            <div class="preguntasBottomRight">
                <input type="text" name="usuario"  class="usuario" placeholder="Usuario">
                <input type="text" name="categoria"  class="categoria" placeholder="Categoria">
            </div>
        </div>
    </div>
    <div>
        <input type="submit" value="Añadir pregunta" name="submit" class="annadirPregunta">
    </div>
</form>