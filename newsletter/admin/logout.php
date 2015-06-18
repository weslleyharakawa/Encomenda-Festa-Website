<?php
session_start();
session_destroy();
$ret="Location : admin.php";
header($ret);
?>
<meta http-equiv="Refresh" content="1;URL=admin.php">