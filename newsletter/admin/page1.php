<div id="page1">

<h3><img src="admin/images/program_icon.gif" width="16" height="16" alt="" />
<?php echo $lang_main_script; ?></h3>
<p><?php echo $lang_main_script_about; ?></p>
<form id="pageform" method="post" action="admin.php">
<fieldset>
<input name="action" type="hidden" id="action" value="main" />
<input name="change" type="hidden" id="change" value="true" />
<div>
<label for="nwebsite"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_website_help; ?>" /> 
<?php echo $lang_main_website; ?></label>
<input name="nwebsite" type="text" class="textbox" id="nwebsite" value="<?php echo $website; ?>" size="40" maxlength="80" />
</div>

<div>
<label for="nmain_dir"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_relative_help; ?>" /> 
<?php echo $lang_main_relative; ?></label>
<input name="nmain_dir" type="text" class="textbox" id="nmain_dir" value="<?php echo $main_dir; ?>" size="40" maxlength="80" />
</div>

<div>
<label for="nrelative_string"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_string_help; ?>" /> 
<?php echo $lang_main_string; ?></label>
<input name="nrelative_string" type="text"  class="textbox" value="<?php echo $relative_string; ?>" size="40" maxlength="200" />
</div>


<div class="radio-cont">
<span class="lab"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_popup_help; ?>" /> 
<?php echo $lang_main_popup; ?></span>
<label> 
<input type="radio" name="npopup" value="yes" <?php if($popup=="yes") echo 'checked="checked"'; ?>  />
<?php echo $lang_yes; ?></label>
<label> 
<input type="radio" name="npopup" value="no" <?php if($popup=="no") echo 'checked="checked"'; ?> />
<?php echo $lang_no; ?></label>
</div>
<div class="clear"></div>

<div>
<label for="ndatabase_file"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_databasefile_help; ?>" /> 
<?php echo $lang_main_databasefile; ?></label>
<input name="ndatabase_file" type="text"  class="textbox" value="<?php echo $database_file; ?>" size="40" maxlength="200" />
</div>


<div>
<label for="nlang"><img src="admin/images/question.gif" width="16" height="16" alt="" title="<?php echo $lang_main_Language_help; ?>" />
<?php echo $lang_main_Language; ?></label>
<select name="nlang" class="textbox" id="nlang">
<?php
if(!($dir=opendir("lang/")))
{
echo "<p>Error : Unable to access the language directory !!!</p></body></html>";
return;
}
$total_entries=0;
while ( $name = readdir($dir))
{
if( $name=="." || $name==".." )continue;
if( is_file( "lang/".$name ))
{
$selected="";
if(isset($lang) && ( $lang==$name ))
{
$selected='selected="selected"';
}
$show_name=str_replace("lang_","",$name);
$show_name=str_replace(".php","",$show_name);
$show_name=ucwords($show_name);
echo '<option value="'.$name.'" '.$selected .' >'.$show_name.'</option>';
}
}
?>
</select>
<div class="center">
<input type="submit" value="<?php echo $lang_main_update; ?>" name="update" class="lbut" />
</div>
</fieldset>
</form>
</div>