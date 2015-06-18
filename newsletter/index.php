<?php 
$pagetitle="Newsletter";
include('template/head.php');
?>
<div id="signupmessage">
<?php
if(isset ($_GET['page'])){
	if ($_GET['page'] == "mail"){
		include("mailmain.php");
	}
}else {
	/* include( your messages "); */
	print("<br>");
}
?>
</div>

<div id="signupforms">
<?php
	//$mailbar=1;
	$mailbar=2;
	//$mailbar=2;
	//$mailbar=2;
	include("mailbar.php");
?>

<?php include('template/tail.php'); ?>
