<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->query('select * from notes where id = :note_id;', [
    'note_id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] == $currentUserId);

$note = $db->query('DELETE FROM notes WHERE id = :note_id', [
    ':note_id' => $_POST['id'],
]);

header('location: /notes');
die();
