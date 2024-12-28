<?php
    require "ejer8.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // este if comprueba que hayamos escrito algo en los input y lo envia
        if(enviar_correo($_POST["direccion"],$_POST["cuerpo"],$_POST["asunto"])){
            $resul = $mail->send();

            if (!$resul) {
                echo "<br><br>Error: " . $mail->ErrorInfo . "<br><br>";
            }
            else {
                echo "Enviado";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="direccion">Direccion</label>
        <input id="direccion" name="direccion" type="text" value="">
        <br>
        <label for="cuerpo">Cuerpo</label>
        <input id="cuerpo" name="cuerpo" type="text" value="">
        <br>
        <label for="asunto">Asunto</label>
        <input id="asunto" name="asunto" type="text" value="">
        <br>
        <input name="enviar" type="submit" value="enviar">
    </form>
</body>
</html>