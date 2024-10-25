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
        align-items:last baseline;
        background-color: #393939;
        height: 100vh;
        width: 100%;
        background-image: url(../../assets/Images/avion.jpg) ;
    }
    .inicioSesion{

        display: block;
        text-align: center;
        padding-top: 50px;
        width: 50%;
        height: 60%;
        border-radius: 15px;
    }
    .inicioSesion h1{
        color: black;
        padding-top: 25px;
        padding-bottom: 25px;
    }
    .inicioSesion hr{
        color: black;
        margin: 0 auto;
        width: 75%;
    }
    .campos{
        padding-top: 75px;
    }
    .loginNombre{
        border: none;
        outline: none;
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
        border: none;
        outline: none;
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
        border: none;
        outline: none;
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
<div class="superiorInicioSesion">
    <div class="inicioSesion">
        <h1>INICIO DE SESI&Oacute;N</h1>
        <form method="post" action="index.php?controller=usuario&action=login">
            <div class="campos">
                <input type="text" name="nombre" class="loginNombre" placeholder="Nombre">
                <input type="password" name="contrasenna" class="loginContrasenna" placeholder="Contrase&ntilde;a">
            </div>
            <input type="submit" value="Entrar" name="submit" class="loginEntrar">
        </form>
    </div>
</div>
