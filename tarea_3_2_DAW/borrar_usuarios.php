<?php
        $cadena_conexion = "mysql:dbname=alumnos 24/25;host=127.0.0.1";
        $usuario_db = "root"; // Cambié el nombre de la variable para evitar conflicto
        $clave_conexion = "";$errmode = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // Usar ERRMODE_EXCEPTION
            
        $db = new PDO($cadena_conexion,$usuario_db,$clave_conexion,$errmode);
        session_start();

        // Aqui almacenaremos las variables del formulario obtenidas del formularioa
        // para usarlas dentro del execute
        $curso = $_SESSION["curso"] = $_POST["curso"];
        $nombre = $_SESSION["nombre"] = $_POST["nombre"];
        $apellidos = $_SESSION["apellidos"] = $_POST["apellidos"];  
    
        $db->beginTransaction();
        $del = 'DELETE FROM alumnos WHERE curso =? AND nombre = ? AND apellidos = ?;';
        $alumnos = $db->prepare($del); 
        $alumnos->execute(array($curso,$nombre,$apellidos));

        if(!$alumnos){
            echo "Error: " . print_r($db->errorInfo()) . "<br>";
            $db->rollback();
            echo "Transaccion anulada";
        }

        else{
            echo "Usuario borrado";
            $db->commit();
        }

header("Location: pagina_principal.php");
?>