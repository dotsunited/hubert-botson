<?php

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/verify.php';

/** @var \BotMan\BotMan\BotMan $botman */
$botman = require __DIR__ . '/bootstrap.php';

loadCommands($botman, __DIR__ . '/commands');

$botman->listen();
