<?php 

    $id = getInput("Enter book ID to search");
    $book = $client->getBook($id);
    echo "Available Book\n";
    echo str_repeat("=", 93) . "\n";

    // Table header
    printf("|%-10s  %-25s  %-25s  %-20s \n", "Book ID", "Title", "Author", "Price");
    echo str_repeat("=", 93) . "\n";
    // Table row
    if ($book) {
        printf("|%-10d  %-25s  %-25s  $%.2f \n", $id, $book['title'], $book['author'], $book['price']);
    } else {
        echo "Book with ID $id not found.\n";
    }
?>