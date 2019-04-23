<?php
require '../phpmailer/PHPMailerAutoload.php';
require '../phpmailer/credentials.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 4;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = EMAIL;                 // SMTP username
$mail->Password = PASS;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom(EMAIL, 'Inovomed');
$mail->addAddress('brandonceja1701@gmail.com', 'Brandon Ceja');     // Add a recipient
$mail->addReplyTo(EMAIL);

$mail->isHTML(true);                                  // Set email format to HTML


$content = '<div style="background-color:#ededed; padding: 2em 2em; ">
<div style="background-color:white; text-align:center; width: 80%; margin-left:10%; padding-top: 3em;">
    <img src="https://i.ibb.co/SB9L5V8/logo.png" alt="">
    <br><br>
        <h2 style="color:#bebebe; font-family:Arial;">Su cita es en 17/01/1998 a las 14:00. <br>
            en el consultorio 4, edificio C, piso 2 <br>
            con Dr. Juan Pérez Lopez
        </h2>		
        <form class="cancel" action="javascript:void(0)" METHOD="GET">
        <input id="citta" type="hidden" value="<?php echo $id_cita;?>" name="cita">
        <input type="submit" value="Cancelar cita" style="padding: 0.6em 0.2em 0.6em 0.2em; 
        margin: 0; background-color:red; color:white; border:none;">
        <br><br>
    </form>
</div>
</div>';

$mail->Subject = 'Su cita en Inovomed';
$mail->Body    = $content;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}