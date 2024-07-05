<?php

$heading = 'Notes';

$config = require('config.php');
$db = new Database($config['db_config']);

$notes = $db->query('select * from notes where user_id = 1;')->findAll();

require 'views/notes.view.php';