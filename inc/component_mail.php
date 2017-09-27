<?php
#-- component_mail.php
#-- Модуль готовит форму для отправки письма и выполняет весь функционал
#-- Для использования:
#-- 1. Предварительно стартовать сессию session_start();
#--    в сессии текст сообщения для выдачи после перезагрузки страницы
#-- 2. include('component_mail.php'); 


#include('Mail.php'); 

session_start();

$admin = 'ohatian@gmail.com';

$lng_contacts_mail_error_1 = 'Не заполнено поле "Имя"';
$lng_contacts_mail_error_2 = 'Не заполнено поле "E-mail"';
$lng_contacts_mail_error_3 = 'Не заполнено поле "Тема"';
$lng_contacts_mail_error_4 = 'Не заполнено поле "Сообщение"';
$lng_contacts_mail_error_5 = 'поле "E-mail" должно соответствовать формату somebody@somewhere.ru';
$lng_contacts_mail_title = "Заполнена форма на сайте";
$lng_contacts_mail_author = "АВТОР:";
$lng_contacts_mail_e_mail = "E-MAIL:";
$lng_contacts_mail_theme = "ТЕМА:";
$lng_contacts_mail_message = "СООБЩЕНИЕ:";
$lng_contacts_mail_msg1 = "Письмо успешно отправлено";
$lng_contacts_mail_msg2 = "Ошибка при отправке письма";
$lng_contacts_h2_2 = "Напишите нам:";
$lng_contacts_h2_2_1 = "Имя:";
$lng_contacts_h2_2_2 = "E-mail:";
$lng_contacts_h2_2_3 = "Тема:";
$lng_contacts_h2_2_4 = "Сообщение:";
$lng_contacts_h2_2_button = "Отправить";


if ( isset( $_POST['sendMail'] ) ) {
  $name  = substr( $_POST['name'], 0, 64 );
  $email   = substr( $_POST['email'], 0, 64 );
  $subject = substr( $_POST['subject'], 0, 64 );
  $message = substr( $_POST['message'], 0, 250 );
  
  $error = '';
  if ( empty( $name ) ) $error = $error.'<li>'.$lng_contacts_mail_error_1.'</li>';
  if ( empty( $email ) ) $error = $error.'<li>'.$lng_contacts_mail_error_2.'</li>';
  if ( empty( $subject ) ) $error = $error.'<li>'.$lng_contacts_mail_error_3.'</li>';
  if ( empty( $message ) ) $error = $error.'<li>'.$lng_contacts_mail_error_4.'</li>';
  if ( !empty( $email ) and !preg_match( "#^[0-9a-z_\-\.]+@[0-9a-z\-\.]+\.[a-z]{2,6}$#i", $email ) )
    $error = $error.'<li>'.$lng_contacts_mail_error_5.'</li>';
	
  //-- Если при заполнении формы допущены ошибки, подготовить в сессии текст сообщения для выдачи после перезагрузки страницы,
  //-- и перегрузить страницу
  if ( !empty( $error ) ) {
    $_SESSION['sendMailForm']['error']   = '<p>При заполнении формы были допущены ошибки:</p><ul>'.$error.'</ul>';
    $_SESSION['sendMailForm']['name']    = $name;
    $_SESSION['sendMailForm']['email']   = $email;
    $_SESSION['sendMailForm']['subject'] = $subject;
    $_SESSION['sendMailForm']['message'] = $message;
    header( 'Location: '.$_SERVER['PHP_SELF'] );
    die();
  }
  
  $body = $lng_contacts_mail_author."\r\n".$name."\r\n\r\n";
  $body .= $lng_contacts_mail_e_mail."\r\n".$email."\r\n\r\n";
  $body .= $lng_contacts_mail_theme."\r\n".$subject."\r\n\r\n";
  $body .= $lng_contacts_mail_message."\r\n".$message;
  $body = quoted_printable_encode( $body );

  $theme   = '=?windows-1251?B?'.base64_encode($lng_contacts_mail_title).'?=';
  $headers = "From: ".$_SERVER['SERVER_NAME']." <".$email.">\r\n";
  $headers = $headers."Return-path: <".$email.">\r\n";
  $headers = $headers."Content-type: text/plain; charset=\"windows-1251\"\r\n";
  $headers = $headers."Content-Transfer-Encoding: quoted-printable\r\n\r\n";
  
  if ( mail($admin, $theme, $body, $headers) )
    $_SESSION['success'] = true;
  else
    $_SESSION['success'] = false;
#  header( 'Location: '.$_SERVER['PHP_SELF'] );
#  die();
}
 
function quoted_printable_encode_1 ( $string ) {
   // rule #2, #3 (leaves space and tab characters in tact)
   $string = preg_replace_callback (
   '/[^\x21-\x3C\x3E-\x7E\x09\x20]/',
   'quoted_printable_encode_character',
   $string
   );
   $newline = "=\r\n"; // '=' + CRLF (rule #4)
   // make sure the splitting of lines does not interfere with escaped characters
   // (chunk_split fails here)
   $string = preg_replace ( '/(.{73}[^=]{0,3})/', '$1'.$newline, $string);
   return $string;
}

function quoted_printable_encode_character ( $matches ) {
   $character = $matches[0];
   return sprintf ( '=%02x', ord ( $character ) );
}


if ( isset( $_SESSION['success'] ) ) {
  if ( $_SESSION['success'] )
    $test_msg_status = '<p>'.$lng_contacts_mail_msg1.'</p>';
  else
    $test_msg_status = '<p>'.$lng_contacts_mail_msg2.'</p>';
  unset( $_SESSION['success'] );
}
if ( isset( $_SESSION['sendMailForm'] ) ) {
  $test_msg_status .= $_SESSION['sendMailForm']['error'];
  $name    = htmlspecialchars ( $_SESSION['sendMailForm']['name'] );
  $email   = htmlspecialchars ( $_SESSION['sendMailForm']['email'] );
  $subject = htmlspecialchars ( $_SESSION['sendMailForm']['subject'] );
  $message = htmlspecialchars ( $_SESSION['sendMailForm']['message'] );
  unset( $_SESSION['sendMailForm'] );
} else {
  $name    = '';
  $email   = '';
  $subject = '';
  $message = '';
}

$mail_form = '
        <h4>'.$lng_contacts_h2_2.'</h4>
<br>
'.$test_msg_status.'
<form action="'.$_SERVER['PHP_SELF'].'" method="POST">
		<input type="hidden" name="page" value="contacts">
<table>
<tr><td>'.$lng_contacts_h2_2_1.'</td><td><input type="text" name="name" maxlength="64" value="'.$name.'" /></td></tr>
<tr><td>'.$lng_contacts_h2_2_2.'</td><td><input type="text" name="email" maxlength="64" value="'.$email.'" /></td></tr>
<tr><td>'.$lng_contacts_h2_2_3.'</td><td><input type="text" name="subject" maxlength="64" value="'.$subject.'" /></td></tr>
<tr><td>'.$lng_contacts_h2_2_4.'</td><td><textarea name="message" rows="5" cols="23">'.$message.'</textarea></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name="sendMail" value="'.$lng_contacts_h2_2_button.'" /></td></tr>
</table>
</form>
';

#echo $mail_form;


?>