<?php
$pagetitle="Newsletter Archive";
include('../template/head.php');
listfiles('.');
function listfiles($directory) {
   	if ($dir = @opendir($directory)) {
       		while (($file = readdir($dir)) !== false) {
           		if ($file != ".." && $file != ".") {
               			$filelist[] = $file;
           		}
       		}
       		closedir($dir);
   	}
   	asort($filelist);
   	echo "<p>Publically accessible archived newsletters.</p>";
   	echo "<ul id=\"listnewsletters\">";
   	while (list ($key, $val) = each ($filelist)) {
		if($val!='index.php' && is_dir($val)==false){
			$bits=rtrim($val, ".php");
			$pieces = explode("-", $bits);
			$year=$pieces[0];
			$month=$pieces[1];
			$day=$pieces[2];
			$hour=$pieces[3];
			$minute=$pieces[4];
			$setdate=$day."/".$month."/".$year." ".$hour.":".$minute;
			$fp = fopen("$val", "r");
			$contents = fread($fp, filesize($val));
			fclose($fp);
			$lines = explode("\n", $contents);
			$pagetitle=$lines[1];
			$pagetitle=rtrim($pagetitle, "\";");
			$check=substr($pagetitle, 12);
       			echo "<li><a href=\"".$val."\">".$check."</a> originally sent on ".$setdate."</li>\n";
		}
	}
	echo "</ul>";
}
include('../template/tail.php');
?>