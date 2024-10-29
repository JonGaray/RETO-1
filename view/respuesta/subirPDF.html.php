<style>
article{
display: flex;
justify-content: center;
align-items: center;
}

.container {
background-color: #3a4a6b;
padding: 50px;
border-radius: 15px;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
width: 300px;
text-align: center;
margin: 2em;
}

/* Estilos del título */
.container h2 {
background-color: #d3d3d3;
padding: 10px;
border-radius: 4px;
color: #333;
margin-bottom: 20px;
font-size: 1.2em;
}

/* Estilos de los inputs */
.container input[type="text"],
.container input[type="file"] {
width: 100%;
padding: 10px;
margin: 10px 0;
border: none;
border-radius: 4px;
background-color: #d3d3d3;
color: #555;
}

/* Estilos de los botones */
.container .buttons {
display: flex;
justify-content: space-between;
margin-top: 15px;
}

.container button {
width: 48%;
padding: 10px;
border: none;
border-radius: 4px;
background-color: #d3d3d3;
color: #333;
cursor: pointer;
font-size: 1em;
}

.container button:hover {
background-color: #bcbcbc;
}
</style>


<article>
    <div class="container">
        <h2>Subir guía de reparación</h2>
        <form action="index.php?controller=respuesta&action=subirPDF" method="post" enctype="multipart/form-data">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="file" name="archivo" accept=".pdf" required>
            <div class="buttons">
                <button type="submit">Aceptar</button>
                <button type="button" onclick="window.location.href='index.php?controller=pregunta&action=list'">Cancelar</button>
            </div>
        </form>
    </div>
</article>