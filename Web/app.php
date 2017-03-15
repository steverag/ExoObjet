<?php

include '../Lib/autoload.php';

use Lib\FrontEnd;

session_start();
$app = new FrontEnd();

$app->run();


