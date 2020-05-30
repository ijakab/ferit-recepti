<?php

require_once '../start.php';

$catRepository->createOrUpdate($_POST);
header("Location: /");

?>