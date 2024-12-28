<?php
    function comprobar_rol($nombre, $clave, $rol){
        $cadena_conexion = "mysql:dbname=empresa;host=127.0.0.1";
        $usuario = "root";
        // RECORDAR CAMBIAR ESTA VARIABLE DE NOMBRE PORQUE VA A INTERFERIR 
        // SI TENEMOS OTRA COMO "clave" QUE SE LLAME IGUAL
        $clave_conexion = "";
        $errmode = [PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT];

        try{
        $db = new PDO($cadena_conexion,$usuario,$clave_conexion,$errmode);
        echo "Conexion realizada con exito<br>";
            // beginTransaction es para realizar una modificacion en la bbdd
            $db->beginTransaction();
            $ins = "INSERT into usuarios (nombre,clave,rol)values(?,?,?);";
            $usuarios = $db->prepare($ins);
            // cada variable dentro del array corresponde a una ? de la consulta
            $usuarios->execute(array($nombre,$clave,$rol));

            // Aqui va a comprobar si la inserccion ha fallado y en caso
            // de fallar la detendra con rollback
            if(!$usuarios){
                echo "Error: " . print_r($db->errorInfo()) . "<br>";
                $db->rollback();
                echo "Transaccion anulada";
            }
            // si ha salido bien la ejecutara con commit
            else{
                echo "Usuario añadidio";
                $db->commit();
            }
        }
        catch(PDOException $e){
            echo "Error con la base de datos: ". $e->getMessage();
        }
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // asignamos una variable al valor del input para luego pasarla como parametro
        // al insert into y insertarla dentro de la tabla usuarios
        $nombre = $_SESSION["usuario"] = $_POST["usuario"];
        $clave = $_SESSION["clave"] = $_POST["clave"];
        $rol = $_SESSION["rol"] = $_POST["rol"];

        comprobar_rol($nombre,$clave,$rol);
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

    <?php
    // Mostrar mensaje si el usuario no ha ingresado correctamente
    if (isset($_GET["redirigido"])) {
        echo "<p>Haga login para continuar</p>";
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="usuario">Usuario</label>
        <input id="usuario" name="usuario" type="text" value="">
        <br>
        <label for="clave">Clave</label>
        <input id="clave" name="clave" type="password" value="">
        <br>
        <label for="rol">Rol</label>
        <input id="rol" name="rol" type="password" value="">
        <br>
        <input name="enviar" type="submit" value="enviar">
    </form>
</body>
</html>