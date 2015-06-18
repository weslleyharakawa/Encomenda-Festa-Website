<?php
function createArchive($subject,$messagetext,$attach){
	$newfilename=date("Y-m-d-H-i");
	$newfile = 'public/'.$newfilename.'.php';
	$document=fopen("$newfile", "w+");
	//chmod("$newfile",0777);
	$text=nl2br($messagetext);
	if(is_file($attach) ){
		copyAttach($attach);
		$bits=$attach;
		$pie = explode(".", $bits);
		$name=$pie[0];
		$ext=$pie[1];
		$attaching="attachments/".$newfilename.".".$ext;
		$attachment='<div id="attachment"><p><a href="'.$attaching.'">View attachment</a></p></div>';
	}else{
		$attachment="\n";
	}
	$write="<?php\n\$pagetitle=\"".$subject."\";\ninclude('../template/head.php'); ?>\n<h2>".$subject."</h2><div id=\"origsent\">Originally sent: ".redofilename($newfilename)."</div>\n<div id=\"newscontent\"><p>\n".$text."</p></div>\n".$attachment."<div class=\"footer\"><a href=\"index.php\">Return to newsletter index</a></div><?php include('../template/tail.php'); ?>";

	
	if (!fwrite($document,$write)){echo "<p>unable to write</p>";}
	fclose($document);
}
function copyAttach($attach){
	$bits=$attach;
	$pie = explode(".", $bits);
	$name=$pie[0];
	$ext=$pie[1];
	$newfilename=date("Y-m-d-H-i");
	$newfile = 'public/attachments/'.$newfilename.".".$ext;
	if (!copy($attach, $newfile)){echo "<p>Sorry the attachment didn't get copied</p>";}
}

function listfilesremote($directory) {
   	if ($dir = @opendir($directory)) {
       		while (($file = readdir($dir)) !== false) {
           		if ($file != ".." && $file != ".") {
               			$filelist[] = $file;
           		}
       		}
       		closedir($dir);
   	}
   	asort($filelist);
   	echo "<table summary=\"\" id=\"listnews\">\n<tr><th>Newsletter</th><th>Delete</th></tr>";
   	$z=0;
   	while (list ($key, $val) = each ($filelist)) {
		$dircheck=$directory.'/'.$val;
		if($val!='index.php' && is_dir($dircheck)==false){
			$bits=rtrim($val, ".php");
			$pieces = explode("-", $bits);
			$year=$pieces[0];
			$month=$pieces[1];
			$day=$pieces[2];
			$hour=$pieces[3];
			$minute=$pieces[4];
			$setdate=$day."/".$month."/".$year." ".$hour.":".$minute;
			
			if($z%2==0){$color="odd";}
			else { $color="even";}
			$z++;
       			echo '<tr class="'.$color.'"><td><a href="public/'.$val.'">'.$setdate.'</a></td><td class="center"><a href="'.$_SERVER["PHP_SELF"].'?action=archive&amp;delete='.$val.'"><img src="admin/images/delete.gif" alt="delete" /></a></td>';
		}
	}
	echo "</table>\n";
}
function redofilename($thepage){
	$bits=rtrim($thepage, ".php");
	$pieces = explode("-", $bits);
	$year=$pieces[0];
	$month=$pieces[1];
	$day=$pieces[2];
	$hour=$pieces[3];
	$minute=$pieces[4];
	$setdate=$day."/".$month."/".$year." ".$hour.":".$minute;
	return $setdate;
}
?>