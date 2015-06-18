<div id="page5">

<h3><img src="admin/images/admin_icon.gif" width="19" height="18" alt="" />
<?php echo $lang_main_mailserver; ?></h3>
<p><?php echo $lang_main_mailserverex; ?></p>

<form id="pageform" method="post" action="admin.php">
<fieldset>
<input name="action" type="hidden" id="action" value="page5" />
<input name="change" type="hidden" id="change" value="true" />

<div class="radio-cont">
<span class="lab2"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_selectmethod_help; ?>" />
<?php echo $lang_main_selectmethod; ?></span><br />
<label>
<input class="menulink2" id="stab1" name="mserver" type="radio" value="php" <?php if($mserver=="php") echo 'checked="checked"'; ?> />
PHP mail function </label>

<label>
<input class="menulink2" id="stab2" type="radio" name="mserver" value="sendmail" <?php if($mserver=="sendmail") echo 'checked="checked"'; ?> />
Sendmail </label>

<label>
<input class="menulink2" id="stab3" type="radio" name="mserver" value="smtp" <?php if($mserver=="smtp") echo 'checked="checked"'; ?> />
SMTP</label>
</div>

<div class="clear"></div>

<div>
<fieldset><legend>Sendmail settings</legend><label for="sendmail_string"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_sendmail_help; ?>" />
<?php echo $lang_main_sendmail; ?></label>
<input name="sendmail_string" type="text" class="textbox" id="sendmail_string" value="<?php echo $sendmail_string; ?>" size="40" />
</fieldset></div>


<fieldset><legend>SMTP settings</legend><div>
<label for="smtp_string"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_smtpserver_help; ?>" />
<?php echo $lang_main_smtpserver; ?></label>
<input name="smtp_string" type="text" class="textbox" id="smtp_string" value="<?php echo $smtp_string; ?>" size="40" />
</div>

<div class="radio-cont">
<span class="lab">
<img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_smtpauthentication_help; ?>" />
<?php echo $lang_main_smtpauthentication; ?></span>
<label>
<input name="smtp_auth" type="radio" value="yes" <?php if($smtp_auth=="yes") echo 'checked="checked"'; ?> />
<?php echo $lang_yes; ?></label>
<label>
<input type="radio" name="smtp_auth" value="no"<?php if($smtp_auth=="no") echo 'checked="checked"'; ?> />
<?php echo $lang_no; ?></label>
</div>
<div class="clear"></div>

<div>
<label for="smtp_username"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_smtpuser_help; ?>" />
<?php echo $lang_main_smtpuser; ?></label>
<input name="smtp_username" type="text" class="textbox" id="smtp_username" value="<?php echo $smtp_username; ?>" size="40" />
</div>

<div>
<label for="smtp_password"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_smtppass_help; ?>" />
<?php echo $lang_main_smtppass; ?></label>
<input name="smtp_password" type="password" class="textbox" id="smtp_password" value="<?php echo $smtp_password; ?>" size="40" />
</div></fieldset>

<div class="center">
<input type="submit" value="<?php echo $lang_main_update; ?>" name="update" class="lbut" />
</div>
</fieldset>
</form>
</div>