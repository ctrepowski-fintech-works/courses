<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->query('SELECT * FROM notes WHERE id = :note_id;', [
    'note_id' => $_POST['id']
])->findOrFail();

authorize($currentUserId === $note['user_id']);

$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1000 characters is required';
}

if (count($errors)) {
    view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note,
    ]);
    return;
}

$db->query('UPDATE notes SET body = :body WHERE id = :id;', [
    'id' => $_POST['id'],
    'body' => $_POST['body'],
]);

header('location: /notes');
die();