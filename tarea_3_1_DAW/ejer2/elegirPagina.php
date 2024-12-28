<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        setcookie("idioma",$_POST["idioma"], time()+30);
        header("Location: elegirPagina.php");
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

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <label for="eleccion">
            <input type="submit" name="idioma" value="ingles">
            En ingles
        </label>
        <br>
        <label>
        <input type="submit" name="idioma" value="español">
            En español
        </label>
        <br>
    </form>

    <?php
    // Aqui tendremos una condicion de que si la cookie no esta inicializada
    // la inicializaremos y en caso de que este inicialzada y sea español
    // mostrara eso y en caso contrario lo hara en ingles
        if(!isset($_COOKIE["idioma"]) || $_COOKIE["idioma"] == "español"){
            echo "muerte a php y larga vida a js";
        }
        else{
            echo "death to php and long live js";
        }
    ?>

</body>
</html>