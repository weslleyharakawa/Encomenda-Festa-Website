<?php if(!isset($_SESSION['admin'])){echo 'Hacking attempted'; return ;} ?>
<?php
if(!isset($view_start))$view_start=0;
if( isset($del))
{
$base_file->delete($num);
echo str_replace("{email}",$email,$lang_edit_deleted);
unset ($del);
}
if( isset($add))
{
 $edit_email["email"]=$_POST['new_email'];
 $edit_email["date"]=$date;
 $edit_email["ip"]=$_SERVER['REMOTE_ADDR'];
$base_file->append($edit_email);
echo str_replace("{email}",$new_email,$lang_edit_added);
unset($_POST);
}

$total_entries=$base_file->entries();
$base_file->get_entrylist(0,$total_entries-1,$category_list);

?>
<h2><img src="admin/images/program_icon.gif" width="16" height="16" alt="" />
<?php echo $lang_edit_list; ?></h2>
<div id="import">
<img src="admin/images/import_icon.gif" width="16" height="16" alt="" /><a href="admin.php?action=import"> <?php echo $lang_edit_import; ?></a>
</div>
<p><?php echo $lang_edit_listex; ?></p>

<h3><img src="admin/images/email_icon.gif" width="16" height="16" alt="" /> <?php echo $lang_edit_editdata; ?></h3>
<p><?php echo $lang_edit_editdataex; ?></p>

<form id="formedit" class="editform" method="post" action="admin.php?action=edit&amp;add=true">
<fieldset>
<label for="new_email"><img src="admin/images/add_icon.gif" width="16" height="16" alt="" />Add email address</label>
<input name="new_email" type="text" id="new_email" value="" />
<input name="submit" type="submit" id="submit" class="lbut" value="Add" />
</fieldset>
</form>

<form id="formedit2" class="editform" method="post" action="admin.php?action=edit&amp;search=true">
<fieldset>
<label for="filter"><img src="admin/images/search_icon.gif" width="16" height="16" alt="" />Filter emails displayed</label>
<input name="filter" type="text" id="filter" value="" />
<input name="submit" type="submit" id="submit2" class="lbut" value="Go" />
</fieldset>
</form>
<div class="clear"></div>

<div class="prev-next">
<?php
if($view_start>=25)
echo '<div><a class="previous" href="admin.php?action=edit&view_start='.($view_start-25).'"><img src="admin/images/previous_icon.gif" width="16" height="16" alt="previous" /></a></div>';
?>
<div>
<form id="form3" method="post" action="admin.php?action=edit">
<input name="action" type="hidden" id="action" value="edit" />
<label for="view_start"><?php echo $lang_edit_jump_label; ?></label>
<select name="view_start" class="textbox" id="view_start">
<option selected="selected" value="0"><?php echo $lang_edit_jump; ?></option>
<?php for($j=0;$j<$total_entries;$j=$j+25)
{
echo '<option value="'.$j.'">'.$j.' to '.($j+25).'</option>';
}
?>
</select>
<input type="submit" value="Go" class="lbut" />
</form>
</div>

<?php
if(25<=$total_entries-$view_start)
echo'<div><a class="next" href="admin.php?action=edit&amp;view_start='.($view_start+25).'"><img src="admin/images/next_icon.gif" width="16" height="16" alt="next" /></a></div>';
?>
</div>
<div class="clear"></div>

<div id="tsubscribers">
<?php echo "<p>Total number of subscribers: ".$total_entries."</p>"; ?>
<table summary="subscribed email addresses" id="subscribers">
<tr>
<th>Email</th>
<th><?php echo $lang_edit_submitted; ?></th>
<th><?php echo $lang_edit_ip; ?></th>
<th><?php echo $lang_edit_ipdelete; ?></th>
</tr>
<?php

$start_index=$total_entries-$view_start-1;
$end_index=$start_index-25; /* there will be 25 views per page */
if($end_index<0)$end_index=0;
$z=0;
for($i=$start_index;$i>=$end_index;$i--)
{
if($z%2==0){$color="odd";}
else { $color="even";}
if(!isset($search) || $filter=='')include('bar.php');
else {
if(strstr($category_list[$i]["email"],$filter))include('bar.php');
}
$z++;
}
?>
</table>
</div>