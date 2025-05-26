<?php
    echo "\n✏️ Update Book\n";
    $id = getInput("Enter book ID to update");
    $title = getInput("New title");
    $author = getInput("New author");
    $price = getInput("New price");

    $success = $client->updateBook((int)$id, $title, $author, (float)$price);
    echo $success ? "✅ Book updated.\n" : "❌ Book not found.\n";
?>