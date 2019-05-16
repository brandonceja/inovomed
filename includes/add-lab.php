<?php

/*Database connection */
include "dbh.php";

session_start();

if(isset($_SESSION['u_id']))
{
    if(isset($_GET['submit'])){

        $servicio = $_GET['servicio'];
        $paciente =  $_SESSION["u_id"];
        $horario = $_GET["horario"];
        $fecha = $_GET["fecha"];

        $horario = $horario.":00:00";

        $sql = "INSERT INTO citas_lab (id, servicio, paciente, hora, fecha) ".
            "VALUES ('', '$servicio', '$paciente', '$horario', '$fecha')";

        $query =  mysqli_query($conn, $sql);

        $last_id = mysqli_insert_id($conn);


        $sql = "SELECT users.nombre, apellidoP, apellidoM, email, servicios.nombre FROM users INNER JOIN citas_lab ON users.id = citas_lab.paciente 
                INNER JOIN servicios ON servicios.id = citas_lab.servicio WHERE citas_lab.id = '$last_id';";
        $query =  mysqli_query($conn, $sql);

        while ($row =  mysqli_fetch_array($query)){
            $nombreUser = $row[0];
            $apellidoPUser = $row[1];
            $apellidoMUser = $row[2];
            $email = $row[3];
            $servicio = $row[4];
        }


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
        $mail->addAddress($email, $nombreUser.' '.$apellidoPUser.' '.$apellidoMUser);     // Add a recipient
        $mail->addReplyTo(EMAIL);

        $mail->isHTML(true);                                  // Set email format to HTML


        $content = '<div style="background-color:#ededed; padding: 2em 2em; ">
        <div style="background-color:white; text-align:center; width: 80%; margin-left:10%; padding-top: 3em;">
            <img src="https://i.ibb.co/SB9L5V8/logo.png" alt="">
            <br><br>
                <h2 style="color:#bebebe; font-family:Arial;">Su cita es en '.$fecha.' a las '.$horario.'<br>
                    en el laboratorio, para el servicio '.$servicio.'</h2>
                </h2>
                <form class="cancel" action="javascript:void(0)" METHOD="GET">
                <input id="citta" type="hidden" value="<?php echo $id_cita;?>" name="cita">
                <a href="localhost/inovomed" style="padding: 0.6em 0.2em 0.6em 0.2em; 
                margin: 0; background-color:red; color:white; border:none; text-decoration:none; font-size:1.2em;">Cancelar cita</a>
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

        header("Location: ./users/profile.php?mail=$email");
        exit();
    }
}else{
    header("Location: ../index.php?error=1");
    exit();
}