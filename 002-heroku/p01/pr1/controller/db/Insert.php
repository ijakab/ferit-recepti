<?php
require __DIR__ . "./../DbHandler.php";

use Db\DbHandler;

$todoText = $_POST['todoText'];

$db = new DbHandler();
$db->insert("INSERT INTO todo(message) VALUES ('$todoText')");
