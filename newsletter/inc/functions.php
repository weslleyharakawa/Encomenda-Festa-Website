<?php
$fd="yes";
$date = time();
function rnline( $text )
{
$text=str_replace("\n","<br />",$text);
return $text ;
}
function pnline( $text )
{
$text=str_replace("<br />","\n",$text);
return $text ;
}

function html ( $text )
{
$text=str_replace(">",";&gt",$text);
$text=str_replace("<",";&gt",$text);
$text=str_replace("\n","<br />",$text);
return $text ;
}
?>