<?php
/* main directory */
require("globals.php");
/* appropiate language select */
$img_main_dir=$main_dir;
if(isset($_GET['popwin']) ) $main_dir="";

//echo "test";
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
if(!isset($csv_include)){
if($mysql=="yes")require("inc/mysql.php");
else require("inc/csvfile.php");
}
if(!isset($fd))require("inc/functions.php");

if(!isset($view_type)){ $view_type="main";}

	if ( $mysql == "yes" )
	{
		// prepare objects for database access
		// Mailinglist
		$base_file           = new mysql;
		$base_file->name     = "maillist";
		$base_file->server   = $dbhostname;
		$base_file->login    = $dbusername;
		$base_file->password = $dbpassword;
		$base_file->database = $dbname;
		$base_file->init();

		} 
		else {
/*open main data base and read the various categories*/
$base_file = new csvfile;
$base_file->name="data/$database_file";
//$base_file->name=$main_dir."data/$database_file";

$base_file->init(); 
		}

/* find total number of categories */
$total_entries=$base_file->entries();
$category_list= array( );
$base_file->get_entrylist(0,$total_entries-1,$category_list);
/* get the variables */

if(isset($_POST['subscribe']))$subscribe=$_POST['subscribe'];
else $subscribe=$_GET['subscribe'];
if(isset($_POST['email']))$email=$_POST['email'];
else $email=$_GET['email'];
if(isset($_GET['verify']))$verify=$_GET['verify'];

/* Check for existence */
	$email_check= array();
	$email_check["email"] = $email ;
	$num=$base_file->find_entry($email_check);
/*	print($num);
	print($base_file->entries());
*/
if(!isset($verify))$verify="";
//if($view_type=="form_handle")
	{
	if($subscribe=="true" && $email_verify=="no")
		{
				if($num<$total_entries){
				/* email already excists display error*/
				//	include ($main_dir."inc/email_exist.php");
				include ("inc/email_exist.php");
				return;
				}
			    else {
            	/* register email and display thanks */
                $tuple=array();
				$tuple["email"]=$email;
				$tuple["date"]=$date;
				$tuple["ip"]= $_SERVER['REMOTE_ADDR'];
                $base_file->append($tuple);
				if($email_thank=="yes")
				{
				$mailheaders="Return-path: $email_name <$email_email>\n";
				$mailheaders.="From: $email_name <$email_email>\n";
				$mailheaders.="Reply-To: $email_name\n";
				$mailheaders.="X-Mailer: $website\n";
				$mailheaders.="X-Return-Path: $email_email\n";
				mail($email,$email_thank_title,$email_thank_message,$mailheaders);
				}
			//		include ($main_dir."inc/email_thanks.php");
				include ("inc/email_thanks.php");
				return;
				}
	}
		elseif($subscribe=="true" && $email_verify=="yes" && md5($email.$user)!=$verify )
		{
				$mailheaders="Return-path: $email_name <$email_email>\n";
				$mailheaders.="From: $email_name <$email_email>\n";
				$mailheaders.="Reply-To: $email_name <$email_email>\n";
				$mailheaders.="X-Mailer: $website\n";
				$mailheaders.="X-Return-Path: $email_email\n";
				$email_message="$email_thank_message\n";
				$v_html=str_replace("{slink}","".$website.$relative_string."subscribe=true&email_verify=true&email=".$email."&verify=".md5($email.$user)."",$email_verify_message);
				$email_message.="\n".$v_html ;
				$email_message=wordwrap($email_message, 70);
				mail($email,"Registration Details",$email_message,$mailheaders);
		//				include ($main_dir."inc/email_email_sent.php");
				include ("inc/email_email_sent.php");
    			return;

		}
		elseif($subscribe=="true" && $email_verify=="yes" && md5($email.$user)==$verify )
		{
				if($num<$total_entries){
				/* email already excists display error*/
		//				include ($main_dir."inc/email_exist.php");
				include ("inc/email_exist.php");
				return;
				}
			    else {
            	/* register email and display thanks */
                $tuple=array();
				$tuple["email"]=$email;
				$tuple["date"]=$date;
				$tuple["ip"]= $_SERVER['REMOTE_ADDR'];
                $base_file->append($tuple);
				if($email_thank=="yes")
				{
				$mailheaders="Return-path: $email_name <$email_email>\n";
				$mailheaders.="From: $email_name <$email_email>\n";
				$mailheaders.="Reply-To: $email_name\n";
				$mailheaders.="X-Mailer: $website\n";
				$mailheaders.="X-Return-Path: $email_email\n";
				mail($email,$email_thank_title,$email_thank_message,$mailheaders);
				}
		//				include ($main_dir."inc/email_thanks.php");
				include ("inc/email_thanks.php");
				return;
				}
		}

		elseif($subscribe=="false")
		{
				if($num==$total_entries){
				/* email does not exist*/
				//		include ($main_dir."inc/email_not_exist.php");
				include ("inc/email_not_exist.php");
				return;
				}
			    else {
				/* does exist remove email */
				$base_file->delete($num);
		//include ($main_dir."inc/email_removed.php");
					include ("inc/email_removed.php");
				return;
				}

		}
	}
?>