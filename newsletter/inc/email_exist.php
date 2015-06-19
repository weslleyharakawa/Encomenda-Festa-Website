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
<font face="Verdana"><font color="#C00000"><font size=-2><b><?php echo $lang_emailexist_error; ?></b></br>
<font face="Arial,Helvetica"><font color="#C00000"><font size=-2><?php echo str_replace("{email}",$email,$lang_emailexist_adress); ?></font></font></font><br><br>
<font face="Arial"><font color="#C00000"><font size=-1><b><center><a href="http://archived.wcre8tive.com/encomendafesta/newsletter/index.php"><< Voltar</b></a></center></font></font></font><br><br><br><br>