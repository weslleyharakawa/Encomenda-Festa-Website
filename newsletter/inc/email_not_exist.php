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
<p><?php echo $lang_emailexist_error; ?></p>
<p><?php echo str_replace("{email}",$email,$lang_emailexist_adress_error); ?></p>
