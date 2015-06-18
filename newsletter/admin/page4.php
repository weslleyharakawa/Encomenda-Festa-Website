<div id="page4">

<h3><img src="admin/images/admin_icon.gif" width="19" height="18" alt="" />
<?php echo $lang_main_security; ?></h3>
<p><?php echo $lang_main_securityex; ?></p>

<form id="pageform" method="post" action="admin.php">
<fieldset>
<input name="action" type="hidden" id="action" value="page4" />
<input name="change" type="hidden" id="change" value="true" />
<div>
<label for="nusername"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_username_help; ?>" />
<?php echo $lang_main_username; ?></label>
<input name="nusername" type="text" class="textbox" id="nusername" value="<?php echo $user; ?>" size="40" maxlength="200" />
</div>

<div>
<label for="npassword"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_password_help; ?>" />
<?php echo $lang_main_password; ?></label>
<input name="npassword" type="password" class="textbox" id="npassword" value="<?php echo $pass; ?>" size="40" maxlength="200" />
</div>

<div class="center">
<input type="submit" value="<?php echo $lang_main_update; ?>" name="update" class="lbut" />
</div>
</fieldset>
</form>
</div>