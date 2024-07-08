<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;

$note = $db->query('select * from notes where id = :note_id;', [
    'note_id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] == $currentUserId);

view('notes/show.view.php', [
    'heading' => 'Notes',
    'note' => $note,
]);
