<?php

$heading = 'Notes';

$config = require('config.php');
$db = new Database($config['db_config']);

$note = $db->query('select * from notes where id = :note_id;', [
    'note_id' => $_GET['id']
])->fetch();

if (!$note) {
    abort();
}

$currentUserId = 1;

if ($note['user_id'] != $currentUserId) {
    abort(Response::FORBIDDEN);
}

require 'views/note.view.php';