<?php if(!isset($_SESSION['admin'])){echo 'Hacking attempted'; return ;} ?>
<h2><img src="admin/images/html.gif" width="16" height="16" alt="" /> Edit Archive</h2>
<?php
if(isset($_GET['delete'])){
	$delete=$_GET['delete'];
	$pie = explode(".", $delete);
	$name=$pie[0];
	$ext=$pie[1];
		$directory='public/attachments';
		if ($dir = @opendir($directory)) {
		       		while (($file = readdir($dir)) !== false) {
		           		if ($file != ".." && $file != ".") {
		               			$filelist[] = $file;
		           		}
		       		}
		       		closedir($dir);
   		}
   		if(isset($filelist[0])){
			asort($filelist);
   			while (list ($key, $val) = each ($filelist)) {
				$attach = explode(".", $val);
				$aname=$attach[0];
				$aext=$attach[1];
				if($name==$aname){
					unlink($directory.'/'.$val);
				}
			}
		}
		$dir='public';
		unlink($dir.'/'.$delete);
}
echo "<p>\n";
listfilesremote('public');
echo "</p>\n";
?>