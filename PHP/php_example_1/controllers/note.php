<?php

$heading = 'Notes';

$config = require('config.php');
$db = new Database($config['db_config']);
$currentUserId = 1;

$note = $db->query('select * from notes where id = :note_id;', [
    'note_id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] == $currentUserId);

require 'views/note.view.php';