<?php
    $cadena_conexion = "mysql:dbname=empresa;host=127.0.0.1";
    $usuario_db = "root"; // Cambié el nombre de la variable para evitar conflicto
    $clave_conexion = "";
    $errmode = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // Usar ERRMODE_EXCEPTION

    $db = new PDO($cadena_conexion,$usuario_db,$clave_conexion,$errmode);
    echo "Conexion realizada con exito<br>";

    session_start();
    // despues de iniciar sesion el if comprobara si la variable $_SESSION esta definida
    // en caso de no estarlo la iniciara
    if (!isset($_SESSION["usuario"])) {
        header("Location: 4_2_login.php?redirigido=true");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal</title>
</head>
<body>
    <?php
        // le daremos la bienvenida al usuario con su nombre
        echo "Bienvenido " . $_SESSION["usuario"];
        // EJERCICIO 5
        // en caso de que la columna rol sea 1 lanzara este mensaje
        if($_SESSION["rol"] == 1){
            echo "<br>Ahora eres admin";
        }
        // y si no es 1 dara este mensaje
        else{
            echo "<br>No eres admin";
        }
        echo "<br><a href = '4_2_sesiones_logout.php'>Salir</a>";
    ?>
</body>
</html>