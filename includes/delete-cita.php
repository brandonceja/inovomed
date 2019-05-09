<?php
include "dbh.php";

if(isset($_GET['cita'])){
    $cita = $_GET['cita'];

    $sql = "SELECT email, nombres, apellidoP, apellidoM, fecha, horario FROM medicos INNER JOIN citas ON medicos.cedula=citas.medico WHERE citas.id='$cita'";
    $query = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($query)){
        $emailDoctor = $row[0];
        $nameDoctor = $row[1];
        $ap1Doctor = $row[2];
        $ap2Doctor = $row[3];
        $fecha = $row[4];
        $horario = $row[5];
    }

    $sql = "SELECT email, nombre, apellidoP, apellidoM FROM users INNER JOIN citas ON users.id=citas.paciente WHERE citas.id='$cita'";
    $query = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($query)){
        $emailPaciente = $row[0];
        $nomPaciente = $row[1];
        $ap1Paciente = $row[2];
        $ap2Paciente = $row[3];
    }

    $sql = "SELECT email, horario, fecha FROM medicos INNER JOIN citas ON medicos.cedula=citas.medico WHERE citas.id='$cita'";
    $query = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($query)){
        $emailMedico = $row[0];
        $hora = $row[1];
        $fecha = $row[2];
    }

    $sql = "DELETE FROM citas WHERE id='$cita'";
    $query = mysqli_query($conn, $sql);


     //SEND MAIL TO PATIENT

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
     $mail->addAddress($emailPaciente, $nomPaciente.' '.$ap1Paciente.' '.$ap2Paciente);     // Add a recipient
     $mail->addReplyTo(EMAIL);

     $mail->isHTML(true);                                  // Set email format to HTML


     $content = '<div style="background-color:#ededed; padding: 2em 2em; ">
     <div style="background-color:white; text-align:center; width: 80%; margin-left:10%; padding-top: 3em;">
         <img src="https://i.ibb.co/SB9L5V8/logo.png" alt="">
         <br><br>
             <h2 style="color:#bebebe; font-family:Arial;">Su cita del '.$fecha.' a las '.$hora.'. <br>
                ha sido cancelada.  <br><br><br>
             </h2>		
     </div>
     </div>';

     $mail->Subject = 'Su cita en Inovomed cancelada';
     $mail->Body    = $content;
     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

     if(!$mail->send()) {
         echo 'Message could not be sent.';
         echo 'Mailer Error: ' . $mail->ErrorInfo;
     } else {
         echo 'Message has been sent';
     }


     //SEND MAIL TO DOCTOR

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
     $mail->addAddress($emailMedico, "Médico de Inovomed");     // Add a recipient
     $mail->addReplyTo(EMAIL);

     $mail->isHTML(true);                                  // Set email format to HTML


     $content = '<div style="background-color:#ededed; padding: 2em 2em; ">
     <div style="background-color:white; text-align:center; width: 80%; margin-left:10%; padding-top: 3em;">
         <img src="https://i.ibb.co/SB9L5V8/logo.png" alt="">
         <br><br>
             <h2 style="color:#bebebe; font-family:Arial;">Su cita del '.$fecha.' a las '.$hora.'. <br>
                 con el paciente '.$nomPaciente.' '.$ap1Paciente.' '.$ap2Paciente.'<br>
                 ha sido cancelada.<br><br><br>
             </h2>
     </div>
     </div>';

     $mail->Subject = 'Cita de Inovomed cancelada';
     $mail->Body    = $content;
     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

     if(!$mail->send()) {
         echo 'Message could not be sent.';
         echo 'Mailer Error: ' . $mail->ErrorInfo;
     } else {
         echo 'Message has been sent';
     }

    
    if(isset($_GET['doc'])){
        header("Location: ./users/citas-doctor.php");
        exit();
    }


    header("Location: ./users/citas.php");
    exit();

}else{
    header("Location: ../index.php");
    exit();
}