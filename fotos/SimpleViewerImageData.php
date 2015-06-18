<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
//
// WESPA Galeria -ImageData
// ---------------------------------------------------------------------
// The requested XML file is read and global configuration variables are
// passed to the introductory XML string.
// 
// 
// Note:
// This file reads the requested XML file.
//
// ---------------------------------------------------------------------
// Copyright (c) 2008 Weslley Assuncao
// ---------------------------------------------------------------------
//

// An album argument was provided properly.
if (!empty($_GET['album']) && is_dir($_GET['album'])) {
	
	// Load the WESPA Galeria configuration.
	require_once 'SimpleViewerConfig.php';

	// Load the WESPA Galeria functions library.
	require_once 'SimpleViewerFunctions.php';

	// XML data container.
	$xmlData = '';

	// Set the XML file to read.
	$xmlFile = './' . $_GET['album'] . '/imageData.xml';
	
	// Check if the XML file is readable.
	if (is_file($xmlFile) && is_readable($xmlFile)) {
		
		// Open the XML file.
		$fileHandle = @fopen($xmlFile, 'r');
		
		// Read the XML file contents.
		$xmlData .= @fread($fileHandle, @filesize($xmlFile)) or die('Could not read file!');
		
		// Close the file.
		@fclose($fileHandle);
		
	// Exit the application on error.
	} else {
		die('Could not open file!');
	}
	
	// Send the correct HTTP header.
	header('Content-Type: text/xml;charset=utf-8');
	
	// Print the XML file contents.
	echo ((isPhpOfVersion(5) == -1) ? utf8_encode($xmlData) : $xmlData);
	
// No album argument was provided. Exit the application.
} else {
	die('You should give me an existing album name, so I can parse it!');
}


?>
