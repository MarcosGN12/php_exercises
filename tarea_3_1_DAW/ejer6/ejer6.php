<?php

session_start();

$cadena_conexion = "mysql:dbname=empresa;host=127.0.0.1";
$usuario_db = "root"; // Cambié el nombre de la variable para evitar conflicto
$clave = "";
$errmode = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // Usar ERRMODE_EXCEPTION

try {
    $db = new PDO($cadena_conexion,$usuario_db,$clave,$errmode);
    echo "Conexion realizada con exito<br>";

    $sql = "SELECT * FROM usuarios";
    $usuarios = $db->query($sql);

}
catch (PDOException $e) {
    echo "".$e->getMessage()."";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de login</title>
</head>
<body>

<table>
    <?php
        // aqui imprimiremos cada columna con sus datos dentro
        // y utilizaremos un tr para almacenar el conjunto de valores de cada 
        // usuario con sus atributos.
        foreach ($usuarios as $row) {
            echo "<tr>";
            echo "<td style='border: 1px solid black;'>" . $row[0] . "</td>";
            echo "<td style='border: 1px solid black;'>" . $row[1] . "</td>";
            echo "<td style='border: 1px solid black;'>" . $row[2] . "</td>";
            echo "<td style='border: 1px solid black;'>" . $row[3] . "</td>";
            echo "</tr>";
        }
    ?>
</table>
</body>
</html>