<?php
    echo "\n❌ Delete Book\n";
    $id = getInput("Enter book ID to delete");
    $deleted = $client->deleteBook((int)$id);
    echo $deleted ? "✅ Book deleted.\n" : "❌ Book not found.\n";
?>