<?php
    /*El array $_COOKIE almacena la inf de las cookies por el cliente(Navegador) */
    //Para manejar las cookies se usa la funcion setcookie()
    setcookie("visitas",1, time()-64);
    header("location:3_1_cookies.php");
?>