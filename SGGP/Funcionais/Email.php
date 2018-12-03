<?php

    require_once("../Uteis/phpmailer/class.phpmailer.php");

    define('GUSER', 'sggp.recovery@gmail.com');	// <-- Insira aqui o seu GMail
    define('GPWD', 'sggp123456');		// <-- Insira aqui a senha do seu GMail

    function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
        global $error;
        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->IsSMTP();		// Ativar SMTP
        $mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
        $mail->SMTPAuth = true;		// Autenticação ativada
        $mail->SMTPSecure = 'tls';	// SSL REQUERIDO pelo GMail
        $mail->Host = 'smtp.gmail.com';	// SMTP utilizado
        $mail->Port = 587;  		// A porta 587 deverá estar aberta em seu servidor
        $mail->Username = GUSER;
        $mail->Password = GPWD;
        $mail->SetFrom($de, $de_nome);
        $mail->Subject = $assunto;
        $mail->Body = $corpo;
        $mail->AddAddress($para);
        if(!$mail->Send()) {
            $error = 'Mail error: '.$mail->ErrorInfo; 
            return false;
        } else {
            $error = 'Um e-mail foi enviado para: '.$para;
            return true;
            
        }
    }

    function enviarEmail($email, $mensagem){

         if (smtpmailer($email , 'sggp.recovery@gmail.com', 'SGGP', 'SGGP Info', $mensagem)) {


        }
        
    }

?>