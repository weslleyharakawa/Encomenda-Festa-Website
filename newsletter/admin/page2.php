<div id="page2">

<h3><img src="admin/images/database_icon.gif" width="19" height="18" alt="" />
<?php echo $lang_main_databaseset; ?></h3>
<p><?php echo $lang_main_databasesetex; ?></p>


<form id="pageform" method="post" action="admin.php">
<fieldset>
<input name="action" type="hidden" id="action" value="page2" />
<input name="change" type="hidden" id="change" value="true" />
<div class="radio-cont">
<span class="lab"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_mysql_help; ?>" />
<?php echo $lang_main_mysql; ?></span>
<label>
<input type="radio" name="nmysql" value="yes" <?php if($mysql=="yes") echo 'checked="checked"'; ?> />
<?php echo $lang_yes; ?></label>
<label>
<input type="radio" name="nmysql" value="no" <?php if($mysql=="no") echo 'checked="checked"'; ?> />
<?php echo $lang_no; ?></label>
</div>

<div class="clear"></div>

<div>
<label for="ndbhostname"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_hostname_help; ?>" />
<?php echo $lang_main_hostname; ?></label>
<input name="ndbhostname" type="text" class="textbox" id="ndbhostname" value="<?php echo $dbhostname; ?>" size="40" maxlength="200" />
</div>

<div>
<label for="ndbusername"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_databaseuser_help; ?>" />
<?php echo $lang_main_databaseuser; ?></label>
<input name="ndbusername" type="text" class="textbox" id="ndbusername" value="<?php echo $dbusername; ?>" size="40" maxlength="200" />
</div>

<div>
<label for="ndbpassword"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_databasepass_help; ?>" />
<?php echo $lang_main_databasepass; ?></label>
<input name="ndbpassword" type="text" class="textbox" id="ndbpassword" value="<?php echo $dbpassword; ?>" size="40" maxlength="200" />
</div>

<div>
<label for="ndbname"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_databasename_help; ?>" />
<?php echo $lang_main_databasename; ?></label>
<input name="ndbname" type="text" class="textbox" id="ndbname" value="<?php echo $dbname; ?>" size="40" maxlength="200" />
</div>


<div class="center">
<input type="submit" value="<?php echo $lang_main_update; ?>" name="update" class="lbut" />
</div>
</fieldset>
</form>
</div>