<?php

include_once 'env.php'; // include instead of require as the file might not be present, but env variables could be inserted to project through parent process or cloud service etc.
require_once 'database.php';
require_once 'cat.php';

$connection = new Database();
$connection->Connect();

$catRepository = new CatRepository($connection);
$catRepository->migrate();

?>