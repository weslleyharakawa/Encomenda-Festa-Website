<div id="page3">
<h2><img src="admin/images/email_icon.gif" width="16" height="16" alt="" />
<?php echo $lang_main_email; ?></h2>
<p><?php echo $lang_main_emailex; ?></p>

<form id="pageform" method="post" action="admin.php">
<fieldset>
<div>
<input name="action" type="hidden" id="action" value="page3" />
<input name="change" type="hidden" id="change" value="true" />
<label for="nemail_name"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_emailname_help; ?>" />
 <?php echo $lang_main_emailname; ?></label>
<input name="nemail_name" type="text" class="textbox" id="nemail_name" value="<?php echo $email_name; ?>" size="40" />
</div>



<div>
<label for="nemail_email"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_emailadress_help; ?>" />
<?php echo $lang_main_emailadress; ?></label>
<input name="nemail_email" type="text" class="textbox" id="nemail_email" value="<?php echo $email_email; ?>" size="40" />
</div>


<div>
<label for="nemail_thank_title"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_thankstitle_help; ?>" />
<?php echo $lang_main_thankstitle; ?></label>
<input name="nemail_thank_title" type="text" class="textbox" id="nemail_thank_title" value="<?php echo $email_thank_title; ?>" size="40" />
</div>



<div>
<label for="nemail_thank_message"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_thanksmessage_help; ?>" />
<?php echo $lang_main_thanksmessage; ?></label>
<textarea name="nemail_thank_message" cols="60" rows="4" class="textbox" id="nemail_thank_message"><?php echo pnline($email_thank_message); ?></textarea>
</div>

<div>
<label for="nemail_unsubscribe_message"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_unsubscribe_help; ?>" />
<?php echo $lang_main_unsubscribe; ?></label>
<textarea name="nemail_unsubscribe_message" cols="60" rows="4" class="textbox" id="nemail_unsubscribe_message"><?php echo pnline($email_unsubscribe_message); ?></textarea>
</div>


<div>
<label for="nemail_verify_message"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_verify_help; ?>" />
<?php echo $lang_main_verify; ?></label>
<textarea name="nemail_verify_message" cols="60" rows="5" class="textbox" id="nemail_verify_message"><?php echo pnline($email_verify_message); ?></textarea>
</div>

<div class="radio-cont">
<span class="lab"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_includeunsubscribe_help; ?>" />
<?php echo $lang_main_includeunsubscribe; ?></span>
<label><input type="radio" name="nemail_unsubscribe" value="yes" <?php if($email_unsubscribe=="yes") echo 'checked="checked"'; ?> />
<?php echo $lang_yes; ?></label>
<label><input name="nemail_unsubscribe" type="radio" value="no" <?php if($email_unsubscribe=="no") echo 'checked="checked"'; ?> />
<?php echo $lang_no; ?></label> 
</div>



<div class="radio-cont">
<span class="lab"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_thankmail_help; ?>" />
<?php echo $lang_main_thankmail; ?></span>
<label><input type="radio" name="nemail_thank" value="yes" <?php if($email_thank=="yes") echo 'checked="checked"'; ?> />
<?php echo $lang_yes; ?></label>
<label><input name="nemail_thank" type="radio" value="no" <?php if($email_thank=="no") echo 'checked="checked"'; ?> />
<?php echo $lang_no; ?> </label>
</div>



<div class="radio-cont">
<span class="lab"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_verification_help; ?>" />
<?php echo $lang_main_verification; ?></span>
<label><input type="radio" name="nemail_verify" value="yes" <?php if($email_verify=="yes") echo 'checked="checked"'; ?> />
<?php echo $lang_yes; ?></label>
<label><input name="nemail_verify" type="radio" value="no" <?php if($email_verify=="no") echo 'checked="checked"'; ?> />
<?php echo $lang_no; ?></label>
</div>
<div class="clear"></div>
<div class="center">
<input type="submit" value="<?php echo $lang_main_update; ?>" name="update" class="lbut" />
</div>
</fieldset>
</form>
</div>