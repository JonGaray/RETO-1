<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .superiorInicioSesion {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #393939;
        height: 100vh;
        width: 100%;
        background-image: url(assets/Images/avion.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        padding: 1em;
    }
    .inicioSesion {
        display: block;
        text-align: center;
        padding-top: 2em;
        margin-left: auto;
        margin-right: 20em;
        width: 30%;
        height: 60%;
        border-radius: 1em;
        background-color: rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
        overflow: auto;
    }
    .inicioSesion h1 {
        color: black;
        padding-top: 1.5em;
        font-size: 2em;
        word-wrap: break-word;
    }
    .campos {
        padding-top: 5em;
        max-width: 100%;
    }
    .loginNombre, .loginContrasenna {
        border: none;
        outline: none;
        display: block;
        margin: 0 auto;
        margin-bottom: 1.5em;
        text-align: center;
        padding: 1.25em 2.5em;
        font-size: 1.25em;
        font-weight: bold;
        background-color: #CDCDCD;
        border-radius: 1em;
        box-shadow: 0.3em 0.3em 0.625em #393939;
    }
    .loginEntrar {
        border: none;
        outline: none;
        display: block;
        margin: 0 auto;
        margin-bottom: 1.5em;
        text-align: center;
        padding: 0.75em 1.5em;
        font-size: 1.25em;
        font-weight: bold;
        background-color: #CDCDCD;
        border-radius: 1em;
        box-shadow: 0.3em 0.3em 0.625em #393939;
        cursor: pointer;
    }
    @media (max-width: 768px) {
        .superiorInicioSesion {
            margin: 0 auto;
            background-position: center;
        }
        .inicioSesion {
            margin: 0 auto;
            width: 100%;
            height: auto;
            padding: 1em;
        }
        .campos {
            padding-top: 2em;
        }
        .loginNombre, .loginContrasenna {
            padding: 1em 1.25em;
            font-size: 1.2em;
        }
        .loginEntrar {
            padding: 0.75em;
            font-size: 1.2em;
        }
    }
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="superiorInicioSesion">
    <div class="inicioSesion">
        <h1>INICIAR SESI&Oacute;N</h1>
        <form method="post" action="index.php?controller=usuario&action=login">
            <div class="campos">
                <input type="text" name="nombre" class="loginNombre" placeholder="Nombre">
                <input type="password" name="contrasenna" class="loginContrasenna" placeholder="Contrase&ntilde;a">
            </div>
            <input type="submit" value="Entrar" name="submit" class="loginEntrar">
        </form>
    </div>
</div>
