<?php if(!isset($_SESSION['admin'])){echo 'Hacking attempted'; return ;} 
$sendatatime=50;
if($_GET['email_from']>=$sendatatime){
	include("admin/head.php");
}
// the settings are stored here //
require("admin/class/phpmailer/class.phpmailer.php");
include("temp/email.php");

$subject=stripslashes($subject);
$messagetext=stripslashes($messagetext);
$messagehtml=stripslashes($messagehtml);


if(!isset($email_from))$email_from=0;

$mail = new phpmailer();

$mail->Subject  = $subject;
$mail->From     = $email_email;
$mail->FromName = $email_name;
$mail->ContentType = "text/plain";
switch($mserver)
{
case "smtp" :
			$mail->Host=$smtp_string;
			//echo $mail->Host;
			$mail->SMTPDebug=false;
			if($smtp_auth=="yes")
			{
			$mail->SMTPAuth=true;
			$mail->Username=$smtp_username;
			$mail->Password=$smtp_password;
			}
			$mail->Mailer="smtp";
             break;
case "sendmail"  :
			$mail->Sendmail=$sendmail_string;
			$mail->Mailer="sendmail";
            break;
case "php":
default :
			$mail->Mailer="mail";
			break;

}
if(is_file($attach)) {$mail->AddAttachment($attach); }
$unsub_html="";
$unsub_text="";
if($email_unsubscribe=="yes")
	{
	$unsub_html=str_replace("{ulink}",'.$website.$relative_string."subscribe=false&email={email}"',$email_unsubscribe_message);
	//$unsub_html=str_replace("{/ulink}","</a>",$unsub_html);
	$unsub_text="\n\n".'Please follow this link to Unsubscribe : '.$website.$relative_string.'subscribe=false&email={email}';
	}
/////////////////////////////////////////////////////////////////////
//						 Fill in the content
/////////////////////////////////////////////////////////////////////
if(strlen($messagetext)>0)
{
if(strlen($messagehtml) == 0 ) $mail->Body = $messagetext.$unsub_text;
 else $mail->AltBody = $messagetext.$unsub_text;
}

$mail_type="";
$tmail = new phpmailer();
//$sendatatime was 50
for($i=$email_from;$i<$email_from+$sendatatime;$i++)
{
$tmail=$mail;
if($i==$total_entries){$send_all="true"; break;}

$tmail->Body=str_replace("{email}",$category_list[$i]["email"],$tmail->Body);
$tmail->AltBody=str_replace("{email}",$category_list[$i]["email"],$tmail->AltBody);

$tmail->AddAddress($category_list[$i]["email"]);
// send the email //////////////////////////////////
if(!$tmail->Send())echo "Error sending to : ".$category_list[$i]["email"];
// me testing echo "<pre>".print_r($tmail)."</pre>";
$tmail->ClearAddresses();
}
//$sendatatime was 50
$email_from+=$sendatatime;
// create archive
if(isset($_POST['archive-it'])){
//if(isset($send_all)) {
	createArchive($subject,$messagetext,$attach);
}
// delete the temporary file
if(isset($send_all) && is_file($attach) ) unlink($attach);

?>
<div class="sending">
<img src="admin/images/email_icon.gif" width="16" height="16" alt="" />
<?php 
echo $lang_send_mails; 
echo $lang_send_sending; 
// test send more than 50
if(!isset($send_all)){
	echo "<p>Send next batch <a href=\"admin.php?action=send&amp;email_from=".$email_from."\">now</a>";
}
if(!isset($send_all))
{
echo $lang_send_close;
}
if(isset($send_all))
{
echo $lang_send_done;
echo "<p><a href=\"".$_SERVER['PHP_SELF']."\">Return to the newsletter page</a></p>";
}
?>
</div>
<?php
if($_GET['email_from']>=$sendatatime){
	include("admin/tail.php");
}
?>