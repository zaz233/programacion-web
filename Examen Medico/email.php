<?php
//Lamado a "La bAde De Datos", "El Creador de PDF" y "Archivo de informacion de usuario"
include 'PHP/conexion.php';
include 'PHP/pdf.php';
include 'datos.php'; //archivo donde estan subidos el usuario y la contrasela que no se subieron al git hub por temas de seguridad antihakeo

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$nombre = $sql_select_pdf_array['nombre_paciente'] . ' ' . $sql_select_pdf_array['apellido_paciente'];
$correo = $sql_select_pdf_array['email_paciente'];

sendEmail($pdfdoc, $nombre, $correo);

//Create an instance; passing `true` enables exceptions
function sendEmail($pdfdoc, $nombre, $correo){
    global $usuario;
    global $contraseña;
    $mail = new PHPMailer(true);
    
    
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $usuario;                     //SMTP username
        $mail->Password   = $contraseña;                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

        //Recipients
        $mail->setFrom($usuario, 'CLINICA PLUS');
        $mail->addAddress($correo, $nombre);     //Add a recipient

        $mail->addStringAttachment($pdfdoc,'Resultados.pdf');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Resultados Clinica';
        $mail->Body    = "Saludos cordiales tenga usted '$nombre', aqui estan los resultados de sus estudios medicos: ";
        $mail->AltBody = "Saludos cordiales tenga usted '$nombre', aqui estan los resultados de sus estudios medicos: ";

        $mail->send();

        echo 'Espere un momento ...';
        header('location:PHP/medico-view.php');

    } catch (Exception $e) {
        return [FALSE,"Message could not be sent. Mailer Error: {$mail->ErrorInfo}"];
    }
}