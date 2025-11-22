<?php
// menerima data (batasan list yang harus di tampilkan)
$json = file_get_contents('php://input');
$data = json_decode($json,1);

//validasi data dan larangan kutip 
$err = false;
$msg = '';
foreach ($data as $k => $v) {
    // Cek kosong
    if (!isset($v) || trim($v) === '') {
        $err = true;
        $msg .= "$k wajib diisi\n";
    }

    // larang kutip
    if (strpos($v, '"') !== false || strpos($v, "'") !== false) {
        $err = true;
        $msg .= "$k tidak boleh mengandung tanda kutip\n";
    }
}
if ($err) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => $msg
    ]);
    exit;
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

// ambil id user setelah di simpan 
$id = mysqli_insert_id($con);
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
require_once './PHPMailer-master/src/PHPMailer.php';
require_once './PHPMailer-master/src/SMTP.php';
require_once './PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader (created by composer, not included with PHPMailer)

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings 
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-relay.brevo.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '9c110e001@smtp-brevo.com';                     //SMTP username
    $mail->Password   =  'S1hPvK79fFyJXcgM';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients (pengirim dan penerima)
    $mail->setFrom('fadilaziz275@gmail.com', 'ikan keke');
    $mail->addAddress('utsman1231436@gmail.com', $nama_lengkap);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
        $link_aktivasi = "http://localhost/Belajar_kelas/Mas_usman/Nightingale/api/users/terverivikasi/terverivikasi.html?id=$id";
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = "
    <p>halo,$nama_lengkap</p>
    <p>Silahkan klik link ini untuk mengaktifkan akun ada : <a href='$link_aktivasi'> klik disini</a> </p>
    ";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


// respon balik ke client
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