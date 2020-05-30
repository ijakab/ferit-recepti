<?php

// this file is commited so other devs could know how to build env.php. It is not actually used in code
$_ENV['DB_HOST'] = 'db'; // IF RUNNING BY docker-compose, MAKE SURE THIS IS A SAME NAME AS IN docker-compose.yml, NOT localhost
$_ENV['DB_NAME'] = 'GET_THIS';
$_ENV['DB_USER'] = 'GET_THIS';
$_ENV['DB_PASS'] = 'GET_THIS';

?>