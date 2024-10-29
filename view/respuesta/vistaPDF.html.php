<style>
    article{
        display: flex;
        flex-direction: column;
    }

    .table-header {
        background-color: #2D3E50; /* Fondo azul oscuro */
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: space-around;
        flex-direction: row;
        color: #E0E0E0; /* Texto gris claro */
        font-size: 16px;
        font-weight: normal;
        gap: 20px;
        width: 80%;
        margin: 20px;
        border-radius:15px ;
    }

    /* Estilos para las columnas */
    .table-header .column {
        flex:1;
        text-align: center;
    }
</style>

<a href="index.php?controller=respuesta&action=subirPDF">effefef</a>



<article>
    <?php foreach ($dataToView["data"] as $pdf): ?>
    <div class="table-header">
        <span class="column">Nombre: <?php echo    $pdf["nombre_documento"]?></span>
        <span class="column"> <a href="index.php?controller=respuesta&action=descargarPDF&id=<?php echo $pdf["id_documento"]?>"><img src="assets/Images/download.png" ></span></a>
        <span class="column"><?php echo $pdf["nombre_usuario"]?></span>
    </div>
        <?php endforeach; ?>
</article>

