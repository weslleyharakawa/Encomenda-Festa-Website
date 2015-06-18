<?php if(!isset($_SESSION['admin'])){echo 'Hacking attempted'; return ;} ?>
<?php
//error_reporting(0);
$attach="";
$attachmime="";
if(isset($sendemail))
{
$attachfile = $_FILES['attachfile']['tmp_name'];
$attachmime = $_FILES['attachfile']['type'];
$attachfile_name = $_FILES['attachfile']['name'];
if(isset($attachfile))
{
//echo $attachfile;
if($attachfile && $attachfile!="none")
{
$attach="temp/".$attachfile_name;
if(copy($attachfile,$attach))
{
//echo '<br>The file '.$attach.' was success fully added as an attachment';
}
//else echo '<br>There was an error attaching the file '.$attach;
}
}
$fp=fopen("temp/email.php","w");
$out=sprintf('<?php $subject=\'%s\';%s',addslashes($subject),"\r\n");
fwrite($fp,$out,strlen($out));
$out=sprintf('$messagetext=\'%s\';%s',addslashes($messagetext),"\r\n");
fwrite($fp,$out,strlen($out));
$out=sprintf('$messagehtml=\'%s\';%s',addslashes($messagehtml),"\r\n");
fwrite($fp,$out,strlen($out));
if(isset($template)){$temp_use=$template_name;}
else $temp_use='';
$out=sprintf('$template=\'%s\';%s',$temp_use,"\r\n");
fwrite($fp,$out,strlen($out));
$out=sprintf('$attach=\'%s\';%s',$attach,"\r\n");
fwrite($fp,$out,strlen($out));
$out=sprintf('$attachtype=\'%s\'; ?>',$attachmime);
fwrite($fp,$out,strlen($out));
fclose($fp); /* */
} ?>

<div id="sendthemail">
<h2><img src="admin/images/sendmail.gif" width="20" height="20" alt="" />
<?php echo $lang_sendmail_send; ?></h2>
<p><?php echo $lang_sendmail_sendex; ?></p>
<p><?php echo $lang_sendmail_sendselect; ?></p>
<?php 
if(isset($sendemail))include('send.php'); 
?>
<?php 
$total_entries=$base_file->entries();
echo "<p class=\"send-subscribers\">Total number of subscribers: ".$total_entries."</p>"; 
?>
<form enctype="multipart/form-data" id="form" method="post" action="admin.php?action=sendmail">
<fieldset>
<div>
<strong><?php echo $lang_sendmail_from; ?></strong> : 
<?php echo $email_name; ?>&nbsp;&lt;<?php echo $email_email;?>&gt;
</div>


<label for="subject"><?php echo $lang_sendmail_subject; ?></label>
<input name="subject" type="text" class="textbox" id="subject" value="<?php if(isset($subject))echo $subject; ?>" size="90" />
<label for="messagetext"><?php echo $lang_sendmail_textversion; ?></label>
<textarea name="messagetext" cols="100" rows="15" class="textbox" id="messagetext" ><?php if(isset($messagetext))echo $messagetext; ?></textarea>
<input name="MAX_FILE_SIZE" type="hidden" id="MAX_FILE_SIZE" value="1000000" /><br />
<label for="attachfile"><?php echo $lang_sendmail_attachment; ?> : </label>
<input name="attachfile" type="file" class="textbox" id="attachfile" size="60" />
<input name="sendemail" type="hidden" id="sendemail" value="true" />
<label for="archive-it"><?php echo $lang_sendmail_archive; ?></label>
<input name="archive-it" type="checkbox" class="checkbox" id="archive-it" checked="checked" />

<div class="center">
<input type="submit" value="<?php echo $lang_sendmail_sendbutton; ?>" name="update" class="lbut" />
</div>
</fieldset>
</form>
</div>