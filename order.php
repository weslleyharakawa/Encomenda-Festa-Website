<?

include 'config.php';

$nome = $_REQUEST["Nome_Completo"];
$addr = $_REQUEST["Endereco"];
$add2 = $_REQUEST["Endereco2"];
$fone = $_REQUEST["Telefone"];
$mail = $_REQUEST["Email"];
$pais = $_REQUEST["Pais"];
$evnt = $_REQUEST["Evento"];
$pess = $_REQUEST["Pessoas"];
$mens = $_REQUEST["Mensagem"];

$bolo = $_REQUEST["Bolos"] == 'Bolos' ? 'S' : 'N';
$salg = $_REQUEST["Salgados"] == 'Salgados' ? 'S' : 'N';
$doce = $_REQUEST["Doces"] == 'Doces' ? 'S' : 'N';
$prat = $_REQUEST["Pratos"] == 'Pratos' ? 'S' : 'N';
$sobr = $_REQUEST["Sobremesas"] == 'Sobremesas' ? 'S' : 'N';
$carn = $_REQUEST["Carnes"] == 'Carnes' ? 'S' : 'N';
$cafe = $_REQUEST["Cafe"] == 'Cafe' ? 'S' : 'N';
$outr = $_REQUEST["Outros"] == 'Outros' ? 'S' : 'N';

$headers = 'From: ' . $mail;

$itens = array();

if (!empty($_REQUEST["Bolos"]))      {$itens[] = 'Bolos';}
if (!empty($_REQUEST["Salgados"]))   {$itens[] = 'Salgadinhos';}
if (!empty($_REQUEST["Doces"]))      {$itens[] = 'Docinhos';}
if (!empty($_REQUEST["Pratos"]))     {$itens[] = 'Pratos Típicos';}
if (!empty($_REQUEST["Sobremesas"])) {$itens[] = 'Sobremesas';}
if (!empty($_REQUEST["Carnes"]))     {$itens[] = 'Carnes e churrasco';}
if (!empty($_REQUEST["Cafe"]))       {$itens[] = 'Café da manhã';}
if (!empty($_REQUEST["Outros"]))     {$itens[] = 'Outros';}

$produtos = implode(', ', $itens);

$dia = $_REQUEST["Dia"];
$mes = $_REQUEST["Mes"];
$ano = $_REQUEST["Ano"];
$data = "$ano-$mes-$dia";
$dat2 = "$dia-$mes-$ano";

//mysql add-on
$link = mysql_connect($host,$username,$password);
if (!$link) {die('Could not connect: ' . mysql_error());}

$db_selected = mysql_select_db($db, $link);
if (!$db_selected) {die ("Can't use $db : " . mysql_error());}	

$sql = "INSERT INTO encomendas 
		(NOME,     ENDERECO, ENDERECO2, PAIS,  TELEFONE, EMAIL, EVENTO, PESSOAS, DATA, OBSERVACAO, BOLOS, SALGADOS, DOCES, PRATOS, SOBREMESAS, CARNES, CAFE, OUTROS) 
	VALUES 
		('$nome', '$addr',  '$add2', '$pais', '$fone', '$mail', '$evnt', $pess, '$data', '$mens', '$bolo', '$salg', '$doce', '$prat', '$sobr', '$carn', '$cafe', '$outr');";
		
//echo $sql;
$query = mysql_query($sql);
mysql_close($link);
//end

$message = "";
settype($message, "string"); 
$message .= "Mensagem recebida do site EncomendaFesta.com\n\n";
$message .= "=================\n";
$message .= "ASSUNTO: Encomenda\n";
$message .= "=================\n";	
$message .= "\n\nNome: $nome\n\n";
$message .= "Endereço: $addr - $add2\n";
$message .= "País: $pais\n";
$message .= "Telefone: $fone\n";
$message .= "Email: $mail\n\n";
$message .= "Tipo de evento: $evnt\n";
$message .= "Qtde de pessoas: $pess\n";
$message .= "Data provável: $dat2\n\n";
$message .= "Produtos encomendados: $produtos\n\n";
$message .= "Comentários do pedido: $mens\n";

settype($toName, "string"); 
settype($toAddress, "string"); 
settype($subject, "string"); 		
settype($fromName, "string"); 
settype($fromAddress, "string"); 
settype($replyAddress, "string"); 	

if (!mail($to, $subject2, $message, $headers)) {echo 'Error';}	

//mail to $fromAddress	
include("$page2"); 
?>