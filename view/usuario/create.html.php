<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .superiorInicioSesion{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #393939;
        height: 100vh;
        width: 100%;
    }
    .inicioSesion{
        display: block;
        text-align: center;
        background-color: #364156;
        padding-top: 50px;
        width: 60%;
        height: 60%;
        box-shadow: 5px 5px 10px #dff8eb56;
        border-radius: 15px;
    }
    .inicioSesion h1{
        color: #CDCDCD;
        padding-top: 25px;
        padding-bottom: 25px;
    }
    .inicioSesion hr{
        margin: 0 auto;
        width: 75%;
    }
    .campos{
        padding-top: 75px;
    }
    .loginNombre{
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
    .loginContrasenna{
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
    .loginCorreo{
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
    .loginEntrar{
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
<form class="form" action="index.php?controller=usuario&action=save" method="post">
    <div class="inicioSesion">
        <hr>
        <h1>CREAR USUARIO</h1>
        <hr>
            <div class="campos">
                <input type="text" name="nombre" class="loginNombre" placeholder="Nombre">
                <input type="password" name="contrasenna" class="loginContrasenna" placeholder="Contrase&ntilde;a">
                <input type="correo" name="correo" class="loginCorreo" placeholder="Correo">
            </div>
            <input type="submit" value="Entrar" name="submit" class="loginEntrar">
    </div>
</form>