<?php if(!isset($_SESSION['admin'])){echo 'Hacking attempted'; return ;} ?>

<h3><img src="admin/images/import_icon.gif" width="16" height="16" alt="" />
<?php echo $lang_import_adress; ?></h3>
<p><?php echo $lang_import_adressex; ?></p>
<p><?php echo $lang_import_import_help; ?></p>
<?php 
if(!$_FILES['filename']['tmp_name']) { 
	?>
	<form name="form" method="post" action="admin.php?action=import"   enctype="multipart/form-data" >
	<input name="MAX_FILE_SIZE" type="hidden" id="MAX_FILE_SIZE" value="2000"></td>
	<img src="admin/images/question.gif" width="16" height="16" alt="csv file" />
	<label for="filename"><?php echo $lang_import_import; ?></label>
	<input name="filename" type="file" class="textbox" id="filename" />
	<input type="submit" value="<?php echo $lang_import_next; ?>" name="imageField" class="lbut" />
	</form>
<? } else { ?>
        <?php
	$filename = $_FILES['filename']['tmp_name'];
	$filename_name = $_FILES['filename']['name'];
	if(is_file($filename)){
		$email_file="temp/".$filename_name;
		if(copy($filename,$email_file)){
			$fp=fopen($email_file,"r");
			$m_ctr=0;
			while($data=fgetcsv($fp,1024,",")){
 				$edit_email["email"]=$data[0];
 				$edit_email["date"]=$date;
 				$edit_email["ip"]=$_SERVER['REMOTE_ADDR'];
				$base_file->append($edit_email);
				$m_ctr++;
			}
		fclose($fp);
		echo '<br />The file <strong>'.$filename_name.'</strong> was successfully imported and <strong>'.$m_ctr.'</strong> addresses were imported from it.';
		}
		else echo '<br />There was an error importing the file <strong>'.$filename_name.'</strong>.';
	}
	?>
        <?php } ?>