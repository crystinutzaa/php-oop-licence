<?php

session_start();

require_once(__DIR__ . '/vendor/autoload.php');

$config = require(__DIR__ . '/config/config.php');
$app = \app\components\Application::getInstance($config);
$app->run();
