<?php
use \PHPMailer\PHPMailer\PHPMailer;
require "./vendor/autoload.php";

    function enviar_correo($direccion,$cuerpo,$asunto) {
        $mail = new PHPMailer();
        $mail->isSMTP();

        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
            
        $mail->Username = "marcosnuero11@gmail.com"; // Correo desde el que se envia

        // Contraseña de aplicacion generada en configuracion de cuenta de google:
        $mail->Password = "lxpy vaix uibp jlob";
        // el segundo argumento (opcional) es el nombre que tendra el que lo envia para el que lo recibe
        $mail->setFrom("marcosnuero11@gmail.com","SuperApp");

        // Reasignamos la misma variable para que se pueda pasar por parametro y asi en cuerpo y direccion
        $asunto = $mail->Subject = $asunto; // asunto

        if(!$asunto) {
            echo "<br>Error: " . $mail->ErrorInfo . "<br><br>";
        }
        else{
            $mail->addAddress($asunto);
        }

        $cuerpo = $mail->MsgHTML($cuerpo);

        if(!$cuerpo) {
            echo "<br>Error: " . $mail->ErrorInfo . "<br>";
        }
        else{
            $mail->addAddress($cuerpo);
        }

        //$mail->addAttachment('C:\Users\jadgg\Desktop\correos\e\perfecto.jpg'); // archivo adjunto

        // Test es el nombre que tendra la cuenta a la que se manda para quien lo envia
        $direccion = $mail->addAddress("$direccion","Test");

        if(!$direccion) {
            echo "<br>Error: " . $mail->ErrorInfo . "<br><br>";
        }
        else{
            $mail->addAddress($direccion);
        }

        $resul = $mail->send();

        if (!$resul) {
            echo "<br><br>Error: " . $mail->ErrorInfo . "<br><br>";
        }
        else {
            echo "Enviado";
        }
    }
    
?>