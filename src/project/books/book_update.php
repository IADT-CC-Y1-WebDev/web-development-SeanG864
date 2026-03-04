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
        'release_date' => $_POST['release_date'] ?? null,
        'genre_id' => $_POST['genre_id'] ?? null,
        'description' => $_POST['description'] ?? null,
        'platform_ids' => $_POST['platform_ids'] ?? [],
        'image' => $_FILES['image'] ?? null
    ];

    $rules = [
        'id' => 'required|integer',
        'title' => 'required|notempty|min:1|max:255',
        'release_date' => 'required|notempty',
        'genre_id' => 'required|integer',
        'description' => 'required|notempty|min:10|max:5000',
        'platform_ids' => 'required|array|min:1|max:10',
        'image' => 'file|image|mimes:jpg,jpeg,png|max_file_size:5242880' // optional -- no required rule
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

    $genre = Genre::findById($data['genre_id']);
    if (!$genre) {
        throw new Exception('Selected genre does not exist.');
    }

    foreach ($data['platform_ids'] as $platformId) {
        if (!Platform::findById($platformId)) {
            throw new Exception('One or more selected platforms do not exist.');
        }
    }

    $imageFilename = null;
    $uploader = new ImageUpload();
    if ($uploader->hasFile('image')) {
        $uploader->deleteImage($book->image_filename);
        $imageFilename = $uploader->process($_FILES['image']);
        if (!$imageFilename) {
            throw new Exception('Failed to process and save the image.');
        }
    }
    
    $book->title = $data['title'];
    $book->release_date = $data['release_date'];
    $book->genre_id = $data['genre_id'];
    $book->description = $data['description'];
    if ($imageFilename) {
        $book->image_filename = $imageFilename;
    }

    $book->save();

    BookPlatform::deleteByBook($book->id);
    if (!empty($data['platform_ids']) && is_array($data['platform_ids'])) {
        foreach ($data['platform_ids'] as $platformId) {
            BookPlatform::create($book->id, $platformId);
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
