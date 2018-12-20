<!DOCTYPE html>
<html>
<head>
    <title>
        Mail App
    </title>
</head>
<body>
<form action="" method="POST">
    Email Id: <input type="email" required name="semail" /><br><br>
    Password: <input type="password" required name="spass" /><br><br>
    Recipients email: <input type="email" required name="remail" /><br><br>
    Subject: <textarea required name="subject"></textarea><br><br>
    Body: <textarea required name="body"></textarea><br><br>
    <input type="submit" value="Send Mail" name="submit">
</form>
<?php
if(isset($_POST['submit']) && $_POST['submit']!="")
{
    print_r($_POST);
    extract($_POST);
    $mail = new PHPMailer();

    // ---------- adjust these lines ---------------------------------------
    $mail->Username = $semail; // your GMail user name
    $mail->Password = $spass;
    $mail->SetFrom($mail->Username);
    $mail->AddAddress($remail); // recipients email
    $mail->FromName = "Hospiasset"; // readable name

    $mail->Subject = $subject;
    $mail->Body    = $body;
    //-----------------------------------------------------------------------

    $mail->Host = "smtp.gmail.com"; // GMail
    $mail->Port = 465;
    $mail->IsHTML(true);
    $mail->IsSMTP(); // use SMTP
    //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->From = $mail->Username;
    if(!$mail->Send())
        echo "Mailer Error: " . $mail->ErrorInfo;
    else
        echo "Message has been sent";
}
?>
<body>
</html>