<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .superiorRegistro{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #393939;
        height: 70vh;
        width: 100%;
        color: #CDCDCD;
    }
    .Registro{
        display: block;
        text-align: center;
        background-color: #364156;
        padding-top: 50px;
        width: 30%;
        height: 80%;
        box-shadow: 5px 5px 10px #dff8eb56;
        border-radius: 15px;
        padding: 30px;
    }
    .Registro h1{
        color: #CDCDCD;
        padding-top: 25px;
        padding-bottom: 25px;
    }
    .Registro hr{
        margin: 0 auto;
        width: 75%;
        height: 2px;
        background-color: #CDCDCD;
    }
    .campos{
        padding-top: 75px;
    }
    .registroNombre{
        display: block;
        margin: 0 auto;
        margin-bottom: 25px;
        text-align: center;
        padding: 20px 40px;
        font-size: larger;
        font-weight: bold;
        background-color: #CDCDCD;
        border-radius: 15px;
        box-shadow: 5px 5px 10px #393939;
    }
    .registroContrasenna{
        display: block;
        margin: 0 auto;
        margin-bottom: 25px;
        text-align: center;
        padding: 20px 40px;
        font-size: larger;
        font-weight: bold;
        background-color: #CDCDCD;
        border-radius: 15px;
        box-shadow: 5px 5px 10px #393939;
    }
    .registroCorreo{
        display: block;
        margin: 0 auto;
        margin-bottom: 25px;
        text-align: center;
        padding: 20px 40px;
        font-size: larger;
        font-weight: bold;
        background-color: #CDCDCD;
        border-radius: 15px;
        box-shadow: 5px 5px 10px #393939;
    }
    .registroEntrar{
        display: block;
        margin: 0 auto;
        margin-bottom: 25px;
        text-align: center;
        padding: 15px 138px;
        font-size: larger;
        font-weight: bold;
        background-color: #CDCDCD;
        border-radius: 25px;
        box-shadow: 5px 5px 10px #393939;
    }
</style>
<form class="form_registro" action="index.php?controller=usuario&action=save" method="post">
    <div class="superiorRegistro">
        <div class="Registro">
            <hr>
            <h1>CREAR USUARIO</h1>
            <hr>
            <div class="campos">
                <input type="text" name="nombre" class="registroNombre" placeholder="Nombre" style="font-weight: bold">
                <input type="password" name="contrasenna" class="registroContrasenna" placeholder="Contrase&ntilde;a">
                <input type="correo" name="correo" class="registroCorreo" placeholder="Correo">
            </div>
            <input type="submit" value="Entrar" name="submit" class="registroEntrar">
        </div>
    </div>
</form>