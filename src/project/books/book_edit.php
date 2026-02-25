<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

// if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !array_key_exists('id', $_GET)) {
//     die("<p>Error: No book ID provided.</p>");
// }
// $id = $_GET['id'];

// try {
//     $book = Book::findById($id);
//     if ($book === null) {
//         die("<p>Error: Book not found.</p>");
//     }
// } 
// catch (PDOException $e) {
//     setFlashMessage('error', 'Error: ' . $e->getMessage());
//     redirect('/index.php');
// }

startSession();

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method.');
    }
    if (!array_key_exists('id', $_GET)) {
        throw new Exception('No book ID provided.');
    }
    $id = $_GET['id'];

    $book = Book::findById($id);
    if ($book === null) {
        throw new Exception("Book not found.");
    }

    $bookPublishers = Publisher::findById($id);
    $bookPublishersIds = [];
    foreach ($bookPublishersIds as $publisher) {
        $bookPublishersIds[] = $publisher->id;
    }

    $formats = Format::findAll();
    $publisher = Publisher::findAll();
}
catch (PDOException $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>Edit Book</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>
            <div class="width-12">
                <h1>Edit Book</h1>
            </div>
            <div class="width-12">
                <form action="book_update.php" method="POST" enctype="multipart/form-data">
                    <div class="input">
                        <input type="hidden" name="id" value="<?= h($book->id) ?>">
                    </div>
                    <div class="input">
                        <label class="special" for="title">Title:</label>
                        <div>
                            <input type="text" id="title" name="title" value="<?= old('title', $book->title) ?>" required>
                            <p><?= error('title') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="release_date">Release Year:</label>
                        <div>
                            <input type="date" id="release_date" name="release_date" value="<?= old('release_date', $book->release_date) ?>" required>
                            <p><?= error('release_date') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="format_id">Format:</label>
                        <div>
                            <select id="format_id" name="format_id" required>
                                <?php foreach ($formats as $format) { ?>
                                    <option value="<?= h($format->id) ?>" <?= chosen('format_id', $format->id, $book->id) ? "selected" : "" ?>>
                                        <?= h($format->name) ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <p><?= error('format_id') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="description">Description:</label>
                        <div>
                            <textarea id="description" name="description" required><?= old('description', $book->description) ?></textarea>
                            <p><?= error('description') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special">Publishers:</label>
                        <div>
                            <?php foreach ($publisher as $publisher) { ?>
                                <div>
                                    <input type="checkbox" 
                                        id="publisher_<?= h($publisher->id) ?>" 
                                        name="publisher_ids[]" 
                                        value="<?= h($publisher->id) ?>"
                                        <?= chosen('publisher_ids', $publisher->id, $bookPublishersIds) ? "checked" : "" ?>
                                    >
                                    <label for="publisher_<?= h($publisher->id) ?>"><?= h($publisher->name) ?></label>
                                </div>
                            <?php } ?>
                        </div>
                        <p><?= error('publisher_ids') ?></p>
                    </div>
                    <div><img src="images/<?= $book->image_filename ?>" /></div>
                    <div class="input">
                        <label class="special" for="image">Image (optional):</label>
                        <div>
                            <input type="file" id="image" name="image" accept="image/*">
                            <p><?= error('image') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <button class="button" type="submit">Update Book</button>
                        <div class="button"><a href="index.php">Cancel</a></div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>