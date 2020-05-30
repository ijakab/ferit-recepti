<?php

require '../start.php';

$winId = $_POST['wins'];
$lossId = $_POST['loss'];
if(!$winId || !$lossId) {
    throw new Exception('Send win and loss');
    exit(400);
}
$catRepository->applyFight($winId, $lossId);

?>