<?php
// Iniciar la sesión si no se ha hecho ya
session_start();

function comprobar_usuario($nombre,$clave) {
    $cadena_conexion = "mysql:dbname=alumnos 24/25;host=127.0.0.1";
    $usuario_db = "root"; // Cambié el nombre de la variable para evitar conflicto
    $clave_conexion = "";
    $errmode = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // Usar ERRMODE_EXCEPTION
    
    $db = new PDO($cadena_conexion,$usuario_db,$clave_conexion,$errmode);
    echo "Conexion realizada con exito<br>";
    try {
        $sql = "SELECT nombre,clave,rol from usuarios where nombre = ? and clave = ?";
        $usuarios = $db->prepare($sql);
        // le vamos a agregar al array las dos columnas de nombre y clave que son las 
        // que van a remplazar la "?" del where de nombre y clave 
        $usuarios->execute(array($nombre,$clave));

        // este bucle va a revisar los datos insertados con la bbdd
        // en caso de no encontrar nada retornara false
        foreach($usuarios as $usua){
            $fila = $usua;
            return $fila;
        }
        return false;
    }
    catch (Exception $e) {
        echo "Error con la base de datos: " . $e->getMessage();
    }
}

// con este if revisaremos los datos que hayamos insertado en los input
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // aqui revisara que el usuario y contraseña sean correctos
    $usu = comprobar_usuario($_POST["usuario"],$_POST["clave"]);
    // aqui en caso de que la comprobacion sea erronea tendremos un error
    // y luego en el html nos entera al if del $err ya que este sera true
    if($usu==FALSE){
        $err = TRUE;
        $usuario = $_POST["usuario"];
    }
    // en caso de que la comprobacion sea correcta
    // iniciaremos sesion con ese usuario y contraseña
    // y accederemos a la pagina de inicio con el header
    else{
        session_start();
        // almacenaremos el usuario y rol ya que usaremos esos datos
        // dentro de esas variables
        $_SESSION["usuario"] = $_POST["usuario"];
        $_SESSION["rol"] = $usu["rol"];
        header("Location: pagina_principal.php");
    }
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
    // mostrar mensaje si el usuario no ha ingresado correctamente
    if (isset($_GET["redirigido"])) {
        echo "<p>Haga login para continuar</p>";
    }

    // en caso de que el usuario o contraseña sea incorrecto
    if (isset($err)){
        echo "Revisa usuario y contraseña";
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <!-- aqui tenemos los formularios que con el metodo post nos retornara luego los datos que necesitemos -->
        <label for="usuario">Usuario</label>
        <input id="usuario" name="usuario" type="text" value="<?php if (isset($nombre_usuario)) echo htmlspecialchars($nombre_usuario); ?>">
        <label for="clave">Clave</label>
        <input name="clave" type="password">
        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>