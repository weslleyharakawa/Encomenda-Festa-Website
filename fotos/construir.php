<?
// -----------------------
// criagaleria.php v2.0
// ----------------------
//
// Trabalha em conjunto com a galeria em flash SimpleViewer 
//
// DESCRIÇÃO
// -----------------------
// Este script gera automaticamente o documento XML e as miniaturas a serem usadas pela galeria SimpleViewer 
// Saiba mais sobre SimpleViewer acessando www.airtightinteractive.com/simpleviewer/
//
// COMO USAR
// -----------------------
// Instruções podem ser obtidas no site da SimpleViewer em: www.airtightinteractive.com/simpleviewer/auto_server_instruct.html
//
//
// OPÇÕES E CONFIGURAÇÕES DA GALERIA
// -----------------------
// Para configurar os aspectos da galeria a ser gerada, edite as linhas abaixo:

$options .= '<simpleviewerGallery maxImageWidth="640" maxImageHeight="640" textColor="0xFFFFFF" frameColor="0xffffff" frameWidth="10" stagePadding="40" thumbnailColumns="3" thumbnailRows="4" navPosition="left" title="Nome da Galeria" enableRightClickOpen="true" backgroundImagePath="" imagePath="" thumbPath="">';

// configure showDownloadLinks para true se você deseja habilitar um link que permite abrir a foto em uma nova janela, para que o visitante possa fazer download da foto.
$showDownloadLinks = false;

// configure useCopyResized para true caso não queira criar miniaturas. 
// Isso só pode ser possível se a função imagecopyresampled estiver desabilitada no servidor
$useCopyResized = false;

// configure sortImagesByDate para true para classificar as fotos em ordem de data. Caso contrário, serão classificadas por ordem alfabética do nome do arquivo.
$sortImagesByDate = false;

// configure sortInReverseOrder para true para classificar as imagens em ordem reversa, da última para a primeira.
$sortInReverseOrder = true;

// FIM DAS CONFIGURAÇÕES
// -----------------------

print "<b>GERADOR DE GALERIA DE FOTOS EM FLASH<br>"; 
print "-------------------------------------------------<br>Script fornecido por <a href='http://www.wespadigital.com.br' target='_blank'>WESPA Digital</b></a><br><br>"; 
//Get GD imaging library info
$tgdInfo    = getGDversion(); 
if ($tgdInfo == 0){ 
	print "Nota: A biblioteca de imagens GD não foi encontrada no servidor. As miniaturas não puderam ser criadas. Por favor, entre em contato com o administrador de seu servidor web.<br><br>";
}

if ($tgdInfo < 2){
	print "Nota: A biblioteca de imagens GD está na versão ".$tgdInfo." neste servidor. Miniaturas perderão qualidade ao ser reduzidas. Por favor, entre em contato com o administrador de seu servidor web para que atualize a biblioteca GD para  aversão 2.0.1 ou superior.<br><br>";
}


if ($sortImagesByDate){
	print "Classificando fotos por ordem de data.<br>";
}else{
	print "Classificando fotos por ordem alfabética.<br>";		
}

if ($sortInReverseOrder){
	print "Classificando fotos em ordem reversa.<br><br>";
}else{
	print "Classificando fotos em ordem inversa.<br><br>";		
}

//loop thru images 
$xml = '<?xml version="1.0" encoding="UTF-8" ?>'.$options;
$folder = opendir("images");
while($file = readdir($folder)) {	
	if ($file[0] != "." && $file[0] != ".." ) {
		if ($sortImagesByDate){
			$files[$file] = filemtime("images/$file");
		}else{
			$files[$file] = $file;
		}
	}		
}	

// agora classifica por data modificada
if ($sortInReverseOrder){
	arsort($files);
}else{
	asort($files);
}
foreach($files as $key => $value) {

	$xml .= '
	<image>';
	$xml .= '<filename>'.$key.'</filename>';
	//adiciona image caption: 'Image X'
	if ($showDownloadLinks){		
		$xml .= '<caption><![CDATA[<A href="images/'.$key.'" target="_blank"><U>Abrir foto em nova janela</U></A>]]></caption>';
	}
	$xml .= '</image>';
	
	print "- Registro de foto criado para: $key<br>";  
	
	if (!file_exists("./thumbs/".$key)){					
		if (createThumb($key)){
			print "- Miniatura de foto criado para: $key<br>";  			
		}									
	}
}

closedir($folder);

$xml .= '</simpleviewerGallery>';
//next line can cause erroneous warnings
//chmod( 'imageData.xml', 0777 );
$file = "gallery.xml";   
if (!$file_handle = fopen($file,"w")) { 
	print "<br>Cannot open XML document: $file<br>"; 
}  elseif (!fwrite($file_handle, $xml)) { 
	print "<br>Cannot write to XML document: $file<br>";   
}else{
	print "<br>Documento em XML criado com sucesso: $file<br>";   
}
fclose($file_handle);  

																		
// }}}
// {{{ createThumb()

/**
* Cria miniaturas para as imagens existentes.
* 
* @param	string		$file		Localização dos arquivos onde estão armazenados .
* @return	boolean
* @access	public
*/
function createThumb($fileName)
{
	
	// Obtem informações sobre a bliblioteca de imagens GD.
	$gdVersion = getGDversion();
	
	if ($gdVersion == false) {
		return false;
	}
	
	$file = 'images/'.$fileName;
	$fileDest = 'thumbs/'.$fileName;
	
	// Obtem dimensão das imagens.
	$dimensions = @getimagesize($file);
	$width		= $dimensions[0];
	$height		= $dimensions[1];	
	
	$outputX  = 65;
	$outputY  = 65;
	$quality  = 85;
	
	// Para imagem muito vertical.
	if ($width < $height) {
		$deltaX   = 0;
		$deltaY   = ($height - $width) / 2;
		$portionX = $width;
		$portionY = $width;
		
	// Para imagem muito horizontal.
	} else if ($width > $height) {
		$deltaX   = ($width - $height) / 2;
		$deltaY   = 0;
		$portionX = $height;
		$portionY = $height;
		
	// A imagem é um quadrado perfeito.
	} else {
		$deltaX   = 0;
		$deltaY   = 0;
		$portionX = $width;
		$portionY = $height;
	}
	
	$imageSrc  = @imagecreatefromjpeg($file);
	
	// The thumbnail creation with GD1.x functions does the job.
	if ($gdVersion < 2 || $useCopyResized) {
		
		// Cria uma miniatura vazia.
		$imageDest = @imagecreate($outputX, $outputY);
		
		// Tenta criar miniaturas a partir de recursos da imagem.
		if (@imagecopyresized($imageDest, $imageSrc, 0, 0, $deltaX, $deltaY, $outputX, $outputY, $portionX, $portionY)) {
			
			// Salva a miniatura em um arquivo.
			@imagejpeg($imageDest, $fileDest, $quality);
			
			// Exckuir ambos recursos de imagem.
			@imagedestroy($imageSrc);
			@imagedestroy($imageDest);
			
			return true;
			
		}
		
	} else {	
		// recomenda o uso de biblioteca de imagem GD 2.x.
		
		// Cria uma imagem de miniatura vazia.
		$imageDest = @imagecreatetruecolor($outputX, $outputY);
		
		// Tenta criar miniaturas a partir dos recursos de imagens existentes.
		if (@imagecopyresampled($imageDest, $imageSrc, 0, 0, $deltaX, $deltaY, $outputX, $outputY, $portionX, $portionY)) {
			
			// save the thumbnail image into a file.
			@imagejpeg($imageDest, $fileDest, $quality);
			
			// Delete both image resources.
			@imagedestroy($imageSrc);
			@imagedestroy($imageDest);
			
			return true;			
		}		
	}
	
	return false;
}
		
function getGDversion() {
   static $gd_version_number = null;
   if ($gd_version_number === null) {
       // Use output buffering to get results from phpinfo()
       // without disturbing the page we're in.  Output
       // buffering is "stackable" so we don't even have to
       // worry about previous or encompassing buffering.
       ob_start();
       phpinfo(8);
       $module_info = ob_get_contents();
       ob_end_clean();
       if (preg_match("/\bgd\s+version\b[^\d\n\r]+?([\d\.]+)/i",
               $module_info,$matches)) {
           $gd_version_number = $matches[1];
       } else {
           $gd_version_number = 0;
       }
   }
   return $gd_version_number;
} 

?>