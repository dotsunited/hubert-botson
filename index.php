<?php

require __DIR__ . '/vendor/autoload.php';

/** @var \BotMan\BotMan\BotMan $botman */
$botman = require __DIR__ . '/bootstrap.php';

loadCommands(__DIR__ . '/commands');

$botman->listen();
