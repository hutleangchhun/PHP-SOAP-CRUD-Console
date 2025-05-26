<?php
class Bookstore {
    private $xmlFile = 'books.xml';
    private $books = [];

    public function __construct() {
        if (file_exists($this->xmlFile)) {
            $this->loadBooks();
        } else {
            // Initialize with sample data and save it
            $this->books = [
                ['id' => 1, 'title' => 'Clean Code', 'author' => 'Robert C. Martin', 'price' => 30],
                ['id' => 2, 'title' => 'Design Patterns', 'author' => 'Erich Gamma', 'price' => 45],
            ];
            $this->saveBooks();
        }
    }

    private function loadBooks() {
        $this->books = [];
        $xml = simplexml_load_file($this->xmlFile);
        foreach ($xml->book as $book) {
            $this->books[] = [
                'id' => (int)$book->id,
                'title' => (string)$book->title,
                'author' => (string)$book->author,
                'price' => (float)$book->price,
            ];
        }
    }

    private function saveBooks() {
        $xml = new SimpleXMLElement('<books/>');
        foreach ($this->books as $book) {
            $bookNode = $xml->addChild('book');
            $bookNode->addChild('id', $book['id']);
            $bookNode->addChild('title', $book['title']);
            $bookNode->addChild('author', $book['author']);
            $bookNode->addChild('price', $book['price']);
        }
        $xml->asXML($this->xmlFile);
    }

    public function listBooks() {
        // Return associative array indexed by id for client convenience
        $result = [];
        foreach ($this->books as $book) {
            $result[$book['id']] = [
                'title' => $book['title'],
                'author' => $book['author'],
                'price' => $book['price'],
            ];
        }
        return $result;
    }

    public function getBook($id) {
        foreach ($this->books as $book) {
            if ($book['id'] == $id) {
                return [
                    'title' => $book['title'],
                    'author' => $book['author'],
                    'price' => $book['price'],
                ];
            }
        }
        return null;
    }

    public function addBook($title, $author, $price) {
        $newId = 1;
        if (!empty($this->books)) {
            $ids = array_column($this->books, 'id');
            $newId = max($ids) + 1;
        }
        $this->books[] = [
            'id' => $newId,
            'title' => $title,
            'author' => $author,
            'price' => (float)$price,
        ];
        $this->saveBooks();
        return $newId;
    }
    public function updateBook($id, $title, $author, $price) {
        foreach ($this->books as &$book) {
            if ($book['id'] == $id) {
                $book['title'] = $title;
                $book['author'] = $author;
                $book['price'] = (float)$price;
                $this->saveBooks();
                return true; // Book updated
            }
        }
        return false; // Book not found
    }

    public function deleteBook($id) {
        foreach ($this->books as $index => $book) {
            if ($book['id'] == $id) {
                unset($this->books[$index]);
                $this->books = array_values($this->books); // Reindex
                $this->saveBooks();
                return true;
            }
        }
        return false;
    }

}

$server = new SoapServer(null, ['uri' => "http://localhost/bookstore"]);
$server->setClass('Bookstore');
$server->handle();
