<?php

include '../Lib/autoload.php';

use Lib\BackEnd;

session_start();
$app = new BackEnd();

$app->run();


