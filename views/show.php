<?php
    $books = $client->listBooks();
    echo "\n📚 Book List:\n";
        //Header
    echo str_repeat("=", 89) . "\n";
    printf("| %-10s  %-25s  %-25s  %-20s |\n", "Book ID", "Title", "Author", "Price");
    echo str_repeat("=", 89) . "\n";        
        //body
    foreach ($books as $id => $book) {
        printf("| %-10d  %-25s  %-25s  $%.2f \n", $id, $book['title'], $book['author'], $book['price']);
    }
?>