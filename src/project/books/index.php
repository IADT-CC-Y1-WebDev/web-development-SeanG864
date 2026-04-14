<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';
require_once 'php/classes/DB.php';
require_once 'php/classes/Book.php';
 
 
try {
    $books = Book::findAll();
    $publishers = Publisher::findAll();
    $formats = Format::findAll();
 
}
catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}
 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
        .filters {
            padding: 0.75rem 1rem;
            border-radius: 6px;
            border: 1px solid #ccc;
            background: #f5f5f5;
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
        }
 
        .filters .input {
            display: flex;
            gap: 20px;
        }
 
        .filters .input label.filter-label {
            width: 108px;
            display: flex;
            justify-content: flex-end;
            color: #252525;
            font-weight: 900;
            font-size: 0.9rem;
        }
 
        .filters input,
        .filters select,
        .filters button {
            font-size: 0.9rem;
        }
 
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
 
        .card {
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid #ccc;
            background: #f5f5f5;
        }
 
        .card.hidden {
            display: none;
        }
 
        .card h3 {
            margin-top: 0;
            margin-bottom: 0.25rem;
        }
    </style>
        <?php include 'php/inc/head_content.php'; ?>
        <title>Books</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <?php require 'php/inc/flash_message.php'; ?>
                <div class="button">
                    <a href="book_create.php">Add New Book</a>
                </div>
            </div>
            <div class="width-12">
                <form id="form_filters" class="filters">
                    <div class="input">
                        <label class="filter-label" for="title_filter">Title:</label>
                        <div>
                            <input type="text" id="title_filter" name="title_filter" placeholder="Part of a title">
                        </div>
                    </div>
                    <div class="input">
                        <label class="filter-label" for="publisher_filter">Publisher:</label>
                        <div>
                            <select id="publisher_filter" name="publisher_filter">
                                <option value="">All publishers</option>
                                <?php foreach ($publishers as $publisher): ?>
                                    <option value="<?= htmlspecialchars($publisher->id) ?>">
                                        <?= htmlspecialchars($publisher->name) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="input">
                        <label class="filter-label" for="format_filter">Format:</label>
                        <div>
                            <select id="format_filter" name="format_filter">
                                <option value="">All formats</option>
                                <?php foreach ($formats as $format): ?>
                                    <option value="<?= htmlspecialchars($format->id) ?>">
                                        <?= htmlspecialchars($format->name) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="input">
                        <label class="filter-label" for="sort_by">Sort:</label>
                        <div>
                            <select id="sort_by" name="sort_by">
                                <option value="title_asc">Title A–Z</option>
                                <option value="year_desc">Year (newest first)</option>
                                <option value="year_asc">Year (oldest first)</option>
                            </select>
                        </div>
                    </div>
                    <div class="input">
                        <label class="filter-label" for="apply_filters">Actions</label>
                        <div>
                            <button type="button" id="apply_filters">Apply Filters</button>
                            <button type="button" id="clear_filters">Clear Filters</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container">
            <?php if (empty($books)) { ?>
                <p>No book found.</p>
            <?php } else { ?>
                <div id="book_cards" class="width-12 cards">
                    <?php foreach ($books as $book) {
                        $bookFormats = Format::findByBook($book->id);
                        $bookFormatIds = [];
                        foreach ($bookFormats as $format) {
                            $bookFormatIds[] = $format->id;
                        }
                        ?>
                        <div class="card"
                            data-title="<?= htmlspecialchars($book->title) ?>"
                            data-publisher="<?= htmlspecialchars($book->publisher_id) ?>"
                            data-format="<?= implode(" ", $bookFormatIds) ?>"
                            data-year="<?= htmlspecialchars($book->year) ?>">
 
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
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
 
        <script src="./js/book_filters.js"></script>
    </body>
</html>