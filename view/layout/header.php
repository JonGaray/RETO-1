<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ibai, Jon y Jordi">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/estilos/layout.css">
    <link rel="stylesheet" href="assets/estilos/pregunta.css">
    <link rel="stylesheet" href="assets/estilos/respuesta.css">
    <link rel="stylesheet" href="assets/estilos/usuario.css">
    <title>Document</title>
    <style>

    </style>
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
                    <a href="index.php?controller=pregunta&action=list" onclick="deleteCookieCategoria()">Inicio</a>
                </li>
                <li>
                    <a href="">Guia de reparacion</a>
                </li>
                <li>
                    <div class="div-buscar">
                        <form action="index.php?controller=pregunta&action=listCategoria" method="post" onsubmit="crearCookieCategoria();">
                            <input type="text" id="categoriaInput" name="categoria" class="buscar" placeholder="Buscar" required>
                            <button type="submit" class="lupa">
                                <img src="assets/Images/Lupa.png" alt="Lupita">
                            </button>
                        </form>
                    </div>
                </li>
                <li>
                    <hr class="linea-nav">
                </li>
                <li>
                    <div class="div-sesion">
                        <a class="cerrar-sesion" id="cerrar-sesion-text" style="cursor: pointer;">Cerrar sesión</a>
                        <a id="imagen-redireccion" href="index.php?controller=usuario&action=listPreguntas">
                            <img src="assets/Images/Persona.png" alt="Personita" class="persona" style="vertical-align: middle; margin-left: 10px; width: 32px;">
                        </a>
                        <a href="index.php?controller=usuario&action=listPreguntas"> <?php echo $_COOKIE["nombre_usuario"]?> </a>
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
            location.replace("index.php");
        });
        function crearCookieCategoria() {
            const categoriaInput = document.getElementById('categoriaInput').value;
            document.cookie = "categoria=" + encodeURIComponent(categoriaInput) + "; path=/";
        }
        function deleteCookieCategoria() {
            document.cookie = "categoria=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        }
    </script>
</header>
