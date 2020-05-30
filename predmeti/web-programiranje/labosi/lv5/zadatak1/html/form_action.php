<?php

require_once '../start.php';

if($_FILES['imageHolder'] && file_exists($_FILES['imageHolder']['tmp_name']) && is_uploaded_file($_FILES['imageHolder']['tmp_name'])) {
    $target_filename = time() . '.jpg';
    $target_file = "/var/www/html/img/" . $target_filename;

    // we could chat that file is actually image here
    move_uploaded_file($_FILES["imageHolder"]["tmp_name"], $target_file);
    $_POST['image'] = 'img/' . $target_filename; // not a best solution to add something that isn't in post request to post.. but to add it to other params
}

$catRepository->createOrUpdate($_POST);
header("Location: /");

?>