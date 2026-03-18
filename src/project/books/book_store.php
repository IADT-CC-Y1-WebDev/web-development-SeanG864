<?php
require_once './php/lib/config.php';
require_once './php/lib/session.php';
require_once './php/lib/forms.php';
require_once './php/lib/utils.php';
 
$data = [];
$errors = [];
 
// Start the session
startSession();
 
try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }
 
    $data = [
        'title' => $_POST['title'] ?? null,
        'author' => $_POST['author'] ?? null,
        'publisher_id' => $_POST['publisher_id'] ?? null,
        'year' => $_POST['year'] ?? null,
        'isbn' => $_POST['isbn'] ?? null,
        'format_ids' => $_POST['format_ids'] ?? [],
        'description' => $_POST['description'] ?? null,
        'cover' => $_FILES['cover'] ?? null
    ];
 
    $year = date("Y");
 
    $rules = [
        'title' => "required|nonempty|min:5|max:255",
        'author' => "required|nonempty|min:5|max:255",
        'publisher_id' => "required|nonempty|integer",
        'year' => "required|nonempty|integer|minvalue:1900|maxvalue:" . $year,
        'isbn' => "required|nonempty|min:13|max:13",
        'format_ids' => "required|nonempty|array|min:1|max:4",
        'description' => "required|nonempty|min:10",
        'cover' => 'required|file|image|mimies:jpg,jpeg,png|max_file_size:5242880'
    ];
 
     // Create validator and check for failures
    $validator = new Validator($data, $rules);
 
    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }
 
    $uploader = new ImageUpload();
    $imageFilename = $uploader->process($_FILES['cover']);

    $book = new Book($data);
    $book->cover_filename = $imageFilename;
    $book->save();

    // Create format associations
    if (!empty($data['format_ids']) && is_array($data['format_ids'])) {
        foreach ($data['format_ids'] as $formatId) {
            // Verify format exists before creating relationship
            if (Format::findById($formatId)) {
                BookFormat::create($book->id, $formatId);
            }
        }
    }
 
    clearFormData();
    clearFormErrors();
 
    setFlashMessage('success', 'Form validated successfully!');

    redirect('book_view.php?id=' . $book->id);
}
catch (Exception $e) {
     // Error - clean up uploaded image
    if (isset($imageFilename) && $imageFilename) {
        $uploader->deleteImage($imageFilename);
    }
    setFormErrors($errors);
    setFormData($data);

    setFlashMessage('error', 'Form validation failed!');

    redirect("book_create.php");   
}