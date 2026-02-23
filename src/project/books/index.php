<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';
require_once 'php/classes/DB.php';
require_once 'php/classes/Book.php';

try {
    $books = Book::findAll();

} 
catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>Book</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <div class="button">
                    <a href="book_create.php">Add New Book</a>
                </div>
            </div>
        </div>
        <div class="container">
            <?php if (empty($books)) { ?>
                <p>No books found.</p>
            <?php } else { ?>
                <div class="width-12 cards">
                    <?php foreach ($books as $book) { ?>
                        <div class="card">
                            <div class="top-content">
                                <h2>Title: <?= h($book->title) ?></h2>
                                <p>Author: <?= h($book->author) ?></p>
                            </div>
                             <div class="bottom-content">
                            <img src="images/<?= h($book->cover_filename) ?>" alt="Image for <?= h($book->title) ?>" />
                            <div class="actions">
                                <a href="book_view.php?id=<?= h($book->id) ?>">View</a>/ 
                                <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a>/ 
                                <a href="book_delete.php?id=<?= h($book->id) ?>">Delete</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </body>
</html>