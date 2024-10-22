<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Categorías</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .preguntaBlock {
            background-color: #364156;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 5px 5px 10px #dff8eb56;
            width: 60%;
            margin: 20px auto;
        }

        .respuestaBlock {
            background-color: #364156;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 5px 5px 10px #dff8eb56;
            width: 60%;
            margin: 20px auto;
        }

        .topSection {
            display: flex;
            justify-content: center;
            margin: 5px;
            width: 100%;
        }

        .topSection input {
            width: 100%;
            padding: 10px 0;
            border-radius: 15px;
            text-align: center;
            background-color: #CDCDCD;
        }

        .bottomSection {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 10px;
        }

        .bottomLeft {
            flex: 1;
        }

        .bottomLeft input {
            width: 100%;
            height: 100%;
            padding: 10px;
            background-color: #CDCDCD;
            border-radius: 15px;
            border: none;
            resize: none;
            text-align: center;
        }

        .bottomRight {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex: 0.48;
            margin-top: 7px;
        }

        .bottomRight input {
            padding: 10px;
            background-color: #CDCDCD;
            border-radius: 15px;
            border: none;
            margin-bottom: 10px;
            text-align: center;
        }

        .like-section, .dislike-section {
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .like-section img, .dislike-section img {
            height: 35.5px;
            border-radius: 5px;
        }

        .like-section input, .dislike-section input {
            padding: 10px;
            background-color: #CDCDCD;
            border-radius: 15px;
            border: none;
            text-align: center;
            width: 80%;
        }

        form {
            display: flex;
            align-items: center;
        }

        form button {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        form button img {
            height: 35.5px;
        }
    </style>
</head>
<div class="preguntaBlock">
    <div class="topSection">
        <input type="text" name="titulo" class="titulo" disabled value="<?php echo $dataToView["data"][0]["pregunta_titulo"]; ?>">
    </div>
    <div class="bottomSection">
        <div class="bottomLeft">
            <input type="text" name="descripcion" disabled class="descripcion" value="<?php echo $dataToView["data"][0]["pregunta_descripcion"]; ?>">
        </div>
        <div class="bottomRight">
            <input type="text" name="usuario" disabled class="usuario" value="<?php echo $dataToView["data"][0]["usuario_nombre_preguntador"]; ?>">
            <input type="text" name="categoria" disabled class="categoria" value="<?php echo $dataToView["data"][0]["pregunta_categoria"]; ?>">
        </div>
    </div>
</div>
<?php
$x = 0;
if (count($dataToView["data"]) > 0){
    foreach ($dataToView["data"] as $respuesta){
        ?>
<div class="respuestaBlock">
    <div class="topSection">
        <input type="text" name="usuario" class="usuario" disabled value="<?php echo $dataToView["data"][$x]["usuario_nombre_respuesta"]; ?>">
    </div>
    <div class="bottomSection">
        <div class="bottomLeft">
            <input type="text" name="contenido" disabled class="contenido" value="<?php echo $dataToView["data"][$x]["respuesta_contenido"]; ?>">
        </div>
        <div class="bottomRight">
            <div class="like-section">
                <form action="index.php?controller=respuesta&action=updatemegusta&id=<?php echo $dataToView["data"][$x]["respuesta_id"]; ?>"" method="post">
                    <button type="submit" name="megusta">
                        <img src="assets/Images/megusta.png" alt="Me gusta">
                    </button>
                </form>
                <input type="text" name="megusta" disabled class="megusta" value="<?php echo $dataToView["data"][$x]["respuesta_megusta"]; ?>">
            </div>
            <div class="dislike-section">
                <form action="index.php?controller=respuesta&action=updatenomegusta&id=<?php echo $dataToView["data"][$x]["respuesta_id"]; ?>"" method="post">
                    <button type="submit" name="nomegusta">
                        <img src="assets/Images/nomegusta.png" alt="No me gusta">
                    </button>
                </form>
                <input type="text" name="nomegusta" disabled class="nomegusta" value="<?php echo $dataToView["data"][$x]["respuesta_nomegusta"]; ?>">
            </div>
        </div>
    </div>
</div>
<?php
        $x++;
}
}else{
    ?>
<p>Actualemte no existen respuestas</p>
<?php
    }
?>

</html>