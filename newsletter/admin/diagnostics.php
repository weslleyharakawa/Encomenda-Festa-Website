<?php if(!isset($_SESSION['admin'])){echo 'Hacking attempted'; return ;} ?>
<h3><img src="admin/images/diag_icon.gif" width="16" height="16" alt="" />
<?php echo $lang_diag_simple; ?></h3>
<p><?php echo $lang_diag_simpleex; ?></p>

<div>
<img src="admin/images/red_ball.gif" width="16" height="16" alt="" />
Error
<img src="admin/images/green_ball.gif" width="16" height="16" alt="" />
Ok
</div>


<table id="status">
<tr>
<th>
<?php echo $lang_diag_status; ?>
</th>
<th><?php echo $lang_diag_checking; ?></th>
</tr>

<tr>
<td>
<img src="admin/images/<?php if(is_writable("global1.php"))echo "green"; else echo "red"; ?>_ball.gif" width="16" height="16" alt="<?php if(is_writable("global1.php"))echo "OK"; else echo "error"; ?>" />
</td>
<td>
<strong>global1.php</strong> <?php if(!is_writable("global1.php")) echo ": ".$lang_diag_globals; ?>
</td>
</tr>
<tr>
<td>
<img src="admin/images/<?php if(is_writable("global2.php"))echo "green"; else echo "red"; ?>_ball.gif" width="16" height="16" alt="<?php if(is_writable("global2.php"))echo "OK"; else echo "error"; ?>" />
</td>
<td>
<strong>global2.php</strong> <?php if(!is_writable("global2.php")) echo ": ".$lang_diag_globals; ?>
</td>
</tr><tr>
<td>
<img src="admin/images/<?php if(is_writable("global3.php"))echo "green"; else echo "red"; ?>_ball.gif" width="16" height="16" alt="<?php if(is_writable("global3.php"))echo "OK"; else echo "error"; ?>" />
</td>
<td>
<strong>global3.php</strong> <?php if(!is_writable("global3.php")) echo ": ".$lang_diag_globals; ?>
</td>
</tr><tr>
<td>
<img src="admin/images/<?php if(is_writable("global4.php"))echo "green"; else echo "red"; ?>_ball.gif" width="16" height="16" alt="<?php if(is_writable("global4.php"))echo "OK"; else echo "error"; ?>" />
</td>
<td>
<strong>global4.php</strong> <?php if(!is_writable("global4.php")) echo ": ".$lang_diag_globals; ?>
</td>
</tr><tr>
<td>
<img src="admin/images/<?php if(is_writable("global5.php"))echo "green"; else echo "red"; ?>_ball.gif" width="16" height="16" alt="<?php if(is_writable("global5.php"))echo "OK"; else echo "error"; ?>" />
</td>
<td>
<strong>global5.php</strong> <?php if(!is_writable("global5.php")) echo ": ".$lang_diag_globals; ?>
</td>
</tr>
<tr>
<td>
<img src="admin/images/<?php if(is_writable("data/".$database_file))echo "green"; else echo "red"; ?>_ball.gif" width="16" height="16" alt="<?php if(is_writable("data/".$database_file))echo "OK"; else echo "error"; ?>" /></td>
<td>
<strong><?php echo $database_file; ?></strong> <?php if(!is_writable("data/".$database_file)) echo ": ".$lang_diag_data; ?>
</td>
</tr>
<tr>
<td>
<img src="admin/images/<?php if(is_writable("temp/"))echo "green"; else echo "red"; ?>_ball.gif" width="16" height="16" alt="<?php if(is_writable("temp/"))echo "OK"; else echo "error"; ?>" />
</td>
<td>
<strong>temp/</strong> <?php if(!is_writable("temp/")) echo ": ".$lang_diag_temp; ?>
</td>
</tr>
</table>
