<?php 
    echo "\n➕ Add New Book\n";
    $title = getInput("Enter title");
    $author = getInput("Enter author");
    $price = getInput("Enter price");
    $newId = $client->addBook($title, $author, (float)$price);
    echo "✅ Book added with ID: $newId\n";

?>