<?php

require_once '../start.php';

if(!$_GET['id']) {
    throw new Exception('No id provided');
    exit(400);
}

$catRepository->delete($_GET['id']);

header("Location: /");

?>