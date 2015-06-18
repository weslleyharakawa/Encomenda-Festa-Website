<?php if(!isset($_SESSION['admin'])){echo 'Hacking attempted'; return ;} ?>

<?php
if( isset($change) )
{

if($_POST[action]=='main'){
	$fp=fopen("global1.php","w");
		$out=sprintf("<?php \r\n");
		fwrite($fp,$out,strlen($out));
	$out=sprintf("\$main_dir = \"%s\";\r\n",$nmain_dir);
		fwrite($fp,$out,strlen($out));
	$out=sprintf("\$website = \"%s\";\r\n",$nwebsite);
		fwrite($fp,$out,strlen($out));
	$out=sprintf("\$relative_string=\"%s\";\r\n",$nrelative_string);
		fwrite($fp,$out,strlen($out));
	$out=sprintf("\$popup=\"%s\";\r\n",$npopup);
		fwrite($fp,$out,strlen($out));
	$out=sprintf("\$database_file=\"%s\";\r\n",$ndatabase_file);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$lang=\"%s\";\r\n",$nlang);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("?>");
			fwrite($fp,$out,strlen($out));
			fclose($fp);

}elseif($_POST[action]=='page2'){
	$fp=fopen("global2.php","w");
		$out=sprintf("<?php \r\n");
		fwrite($fp,$out,strlen($out));
	$out=sprintf("\$mysql=\"%s\";\r\n",$nmysql);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$dbhostname=\"%s\";\r\n",$ndbhostname);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$dbusername=\"%s\";\r\n",$ndbusername);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$dbpassword=\"%s\";\r\n",$ndbpassword);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$dbname=\"%s\";\r\n",$ndbname);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("?>");
			fwrite($fp,$out,strlen($out));
		fclose($fp);
}elseif($_POST[action]=='page3'){	
	$fp=fopen("global3.php","w");
	$out=sprintf("<?php \r\n");
		fwrite($fp,$out,strlen($out));		
	$out=sprintf("\$email_name=\"%s\";\r\n",$nemail_name);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$email_email=\"%s\";\r\n",$nemail_email);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$email_thank_title=\"%s\";\r\n",$nemail_thank_title);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$email_thank_message=stripslashes(\"%s\");\r\n",addslashes($nemail_thank_message));
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$email_unsubscribe_message=stripslashes(\"%s\");\r\n",addslashes($nemail_unsubscribe_message));
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$email_verify_message=stripslashes(\"%s\");\r\n",addslashes($nemail_verify_message));
			fwrite($fp,$out,strlen($out));
//                $out=sprintf("\$email_html=\"%s\";\r\n",$nemail_html);
//				fwrite($fp,$out,strlen($out));
	$out=sprintf("\$email_unsubscribe=\"%s\";\r\n",$nemail_unsubscribe);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$email_thank=\"%s\";\r\n",$nemail_thank);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$email_verify=\"%s\";\r\n",$nemail_verify);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("?>");
			fwrite($fp,$out,strlen($out));
			fclose($fp);
}elseif($_POST[action]=='page4'){
	$fp=fopen("global4.php","w");
		$out=sprintf("<?php \r\n");
		fwrite($fp,$out,strlen($out));
	$out=sprintf("\$user=\"%s\";\r\n",$nusername);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$pass=\"%s\";\r\n",$npassword);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("?>");
			fwrite($fp,$out,strlen($out));
			fclose($fp);
}elseif($_POST[action]=='page5'){
	
	$fp=fopen("global5.php","w");
	$out=sprintf("<?php \r\n");
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$mserver=\"%s\";\r\n",$mserver);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$sendmail_string=\"%s\";\r\n",$sendmail_string);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$smtp_string=\"%s\";\r\n",$smtp_string);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$smtp_auth=\"%s\";\r\n",$smtp_auth);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$smtp_username=\"%s\";\r\n",$smtp_username);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("\$smtp_password=\"%s\";\r\n",$smtp_password);
			fwrite($fp,$out,strlen($out));
	$out=sprintf("?>");
			fwrite($fp,$out,strlen($out));
			fclose($fp);
}
require("globals.php");

echo '<div><?php echo $lang_main_updated; ?></div>';
}
if($_GET['action']!='page3'){
?>

<div><h2><img src="admin/images/main.gif" width="19" height="20" alt="" />
<?php echo $lang_main_settings; ?></h2>
<p><?php echo $lang_main_global; ?></p>
</div>


<ul id="sec-nav">

<li><a href="<?php echo $_SERVER['PHP_SELF']."?action=diag";?>" class="menulink2">
<img src="admin/images/diag_icon.gif" width="16" height="16" alt="" /><?php echo $lang_main_diagnostics; ?></a></li>

<li><a href="<?php echo $_SERVER['PHP_SELF']."?action=page1";?>" class="menulink2">
<img src="admin/images/program_icon.gif" width="16" height="16" alt="" /><?php echo $lang_main_script; ?></a></li>

<li><a href="<?php echo $_SERVER['PHP_SELF']."?action=page2";?>" class="menulink2">
<img src="admin/images/database_icon.gif" width="16" height="16" alt="" /><?php echo $lang_main_database; ?></a></li>

<li><a href="<?php echo $_SERVER['PHP_SELF']."?action=page4";?>" class="menulink2">
<img src="admin/images/admin_icon.gif" width="19" height="18" alt="" /><?php echo $lang_main_security; ?></a></li>

<li><a href="<?php echo $_SERVER['PHP_SELF']."?action=page5";?>" class="menulink2">
<img src="admin/images/diag_icon.gif" width="16" height="16" alt="" /><?php echo $lang_main_server; ?></a></li>

</ul>
<div class="clear"></div>
<?php
}
?>