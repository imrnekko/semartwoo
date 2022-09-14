<?php
include("phpmailer/class.phpmailer.php"); // compulsory file to be included
include("phpmailer/email_config.php"); // gmail configuration

session_start();
include("../connection/db_connection.php");

if(isset($_POST['submit'])){



$email = $_POST['email'];

$sqlCheckEmail = "SELECT * FROM admin where email = '".$email."'";
$qryCheckEmail = mysqli_query($con, $sqlCheckEmail);

$row = mysqli_num_rows($qryCheckEmail);

if($row > 0 ){

$r = mysqli_fetch_assoc($qryCheckEmail);



$mail             = new PHPMailer();
$mail->IsSMTP();                 // telling the class to use SMTP
$mail->SMTPDebug  = SMTP_DEBUG;  // enables SMTP debug information (for testing)
								 // 1 = errors and messages
								 // 2 = messages only
$mail->SMTPAuth   = SMTP_AUTH;   // enable SMTP authentication
$mail->SMTPSecure = SMTP_SECURE; // sets the prefix to the servier
$mail->Host       = HOST;        // sets GMAIL as the SMTP server
$mail->Port       = PORT;        // set the SMTP port for the GMAIL server
$mail->Username   = 'hello@gmail.com';    // GMAIL username
$mail->Password   = 'password';    // GMAIL password

$mail->SetFrom('hello@gmail.com', 'SemartWoo');
$mail->addAddress($r['email'], $r['fullname']);
$mail->Subject = 'SemartWoo - Reset Password';
$body = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">';
$body .= '<h5>Hello!</h5><br>';
$body .= '<p>You are receiving this email because we received a password reset request for your account.</p>';
$body .= '<center><a href="https://ujcos.online/views/guest/reset-password.php" class="button">Reset Password</a></center>';
$body .= '<p>If you did not request a password reset, no further action is required.</p>';
$mail->MsgHTML($body);
/*foreach(committeeEmails() as $email => $name) // send to multiple receivers
{
	$mail->AddAddress($email, $name);
}*/
$mail->Send();

$qstring = '?status=succ';

header("Location: ../views/guest/forgot-password.php".$qstring);

}else{

$qstring = '?status=err';

header("Location: ../views/guest/forgot-password.php".$qstring);
}

}

?>
