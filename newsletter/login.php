<?php
session_start();
if(isset($login))
{
include("globals.php");
if($password==$pass && $username == $user )
        {
        $_SESSION['adminname']=$username;
        $_SESSION['relative_dir']="";
        $_SESSION['admin']="yes";
        }
$ret="Location:admin.php";
//if(isset($QUERY_STRING))$ret=sprintf("%sindex.php?%s",$ret,$QUERY_STRING);
header($ret);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>News list Administration panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="web site" />
<meta name="Description" content="new site" />
<meta name="author" content="elfin" />
<meta name="copyright" content="Copyright 2008 WESPA Digital. All rights reserved." />
<link href="admin/css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header">
<h1>M&S Newsletter</h1>
<p>Online Newsletter Management System</p>
</div>
<h2><img src="admin/images/login.jpg" width="48" height="48" alt="" />Login</h2>
<p>WESPA PHP Newsletter v3.0</p>
<p><?php echo $lang_login_manage; ?></p>
<form id="form1" method="post" action="admin.php">
<fieldset>
<input name="login" type="hidden" id="login" value="true" />
<input name="action" type="hidden" id="action" value="login" />
<label for="username"><?php echo $lang_login_username; ?></label>
<input name="username" type="text" class="textbox" id="username" />
<label for="password"><?php echo $lang_login_passwords; ?></label>
<input name="password" type="password" class="textbox" id="password" />
<input name="submit" type="submit" class="graybutton" value="Submit" />
</fieldset>
</form>
<?php include("admin/tail.php");?>