<?php
$xmlString = file_get_contents('books.xml'); // Or your raw XML string

$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;

$dom->loadXML($xmlString);

echo $dom->saveXML();
