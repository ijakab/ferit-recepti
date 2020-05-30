<?php

include_once 'env.php'; // include instead of require as the file might not be present, but env variables could be inserted to project through parent process or cloud service etc.
require_once 'database.php';

$connection = new Database();
$connection->Connect();

?>