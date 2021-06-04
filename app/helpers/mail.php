<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;   
function sendMail($data){
    
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

            //Import PHPMailer classes into the global namespace
            

            require APPROOT.'/vendor/autoload.php';

            //Create a new PHPMailer instance
            $mail = new PHPMailer();

            //Tell PHPMailer to use SMTP
            $mail->isSMTP();

            //Enable SMTP debugging
            //SMTP::DEBUG_OFF = off (for production use)
            //SMTP::DEBUG_CLIENT = client messages
            //SMTP::DEBUG_SERVER = client and server messages
            $mail->SMTPDebug = SMTP::DEBUG_OFF;

            //Set the hostname of the mail server
            $mail->Host = 'smtp.gmail.com';
            //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
            //if your network does not support SMTP over IPv6,
            //though this may cause issues with TLS

            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = 465;

            //Set the encryption mechanism to use - STARTTLS or SMTPS
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;

            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = 'username@gmail.com';

            //Password to use for SMTP authentication
            $mail->Password = 'password';

            //Set who the message is to be sent from
            $mail->setFrom('senderemail', 'Dream Rent');


            //Set who the message is to be sent to
            $mail->addAddress($data['user_email']);

            //Set the subject line
            $mail->Subject = 'Reservation confirmation';

            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $mail->isHTML(true); 
            $mail->Body    = "Dear ".$data['user_firstName']."<br>Your reservation for the vehicle Number ".$data['vehicleId']." between ".$data['dateOut']." and ".$data['dateReturned']." is confirmed." ;

            // //Replace the plain text body with one created manually
            $mail->AltBody = "we confirm your reservation for the".$data['description'];
            
            //send the message, check for errors
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo " <br> Have a great day!";
                //Section 2: IMAP
                //Uncomment these to save your message in the 'Sent Mail' folder.
                #if (save_mail($mail)) {
                #    echo "Message saved!";
                #}
            }

}