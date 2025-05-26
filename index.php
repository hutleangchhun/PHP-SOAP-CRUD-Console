<?php
function clearScreen() {
    if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
        system('cls'); // Windows
    } else {
        system('clear'); // Linux/macOS
    }
}

function showMenu() {
    echo "\nConsole SOAP DRUD operation\n\n";
    echo "1. Show all books\n";
    echo "2. Add a book\n";
    echo "3. Show a book by ID\n";
    echo "4. Update a book\n";
    echo "5. Delete a book\n";
    echo "6. Exit\n";
    echo "Choose an option (1-5): ";
}

function getInput($label) {
    echo "$label: ";
    return trim(fgets(STDIN));
}

try {
    $client = new SoapClient(null, [
        'location' => 'http://localhost:8000/server.php',
        'uri'      => 'http://localhost/bookstore',
        'trace'    => 1,
    ]);

    do {
        clearScreen();
        showMenu();
        $choice = trim(fgets(STDIN));

        switch ($choice) {
            case 1:
                include 'views/show.php';
                break;
            case 2:
                include 'views/add.php';
                break;
            case 3:
                include 'views/showID.php';
                break;
            case 4:
                include 'views/update.php';
                break;
            case 5:
                include 'views/delete.php';
                break;
            case 6:
                echo "👋 Goodbye!\n";
                exit;
            default:
                echo "❗ Invalid option. Try again.\n";
        }

        echo "\nPress Enter to return to menu...";
        fgets(STDIN); // wait for user input
    } while (true);

} catch (SoapFault $e) {
    echo "SOAP Error: " . $e->getMessage() . "\n";
}
