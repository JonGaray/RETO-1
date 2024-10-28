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
        background-image: url(assets/Images/avion.jpg);
        background-repeat: no-repeat;
    }
    .inicioSesion{
        display: block;
        text-align: center;
        padding-top: 20px;
        margin-right: 250px;
        width: 30%;
        height: 60%;
        border-radius: 15px;
        background-color: white;
        backdrop-filter: blur(10px); /* Difuminado */
        background-color: rgba(255, 255, 255, 0.3); /* Fondo semi-transparente */

    }
    .inicioSesion h1{
        color: black;
        padding-top: 25px;
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
        padding: 10px 20px 10px 20px;
        font-size: larger;
        font-weight: bold;
        background-color: #CDCDCD;
        border-radius: 15px;
        box-shadow: 5px 5px 10px #393939;
        cursor: pointer;
    }
    @media (max-width: 768px) {
        .inicioSesion {
            width: 80%;
            height: 30%;
            padding: 1em;
        }
        .campos {
            padding-top: 2em;
        }
        .loginNombre, .loginContrasenna {
            padding: 15px 20px;
            font-size: 1.2em;
        }
        .loginEntrar {
            padding: 10px;
            font-size: 1.2em;
        }
    }
</style>
<div class="superiorInicioSesion">
    <div class="inicioSesion">
        <h1>INICIAR SESI&Oacute;N</h1>
        <form method="post" action="index.php?controller=usuario&action=login">
            <div class="campos">
                <input type="text" name="nombre" class="loginNombre" placeholder="Nombre">
                <input type="password" name="contrasenna" class="loginContrasenna" placeholder="Contrase&ntilde;a">
            </div>
            <input type="submit" value="Entrar" name="submit" class="loginEntrar" >
        </form>
    </div>
</div>
