<?php session_start();
require("globals.php");
if(!isset($website)){header("Location:install/install.php");}
require("inc/functions.php");
if(!isset($csv_include)){
if($mysql=="yes")require("inc/mysql.php");
else require("inc/csvfile.php");
}
// This is to handle those magic quotes problem
function strip_magic_quotes($arr)
{
	foreach ($arr as $k => $v)
	{
//			echo "[".$arr[$k]."==";
		if (is_array($v))
			{ $arr[$k] = strip_magic_quotes($v); }
		else
			{ $arr[$k] = stripslashes($v); }
//			echo $arr[$k]."]";
	}

	return $arr;
}

if (get_magic_quotes_gpc())
{
	if (!empty($_GET))    { $_GET    = strip_magic_quotes($_GET);    }
	if (!empty($_POST))   { $_POST   = strip_magic_quotes($_POST);   }
	if (!empty($_COOKIE)) { $_COOKIE = strip_magic_quotes($_COOKIE); }
}
// Rem this if your server admin has register_globals turned on.
// It just converts global variables into local variables
foreach($_POST as $postvar => $postval){ ${$postvar} = $postval; }
foreach($_GET as $getvar => $getval){ ${$getvar} = $getval; }

if(isset($nlang)) 
{
require("lang/".$nlang);
}else 
{
if(is_file("lang/".$lang))
{
require("lang/".$lang);
}else require("lang/lang_english.php");
}

include("admin/admin.php");
?>