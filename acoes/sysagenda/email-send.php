<?
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
 error_reporting( error_reporting() & ~E_NOTICE );

/**
 * This example shows sending a message using a local sendmail binary.
 */
//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
require("".$_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");

//Create a new PHPMailer instance
$mail = new PHPMailer;
// Set PHPMailer to use the sendmail transport
$mail->isSendmail();

//Set who the message is to be sent from
$mail->setFrom('server@bpadvocacia.com.br', 'BP Advocacia');
//Set an alternative reply-to address
$mail->addReplyTo('server@bpadvocacia.com.br', 'BP Advocacia');
//Set who the message is to be sent to
#$mail->addAddress('alexsander.lauffer@gmail.com', 'TAGX');     // Add a recipient
$mail->addAddress('rm81f5xskg+8f5bd+o7iav@in.meistertask.com', 'TAGX');     // Add a recipient

#$mail->addAddress('atendimento@tagx.com.br', 'TAGX');     // Add a recipient
#$mail->addAddress('eduardo@tagx.com.br', 'Eduardo');     // Add a recipient
//Set the subject line
$mail->Subject = 'TESTE TAGX';
$mail->Body    = 'Corpo do email <b>pode colocar qualquer HTML</b>';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
#$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
//Replace the plain text body with one created manually

#$mail->AltBody = 'This is a plain-text message body';
//Attach an image file

$mail->addAttachment(''.$_SERVER['DOCUMENT_ROOT'].'/admin/files/sysagenda/Tabela-Agencias.pdf');         // Add attachments
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>