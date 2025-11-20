<?php
// menerima data (batasan list yang harus di tampilkan)
$json = file_get_contents('php://input');
$data = json_decode($json,1);

//validasi data
$err = true;
$msg = ''; 
foreach ($data as $k=>$v){
    if (strpos($v, '"')==true or strpos($v, "'")==true or strpos($v, '-')==true ){
        $err=false;
        $msg.= "$k wajib di isi";
    }

    if (!isset ($v) or $v==)
}

// data DB
require_once __DIR__ . '/../../config/db.php';

// sytax sql  
$nama_lengkap = $data['nama_lengkap'];
$username = $data ['username'];
$pass = $data['pass'];
$no_wa = $data['no_wa'];
$email = $data['email'];
$status = 'suspend';
$user_role = 'perawat' ;


$sql = "
insert into users (nama_lengkap, username, user_role, pass, no_wa, email,status_akun)
values 
( '$nama_lengkap','$username', '$user_role' , '$pass' , '$no_wa', '$email' , '$status' )
";

$query = mysqli_query($con,$sql);


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



if ($query){
    $response['status']='sucsess';
    $response['data']= $data;
    http_response_code(200);

}else{
    $response ['status']='gagal';
    $response['message']='data gagal di simpan';
    http_response_code(500);
    
}

echo json_encode($response);
mysqli_close($con);