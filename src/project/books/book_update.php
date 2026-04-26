<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();

try {
    
    $data = [];
    $errors = [];
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'id' => $_POST['id'] ?? null,
        'title' => $_POST['title'] ?? null,
        'year' => $_POST['year'] ?? null,
        'isbn' => $_POST['isbn'] ?? null,
        'author' => $_POST['author'] ?? null,
        'publisher_id' => $_POST['publisher_id'] ?? null,
        'description' => $_POST['description'] ?? null,
        'format_ids' => $_POST['format_ids'] ?? [],
        'cover_filename' => $_FILES['cover_filename'] ?? null
    ];

    $rules = [
        'id' => 'required|integer',
        'title' => 'required|notempty|min:1|max:255',
        'year' => 'required|notempty',
        'isbn' => 'required|notempty|min:1|max:17',
        'author' => 'required|notempty|min:1|max:125',
        'publisher_id' => 'required|integer',
        'description' => 'required|notempty|min:10|max:5000',
        'format_ids' => 'required|array|min:1|max:10',
        'cover_filename' => 'file|image|mimes:jpg,jpeg,png|max_file_size:5242880' // optional -- no required rule
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }

        throw new Exception('Validation failed.');
    }

    $book = Book::findById($data['id']);
    if (!$book) {
        throw new Exception('Book not found.');
    }

    $publisher = Publisher::findById($data['publisher_id']);
    if (!$publisher) {
        throw new Exception('Selected publisher does not exist.');
    }

    foreach ($data['format_ids'] as $formatId) {
        if (!Format::findById($formatId)) {
            throw new Exception('One or more selected formats do not exist.');
        }
    }

    $imageFilename = null;
    $uploader = new ImageUpload();
    if ($uploader->hasFile('cover_filename')) {
        $uploader->deleteImage($book->cover_filename);
        $imageFilename = $uploader->process($_FILES['cover_filename']);
        if (!$imageFilename) {
            throw new Exception('Failed to process and save the image.');
        }
    }
    
    $book->title = $data['title'];
    $book->year = $data['year'];
    $book->isbn = $data['isbn'];
    $book->author = $data['author'];
    $book->publisher_id = $data['publisher_id'];
    $book->description = $data['description'];
    if ($imageFilename) {
        $book->cover_filename = $imageFilename;
    }

    $book->save();

    BookFormat::deleteByBook($book->id);
    if (!empty($data['format_ids']) && is_array($data['format_ids'])) {
        foreach ($data['format_ids'] as $formatId) {
            BookFormat::create($book->id, $formatId);
        }
    }

    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Book updated successfully.');

    redirect('book_view.php?id=' . $book->id);
}
catch (Exception $e) {
    if ($imageFilename) {
        $uploader->deleteImage($imageFilename);
    }

    setFlashMessage('error', 'Error: ' . $e->getMessage());

    setFormData($data);
    setFormErrors($errors);

    if (isset($data['id']) && $data['id']) {
        redirect('book_edit.php?id=' . $data['id']);
    }
    else {
        redirect('index.php');
    }
}
