<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host="localhost";
$dbid="root";
$dbpass = "";
$dbname="skripsi_andre";

$SMTPSecure = 'ssl';
$Host = 'smtp.gmail.com';
$Port = '465';
$mailUsername = 'atest7139@gmail.com';
$mailPassword = 'password1234P';
$SetFrom = 'alitatest@gmail.com';

$con = new mysqli($host, $dbid, $dbpass, $dbname);

$stmt = $con->prepare( "SELECT ID_TRANSAKSI,TGL_KEMBALI FROM tbl_sewa");
$stmt->execute(); 
$result = $stmt->get_result();
$con -> close();
while($row = mysqli_fetch_assoc($result)) {
	
}

$datenow = date('Y-m-d');
$stmt = $con->prepare( "SELECT ID_TRANSAKSI,TGL_KEMBALI FROM tbl_sewa");
$stmt->execute(); 
$result = $stmt->get_result();
$con -> close();
while($row = mysqli_fetch_assoc($result)) {
	if($datenow == $row["TGL_KEMBALI"]){
	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = $SMTPSecure;
	$mail->Host = $Host;
	$mail->Port = $Port;
	$mail->isHTML();
	$mail->Username = $mailUsername;
	$mail->Password = $mailPassword;
	$mail->SetFrom($SetFrom);
	$mail->Subject = 'Mohon dikembalikan buku : '.$row["ID_TRANSAKSI"];
	$mail->Body = "Dear pelanggan, <br><br> Mohon dikembalikan buku yang dipinjam karena sudah jatuh tempo. Terima kasih. <br><br> Regards, <br> Admin Perpustakaan";
	//$mail->addAttachment($file_pointer);
	$mail->AddAddress("atest7139@gmail.com");
	$mail->Send();
	}
}
?>