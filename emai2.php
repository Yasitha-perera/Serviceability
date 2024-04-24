<?php
require '..\scripts\phpmailer\PHPMailerAutoload.php';
$_POST['email'] = 'erandi.it@airport.lk';
if (isset($_POST['email']))
{
    $Subject = "Regarding the complaint you made";
    $email = 'erandi.it@airport.lk';
    $name = 'erandi';
    $feedback = 'test';
    $mail = new PHPMailer(true);

    // Send mail using Gmail
    //if($send_using_gmail){
        $mail->IsSMTP(); // telling the class to use SMTP

//ADD BELOW LINES FROM HERE
    $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);



        $mail->SMTPAuth = true; // enable SMTP authentication
      //  $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
        $mail->Host = "mail.airport.lk"; // sets GMAIL as the SMTP server
        $mail->Port = 587; // set the SMTP port for the GMAIL server
        $mail->Username = "webadmin@airport.lk"; // GMAIL username
        $mail->Password = "ant@aasl"; // GMAIL password
    //}

    // Typical mail data
    $mail->AddAddress($email,$name);
    $mail->SetFrom("webadmin@airport.lk", "webadmin");
    $mail->CharSet  = 'UTF-8';
    $mail->Subject =$Subject;
    $mail->Body ="Dear {$name}, \n \n Your complaint has been rectified. \n Thank you for contacting us.\n {$feedback}
    \n \n Airport & Aviation Services (Sri Lanka) Ltd. \n Bandaranaike International Airport, \n Katunayake, \n Sri Lanka. \n Tel: 94 11 2252861  \n Fax: 94 11 225 9435";

    try{
        $mail->Send();
          echo "Sucess";
   
    } catch(Exception $e){
            echo $e;
    }
     
 }

?>