<?php

require 'functions.php';
//require 'router.php';

require 'Database.php';
$config = require'config.php';

$db = new Database($config['db_config']);
$id = $_GET['id'];
$chirps = $db->query('select * from chirps where id = :id;', ['id' => $id])->fetchAll();

dd($chirps);