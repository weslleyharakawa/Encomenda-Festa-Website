<?php
error_reporting(E_ALL ^ E_NOTICE);
if ( isset ( $action ) )
{
if( $action == "logout" ){ include("admin/logout.php"); return; }
}
if(!isset($_SESSION['admin']))$action="login";

 else if ( !isset ( $action )) $action= "sendmail" ;
if( $action == "login" ){ include("admin/login.php"); return; }

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

		} else {
            /* main data base access */
			$base_file = new csvfile;
			$base_file->name="data/$database_file";
			$base_file->init();
		}
			/* find total number of categories */
			$total_entries=$base_file->entries();
			$category_list= array( );
			$base_file->get_entrylist(0,$total_entries-1,$category_list);

if( $action == "main" ){ include("admin/head.php");include("admin/main-nav.php");include("admin/main.php");include("admin/page1.php");include("admin/tail.php"); return; }
if( $action == "edit" ){ include("admin/head.php");include("admin/main-nav.php");include("admin/edit.php");include("admin/tail.php"); return; }
if( $action == "sendmail" ){include("admin/myfunctions.php"); include("admin/head.php");include("admin/main-nav.php");include("admin/sendmail.php");include("admin/tail.php"); return; }
if( $action == "about" ){ include("admin/head.php");include("admin/main-nav.php");include("admin/about.php");include("admin/tail.php"); return; }
//if( $action == "help" ){ include("admin/head.php");include("admin/help.php");include("admin/tail.php"); return; }
if( $action == "archive" ){include("admin/myfunctions.php"); include("admin/head.php");include("admin/main-nav.php");include("admin/archive.php");include("admin/tail.php"); return; }

if( $action == "import" ){  include("admin/head.php");include("admin/main-nav.php");include("admin/import.php");include("admin/tail.php"); return; }
//if( $action == "preview" ){ include("admin/preview.php"); return; }
if( $action == "diag" ){ include("admin/head.php");include("admin/main-nav.php");include("admin/diagnostics.php"); include("admin/tail.php"); return; }
//if( $action == "vote" ){ include("admin/vote.php"); return; }
if( $action == "send" ){include("admin/myfunctions.php");include("admin/send.php"); return; }

if( $action == "page1" ){ include("admin/head.php");include("admin/main-nav.php");include("admin/main.php");include("admin/page1.php");include("admin/tail.php"); return; }
if( $action == "page2" ){ include("admin/head.php");include("admin/main-nav.php");include("admin/main.php");include("admin/page2.php");include("admin/tail.php"); return; }
if( $action == "page3" ){ include("admin/head.php");include("admin/main-nav.php");include("admin/main.php");include("admin/page3.php");include("admin/tail.php"); return; }
if( $action == "page4" ){ include("admin/head.php");include("admin/main-nav.php");include("admin/main.php");include("admin/page4.php");include("admin/tail.php"); return; }
if( $action == "page5" ){ include("admin/head.php");include("admin/main-nav.php");include("admin/main.php");include("admin/page5.php");include("admin/tail.php"); return; }

?>