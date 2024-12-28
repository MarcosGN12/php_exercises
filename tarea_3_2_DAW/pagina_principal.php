<?php
    $cadena_conexion = "mysql:dbname=alumnos 24/25;host=127.0.0.1";
    $usuario_db = "root"; // Cambié el nombre de la variable para evitar conflicto
    $clave_conexion = "";
    $errmode = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // Usar ERRMODE_EXCEPTION

    $db = new PDO($cadena_conexion,$usuario_db,$clave_conexion,$errmode);
    session_start();

    if (!isset($_SESSION["usuario"])) {
        header("Location: login.php?redirigido=true");
    }

    try {
        echo "Bienvenido " . $_SESSION["usuario"];
        echo "<br>";
        // En caso de que tengamos rol 1 tendremos funciones de mas
        if($_SESSION["rol"] == 1){
            // En este post le agregaremos la condicion de que obtenga los datos a traves del name del boton
            // para que no se confunda con el otro
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['seleccionar_aleatorio'])) {
                $sql = "SELECT * from alumnos where curso = ?";
                $alumnos = $db->prepare($sql); 
                $alumnos->execute(array($_POST["curso"]));

                // Creamos un array para guardar las filas de las columnas de la consulta de alumnos
                $final=[];

                // Este for each sera el encargado de rellenar el array con los atributos de cada alumno´
                // $columna sera cada alumno con todos sus datos almacenados
                foreach($alumnos as $columna){
                array_push($final,$columna);
                }

                // Ahora usaremos una variable creada para almacenar una seleccion random de cualquier usuario
                // obtenido previamente
                $result=array_rand($final);
                
                // Estas variables van a almacenar los valores de los atributos del alumno
                // segun su colocacion de numeros que en este caso sera
                // 0 = id
                // 1 = NO LA PONEMOS YA QUE ES EL CURSO QUE YA HEMOS PEDIDO EN EL FORM Y ES INNECESARIA
                // 2 = nombre
                // 3 = apellidos
                $idFinal=$final[$result][0];
                $nombreFinal=$final[$result][2];
                $apellidosFinal=$final[$result][3];
            }
        }   

        // En este post le agregaremos la condicion de que obtenga los datos a traves del name del boton
        // para que no se confunda con el otro
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comprobar_alumno']) ) {
            $sql = "SELECT * from alumnos where curso = ?";
            $alumnos = $db->prepare($sql); 
            $alumnos->execute(array($_POST["curso"]));
        }

    }
    catch (Exception $e) {
        echo "Error con la base de datos: " . $e->getMessage();
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

    <?php if ($_SESSION["rol"] == 1) { ?>
    <br><br>
    <!-- Formulario para insertar usuarios -->
    <form action="insertar_usuarios.php" method="POST">
        <select name="curso" required>
            <!-- MODIFICAR ESTO, PARA QUE SE EJECUTE CON UN FOREACH Y IMPRIMA LOS CURSOS ASI -->
            <option>DAW1</option>
            <option>DAM1</option>
            <option>DAW2</option>
        </select> 
        <input id="nombre" name="nombre" type="text" placeholder="alumno" required>
        <input id="apellidos" name="apellidos" type="text" placeholder="apellidos" required>
        <button type="submit">añadir alumno</button>
    </form>

    <br>
    <!-- Formulario para borrar usuarios -->
    <form action="borrar_usuarios.php" method="POST">
        <select name="curso" required>
            <option>DAW1</option>
            <option>DAM1</option>
            <option>DAW2</option>
        </select> 
        <input id="nombre" name="nombre" type="text" placeholder="alumno" required>
        <input id="apellidos" name="apellidos" type="text" placeholder="apellidos" required>
        <button type="submit">Borrar alumno</button><br><br>
    </form>
    <!-- Formulario para seleccionar alumno aleatorio -->
    <form action="pagina_principal.php" method="POST">
        <select name="curso" required>
            <option>DAW1</option>
            <option>DAM1</option>
            <option>DAW2</option>
        </select> 
        <!-- Le agregamos name al boton para poder diferenciarlos dentro de 2 post distintos -->
        <button name="seleccionar_aleatorio" type="submit">Seleccionar alumno aleatorio</button>
    </form>

    <?php
    echo "<br>
    <table style='border-collapse:collapse;'>
        <tr>
            <td style='border: 1px solid black;'>ID</td>
            <td style='border: 1px solid black;'>Nombre</td>
            <td style='border: 1px solid black;'>Apellidos</td>
        </tr>
        <tr>
            <td style='border: 1px solid black;'>$idFinal</td>
            <td style='border: 1px solid black;'>$nombreFinal</td>
            <td style='border: 1px solid black;'>$apellidosFinal</td>
        </tr>
    </table><br>";
    ?>
    
<?php } ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <select name="curso">
            <option>DAW1</option>
            <option>DAM1</option>
            <option>DAW2</option>
        </select>
        <!-- Le agregamos name al boton para poder diferenciarlos dentro de 2 post distintos -->
        <button name="comprobar_alumno" type="submit">Mostrar alumnos</button>
    </form>
    <?php


    echo "<table style='border-collapse:collapse;'>";
    // Este bucle mostrara cada alumno del curso elegido en ese momento
        foreach($alumnos as $alum){
            echo "<tr>";
                echo "<td style='border: 1px solid black;'>" . $alum[0] . "</td>";
                echo "<td style='border: 1px solid black;'>" . $alum[1] . "</td>";
                echo "<td style='border: 1px solid black;'>" . $alum[2] . "</td>";
                echo "<td style='border: 1px solid black;'>" . $alum[3] . "</td>";
            echo "</tr>";
        }
    echo "</table>";
    echo "<br><a href = 'logout.php'>Salir</a>";
    ?>
</body>
</html>