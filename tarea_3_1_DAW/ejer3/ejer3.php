<?php
    $cadena_conexion = "mysql:dbname=empresa;host=127.0.0.1";
    $usuario = "root";
    $clave = "";

    try{
        $db = new PDO($cadena_conexion,$usuario,$clave);
        echo "Conexion realizada con exito<br>";
        $sql = "SELECT nombre,clave,rol from usuarios";

        $usuarios = $db->query($sql);
        echo "<br>";
        $preparada = $db->prepare("SELECT codigo,nombre,clave,rol from usuarios where codigo = 3");
        // quitamos el 0 y lo dejamos vacio ya que si queremos usar el where
        // no podemos usar el 0 dentro del array
        $preparada->execute(array());

        echo "Usuario: <br><br>";
        foreach($preparada as $usu){ 
            // imprimimos los datos que queremos con un for each
            echo "codigo: " . $usu["codigo"] . "<br>";
            echo "nombre: " . $usu["nombre"] . "<br>";
            echo "clave: " . $usu["clave"] . "<br>";
            echo "rol: " . $usu["rol"] . "<br>";
        }

    }
    catch(Exception $e){
        echo "Error con la base de datos: ". $e->getMessage();
    }
?>