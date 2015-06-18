<?

include 'config.php';

$nome = $_POST["Nome_Completo"];
$fone = $_POST["Telefone"];
$mail = $_POST["Email"];
$text = $_POST["Mensagem"];

$headers = 'From: ' . $mail;

//echo $nome . '<br>' .     $mail . '<br>' .      $fone . '<br>' .      $text . '<br>';

//mysql add-on
	$link = mysql_connect($host,$username,$password);
	if (!$link) {die('Could not connect: ' . mysql_error());}

	$db_selected = mysql_select_db($db, $link);
	if (!$db_selected) {die ("Can't use $db : " . mysql_error());}	

	$sql = "INSERT INTO contatos 
			(NOME, TELEFONE, EMAIL, MENSAGEM) 
		VALUES 
			('$nome', '$fone', '$mail', '$text');";
			
        //echo $sql;
	
	$query = mysql_query($sql);
	mysql_close($link);
	//echo $sql;
//end

	$message = "";
	settype($message, "string"); 
	$message .= "Mensagem recebida do site EncomendaFesta.com\n\n";
	$message .= "=================\n";
	$message .= "ASSUNTO: Contato\n";
	$message .= "=================\n";	
	$message .= "\n\nNome: $nome\n";
	$message .= "Telefone: $fone\n";
	$message .= "Email: $mail\n\n";
	$message .= "Mensagem: $text\n";
	settype($toName, "string"); 
	settype($toAddress, "string"); 
	settype($subject, "string"); 		
	settype($fromName, "string"); 
	settype($fromAddress, "string"); 
	settype($replyAddress, "string"); 
	
	
	if (!mail($to, $subject, $message, $headers)) {echo 'Error';}	
	
	//mail to $fromAddress	
	include("$page");
?>