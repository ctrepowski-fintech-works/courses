<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$notes = $db->query('select * from notes where user_id = 1;')->findAll();

view('notes/index.view.php', [
    'heading' => 'Notes',
    'notes' => $notes,
]);