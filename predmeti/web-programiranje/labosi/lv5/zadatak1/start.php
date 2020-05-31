<?php

include_once 'env.php'; // include instead of require as the file might not be present, but env variables could be inserted to project through parent process or cloud service etc.
require_once 'database.php';

require_once 'entities/repository.interface.php';
require_once 'entities/cat.repository.php';
require_once 'entities/cat.view.php';

$connection = new Database();
$connection->Connect();

$catRepository = new Cat\CatRepository($connection);
$catRepository->migrate(); // to make it easier to use, we would not normally migrate like this, but through command or CI

$catView = new Cat\CatView($catRepository);

?>