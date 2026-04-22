<?php

// Include the required library files
require_once './php/lib/config.php';
require_once './php/lib/session.php';
require_once './php/lib/forms.php';
require_once './php/lib/utils.php';

// Start the session
startSession();

try {
    $publishers = Publisher::findAll();
    $formats = Format::findAll();
}
catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './php/inc/head_content.php'; ?>
    <title>Add New Book - Exercise</title>
</head>
<body>
    <div class="container">
        <div class="width-12">
            <?php require './php/inc/flash_message.php'; ?>
        </div>
        <div class="width-12">
            <div class="back-link">
                <a href="index.php">&larr; Back </a>
            </div>
        </div>
        <div class="width-12">
            <h1>Add New Book</h1>
        </div>
        <div class="width-12">

            <?php // dd(getFormData()); ?>
            <?php // dd(getFormErrors()); ?>

            <form id="book_form" action="book_store.php" method="POST" enctype="multipart/form-data" novalidate>
                <div id="error_summary_top" class="error-summary" style="display:none" role="alert"></div>

                <div class="form-group">
                    <label for="title">Book Title:</label>
                    <input type="text" id="title" name="title" value="<?= h(old('title')) ?>">

                    <?php if (error('title')): ?>
                    <p id="title_error" class="error"><?= error('title') ?></p>
                    <?php endif; ?>

                </div>

                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" value="<?= h(old('author')) ?>">

                    <?php if (error('author')): ?>
                    <p id="author_error" class="error"><?= error('author') ?></p>
                    <?php endif; ?>

                </div>

                <div class="form-group">
                    <label for="publisher_id">Publisher:</label>
                    <select id="publisher_id" name="publisher_id">
                        <option value="">-- Select Publisher --</option>
                        <?php foreach ($publishers as $pub): ?>
                            <option value="<?= $pub->id ?>" 
                                <?= chosen('publisher_id', $pub->id) ? "selected" : "" ?>
                            >
                                <?= h($pub->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <?php if (error('publisher_id')): ?>
                    <p id="publisher_id_error" class="error"><?= error('publisher_id') ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="year">Year:</label>
                    <input type="text" id="year" name="year" value="<?= h(old('year')) ?>">

                    <?php if (error('year')): ?>
                    <p id="year_error" class="error"><?= error('year') ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <input type="text" id="isbn" name="isbn" value="<?= h(old('isbn')) ?>">

                    <?php if (error('isbn')): ?>
                    <p id="isbn_error" class="error"><?= error('isbn') ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Available Formats:</label>
                    <div class="checkbox-group">
                        <?php foreach ($formats as $format): ?>
                            <label class="checkbox-label">
                                <input type="checkbox" 
                                    name="format_ids[]" 
                                    value="<?= $format->id ?>"
                                    <?=chosen('format_ids', $format->id) ? "checked" : "" ?>
                                >
                                <?= h($format->name) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <?php if (error('format_ids')): ?>
                    <p id="format_ids_error" class="error"><?= error('format_ids') ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="5"><?= h(old('description')) ?></textarea>

                    <?php if (error('description')): ?>
                    <p id="description_error" class="error"><?= error('description') ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="cover">Book Cover Image (max 2MB):</label>
                    <input type="file" id="image" name="cover_filename" accept="cover_filename/*">

                    <?php if (error('cover_filename')): ?>
                    <p id="image_error" class="error"><?= error('cover_filename') ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <button id="submit_btn" type="submit" class="button">Save Book</button>
                </div>
            </form>

            <?php
            //   Clear form data and errors
            clearFormData();
            clearFormErrors();
            ?>
        </div>
        <script src="./js/validation.js"></script>
    </body>
</html>