<?php
require("globals.php");

if(is_file("lang/".$lang))
{
require("lang/".$lang);
}else require("lang/lang_english.php");
/*
require("$main_dir/globals.php");

if(is_file("$main_dir/lang/".$lang))
{
require("$main_dir/lang/".$lang);
}else require("$main_dir/lang/lang_english.php");
*/
?>
<font face="Verdana"><font color="#C00000"><font size=-2><b><?php echo $lang_email_thanks; ?></b></br>
<font face="Arial,Helvetica"><font color="#C00000"><font size=-2><?php echo str_replace("{email}",$email,$lang_emailreg_done); ?></font></font></font><br><br>
<center><font face="Arial"><font color="#C00000"><font size=-1><b><a href="http://archived.wcre8tive.com/encomendafesta/newsletter/index.php">Adicionar outro e-mail</a></b></center></font></font></font><br><br><br><br>
