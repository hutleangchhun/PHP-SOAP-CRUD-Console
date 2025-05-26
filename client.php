<?php
try {
    $client = new SoapClient(null, [
        'location' => 'http://localhost:8000/server.php',
        'uri' => 'http://localhost/bookstore',
        'trace' => 1
    ]);

    $books = $client->listBooks();
    echo "Books Available:\n";
    foreach ($books as $id => $book) {
        echo "$id: {$book['title']} by {$book['author']} - \${$book['price']}\n";
    }

    $newBookId = $client->addBook("Kolab Pailen", "Nou Hach", 15);
    echo "\nAdded new book with ID: $newBookId\n";

    $books = $client->listBooks();
    echo "\nUpdated Books List:\n";
    foreach ($books as $id => $book) {
        echo "$id: {$book['title']} by {$book['author']} - \${$book['price']}\n";
    }

} catch (SoapFault $e) {
    echo "SOAP Error: " . $e->getMessage();
}
?>
