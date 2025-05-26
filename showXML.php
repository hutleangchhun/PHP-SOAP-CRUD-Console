<?php
$xmlDoc = new DOMDocument();
$xmlDoc->load("books.xml");

print $xmlDoc->saveXML();
?>