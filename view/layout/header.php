<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ibai, Jon y Jordi">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/styles.css">
    <title>Document</title>
</head>
<body>
<header>

    <div class="div-header">
        <h1>Aergibide</h1> <h3 class="eslogan">Expertos en mantenerte en el cielo</h3>

    </div>

    <div class="div-nav">
    <nav>
        <hr class="hr-nav">
        <ul>
            <li>
                <a href="index.php?controller=pregunta&action=list">Inicio</a>
            </li>
            <li>
                <a href="">Guia de reparacion</a>
            </li>
            <li>
                <div class="div-buscar">
                    <input type="text" class="buscar" placeholder="   Buscar">
                    <img src="assets/Images/Lupa.png" alt="Lupita" class="lupa">
                </div
            </li>
            <li>
                <hr class="linea-nav">
            </li>
            <li>
                <div class="div-sesion">
                    <span id="cerrar-sesion-text" style="cursor: pointer;">
            Cerrar sesión
        </span>
                    <a id="imagen-redireccion" href="index.php?controller=usuario&action=listPreguntas">
                        <img src="assets/Images/Persona.png" alt="Personita" class="persona" style="vertical-align: middle; margin-left: 10px; width: 32px;">
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    </div>
    <script>
        function eliminarCookie(nombre) {
            document.cookie = nombre + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        }
        document.getElementById('cerrar-sesion-text').addEventListener('click', function(event) {
            eliminarCookie('nombre_usuario');
            eliminarCookie('rol_usuario');
            location.reload();
        });
    </script>
</header>

