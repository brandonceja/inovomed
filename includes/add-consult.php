<?php

/*Database connection */
include "dbh.php";

session_start();

if(isset($_SESSION['u_id']))
{
    if(isset($_GET['submit'])){

        $paciente       = $_SESSION["u_id"];
        $medico         = mysqli_real_escape_string($conn,$_GET["cedula"]);
        $especialidad   = mysqli_real_escape_string($conn,$_GET["especialidad"]);
        $hora        = mysqli_real_escape_string($conn,$_GET["horario"]);
        $consultorio    =  mysqli_real_escape_string($conn,$_GET["consultorio"]);
        $fecha          = mysqli_real_escape_string($conn,$_GET["fecha"]);

        $hora = $hora.":00:00";

        if (!empty($medico) && !empty($fecha) && !empty($hora) && !empty($consultorio) && !empty($paciente)) {
	
            /*Check regex*/
    
                if (is_numeric($medico) && is_numeric($consultorio) && is_numeric($paciente)) {
                    
                    /* Check if patient has already a scheduled consult */
                    $sql = "SELECT * FROM citas WHERE paciente = '$paciente'";
                    $query = mysqli_query($conn, $sql);
    
                    if(mysqli_num_rows($query) == 0){
    
                        /*Check if doctor is busy*/
                        $sql = "SELECT * FROM citas WHERE medico = '$medico' AND horario = '$hora' AND fecha = '$fecha';";
                        $query = mysqli_query($conn, $sql);
    
                        if(mysqli_num_rows($query) == 0){  
    
                            /*Check if consult room is busy*/
                            $sql = "SELECT * FROM citas WHERE consultorio = '$consultorio' AND horario = '$hora' AND fecha = '$fecha';";
                            $query = mysqli_query($conn, $sql);
    
                            if(mysqli_num_rows($query) == 0){
    
                                 /*Check if specialties match*/
                                $sql = "SELECT * FROM medicos INNER JOIN consultorios ON medicos.especialidad = consultorios.especialidad
                                            WHERE medicos.cedula = '$medico' AND consultorios.id_consultorio='$consultorio';";
                                $query = mysqli_query($conn, $sql);
    
                                if(mysqli_num_rows($query) > 0){
                                    /*Insert into database*/
                                    $sql = "INSERT INTO citas (id, medico, paciente, consultorio, horario, fecha) 
                                    VALUES ('', '$medico', '$paciente', '$consultorio', '$hora', '$fecha')";
                                    $query = mysqli_query($conn, $sql);
    
                                }else{
                                    header("location: ../consultas2.php?error=doctor-and-consultorio-dont-match&cedula=".$cedula."&especialidad=".$especialidad);
                                    exit();
                                }  
                            }else{
                                header("location: ../consultas2.php?error=consultorio-busy&cedula=".$cedula."&especialidad=".$especialidad);
                                exit();
                            }  
                        }else{
                            header("location: ../consultas2.php?error=doctor-busy&cedula=".$cedula."&especialidad=".$especialidad);
                            exit();
                        }	
                    }else{
                        header("location: ../consultas2.php?error=patient-already-scheduled&cedula=".$cedula."&especialidad=".$especialidad);
                        exit();
                    }	
                }else{
                    header("location: ../consultas2.php?error=invalid-char&cedula=".$cedula."&especialidad=".$especialidad);
                    exit();
                }
        }else{
            header("location: ../consultas2.php?error=empty&cedula=".$cedula."&especialidad=".$especialidad);
            exit();
        }

        $last_id = mysqli_insert_id($conn);


        $sql = "SELECT nombres, apellidoP, apellidoM, edificio, piso, email FROM citas INNER JOIN medicos ON medicos.cedula = citas.medico INNER JOIN
                consultorios ON citas.consultorio=consultorios.id_consultorio WHERE citas.id = '$last_id';";
        $query =  mysqli_query($conn, $sql);

        while ($row =  mysqli_fetch_array($query)){
            $nombre = $row[0];
            $apellidoP = $row[1];
            $apellidoM = $row[2];
            $edificio = $row[3];
            $piso = $row[4];
            $emailDoc = $row[5];
        }

        $sql = "SELECT nombre, apellidoP, apellidoM, email FROM users INNER JOIN citas ON users.id = citas.paciente 
                WHERE citas.id = '$last_id';";
        $query =  mysqli_query($conn, $sql);

        while ($row =  mysqli_fetch_array($query)){
            $nombreUser = $row[0];
            $apellidoPUser = $row[1];
            $apellidoMUser = $row[2];
            $email = $row[3];
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
                <h2 style="color:#bebebe; font-family:Arial;">Su cita es en '.$fecha.' a las '.$hora.'. <br>
                    en el consultorio '.$consultorio.', edificio '.$edificio.', piso '.$piso.' <br>
                    con Dr. '.$nombre.' '.$apellidoP.' '.$apellidoM.'
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
        $mail->addAddress($emailDoc, $nombre.' '.$apellidoP.' '.$apellidoM);     // Add a recipient
        $mail->addReplyTo(EMAIL);

        $mail->isHTML(true);                                  // Set email format to HTML


        $content = '<div style="background-color:#ededed; padding: 2em 2em; ">
        <div style="background-color:white; text-align:center; width: 80%; margin-left:10%; padding-top: 3em;">
            <img src="https://i.ibb.co/SB9L5V8/logo.png" alt="">
            <br><br>
                <h2 style="color:#bebebe; font-family:Arial;">Su cita es en '.$fecha.' a las '.$hora.'. <br>
                    en el consultorio '.$consultorio.', edificio '.$edificio.', piso '.$piso.' <br>
                    con el paciente '.$nombreUser.' '.$apellidoPUser.' '.$apellidoMUser.'
                </h2>		
                <form class="cancel" action="javascript:void(0)" METHOD="GET">
                <input id="citta" type="hidden" value="<?php echo $id_cita;?>" name="cita">
                <a href="localhost/inovomed" style="padding: 0.6em 0.2em 0.6em 0.2em; 
                margin: 0; background-color:red; color:white; border:none; text-decoration:none; font-size:1.2em;">Cancelar cita</a>
                <br><br>
            </form>
        </div>
        </div>';

        $mail->Subject = 'Su paciente de Inovomed';
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