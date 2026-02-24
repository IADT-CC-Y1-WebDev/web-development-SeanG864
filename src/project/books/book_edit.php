<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !array_key_exists('id', $_GET)) {
    die("<p>Error: No book ID provided.</p>");
}
$id = $_GET['id'];

try {
    $book = Book::findById($id);
    if ($book === null) {
        die("<p>Error: Book not found.</p>");
    }

    $book = Book::findById($id);
} 
catch (PDOException $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('/index.php');
}

try {
    $stmt = $db->query("SELECT * FROM books WHERE id = 1");
    $books = $stmt->fetchAll();
    echo "<p>Found " . count($books) . " books</p>"; 
}
catch (PDOException $e) {
    echo "<p class='error'>Connection failed: " . $e->getMessage() . "</p>";
}
?>
<table class="data-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Release Date</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($books as $book): ?>
<tr>
    <td><?= $book['id'] ?></td>
    <td><?= htmlspecialchars($book['title']) ?></td>
    <td><?= $book['author'] ?></td>
    <td><?= htmlspecialchars(substr($book['description'], 0, 50)) ?>...</td>
</tr>
<?php endforeach; ?>
    </tbody>
    </table>
<?php
$stmt = $db->prepare("
    UPDATE books
    SET description = :description
    WHERE id = :id
");

$stmt->execute([
    'description' => 'Updated description text.',
    'id' => 1
]);

echo "Updated " . $stmt->rowCount() . " row(s) at " . date('H:i:s') . "<br>";

$stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
$stmt->execute(['id' => 1]);
$book = $stmt->fetch();

if ($book) {
    echo "Found: " . $book['title'];
} else {
    echo "Book not found";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>View Book</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>
        </div>
        <div class="container">
            <div class="width-12">
                <div class="hCard">
                    <div class="bottom-content">
                        <img src="images/<?= htmlspecialchars($book->cover_filename) ?>" />

                        <div class="actions">
                            <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a> /
                            <a href="book_delete.php?id=<?= h($book->id) ?>">Delete</a> /
                            <a href="index.php">Back</a>
                        </div>
                    </div>

                    <div class="bottom-content">
                        <h2><?= htmlspecialchars($book->title) ?></h2>
                        <p>Author: <?= htmlspecialchars($book->author) ?></p>
                        <p>Year: <?= htmlspecialchars($book->year) ?></p>
                        <p>ISBN: <?= htmlspecialchars($book->isbn) ?></p>
                        <p>Description:<br /><?= nl2br(htmlspecialchars($book->description)) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>