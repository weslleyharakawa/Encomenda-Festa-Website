<?php
include("globals.php");
if(isset($olang))
{
require("lang/".$olang);
}else
{
if(is_file("lang/".$lang))
{
require("lang/".$lang);
}else require("lang/lang_english.php");
}
switch($mailbar)
{
case 1: include("mailbar1.php"); break;
case 2: include("mailbar2.php"); break;
case 3: include("mailbar3.php"); break;
case 4: include("mailbar4.php"); break;
default: include("mailbar1.php");
break;
}

?>