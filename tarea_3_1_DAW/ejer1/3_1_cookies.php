<?php
/*El array $_COOKIE almacena la inf de las cookies por el cliente(Navegador) */
if(!isset($_COOKIE["visitas"])){
    //Para manejar las cookies se usa la funcion setcookie()
    setcookie("visitas",1, time()+10);
    echo"Bienvenido por primera vez";
}else{
    $visitas = $_COOKIE["visitas"];
    $visitas++;
    setcookie("visitas", $visitas, time()+10);
    echo "Bienvenido por $visitas vez";
}

// Creamos un boton con un href que nos va a redirigir a la pagina que va a borrar las cookies
echo "<br><a href='contador_visitas.php'>Quitar cookies</a>";
?>