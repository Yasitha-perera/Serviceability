<?php include 'header1.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Send mail from PHP using SMTP</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>

footer 
{
            background:rgb(193, 7, 7);
            color: white;
            text-align: center;
            position: fixed;
            left: 0;
            bottom: -15px;
            width: 100%;
        }body{
          background-color:rgba(13, 42, 158, 0.2); 
        }   .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn-primary {
            background-color:rgba(193, 7, 7, 0.7); 
            color: #fff;
        }
        .btn-primary:hover {
            background-color:rgba(193, 7, 7, 0.5); 
        }.container {
        border: 1px;
    }
</style>
</head>
<body>
<div class="container">
<?php
require '..\scripts\phpmailer\PHPMailerAutoload.php';
    
if(isset($_POST['sendmail'])) {      
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
    $mail->addAddress($_POST['email']);   
    $mail->SetFrom("webadmin@airport.lk", "webadmin");
    $mail->CharSet  = 'UTF-8';
    $mail->Subject =$_POST['subject'];
    $mail->Body =$_POST['message'];
    
    
     if (!empty($_FILES['file']['name'][0])) {
        foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['file']['name'][$key];
            $file_tmp = $_FILES['file']['tmp_name'][$key];
            $mail->addAttachment($file_tmp, $file_name);
        } 
    }
    

    try{
        $mail->Send();
echo "<script type='text/javascript'>
            alert('Email Sent Successfully..');
            window.location.href ='email.php';
            </script>";   
    } catch(Exception $e){
            echo $e;
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="email">To Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter recipient's email" maxlength="50" required>
          </div>

          <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" class="form-control" id="subject" name="subject" value="Serviceability Report " maxlength="50" required>
          </div>
          
          <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" name="message" placeholder="Enter your message" maxlength="6000" rows="4" required></textarea>
          </div>

          <div class="form-group">
            <label for="file">File:</label>
            <input name="file[]" multiple class="form-control-file" type="file" id="file">
          </div>

          <button type="submit" name="sendmail" class="btn btn-primary btn-block">Send</button>
        </form>
      </div>
    </div>
  </div>
  <footer>
        <p>&copy; Designed And Developed By AASL IT</p>
    </footer>

</body>
</html>
