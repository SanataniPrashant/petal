<?php

$server="localhost";
$username="root";
$password="";
$dbname="flower";
$conn=mysqli_connect($server, $username,$password,$dbname,3306);

if(!$conn){
    echo"not Connected";
}
else{
    echo"connected";    
}
$name=$_POST['name'];
// $surname=$_POST['surname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$message=$_POST['message'];


$sql="INSERT INTO `form1`(`name`, `email`, `number`, `message`) VALUES ('$name','$email','$phone','$message')";
$result=mysqli_query($conn,$sql);


if($result){
    echo"\nData Submitted Succesfully";
}
else{
    echo"Something! went wrong,query error";
}
$conn->close();
?>


<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';

require 'vendor/autoload.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF; // Enable verbose debug output (set to DEBUG_OFF for production)
    $mail->isSMTP();                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify SMTP server
    $mail->SMTPAuth = true;               // Enable SMTP authentication
    $mail->Username = 'purwarroshan@gmail.com';    // SMTP username
    $mail->Password = 'naipzpcazjvgojsg';    // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port = 465;                 // TCP port to connect to


    //Recipients
    $mail->setFrom($_POST["email"], $_POST["name"]);
    $mail->addAddress('purwarroshan@gmail.com');     // Add a recipient


    // Content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = $_POST["subject"];
    $mail->Body = $_POST["message"];
    $mail->send();


    //Recipients
    $mail->setFrom('purwarroshan@gmail.com');
    $mail->addAddress($_POST["email"], $_POST["name"]);     // Add a recipient


    // Content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Confirmation Mail';
    $mail->Body = '<h1 style="color:red" >Thank You </h1>for your Details. <br> Your Mail is Succesfully Received';
    $mail->send();
    echo
        "
    <script> 
    
    alert('Mail Sent Successfully'); 
    document.location.href = 'index.html';

    </script> ";

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>