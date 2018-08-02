<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('time', function (BotMan $bot) {
    $date = new DateTime('now', new DateTimeZone('Europe/Berlin'));
    $bot->reply($date->format('l, d. F Y (W. \C\W) H:i:s'));
});

$botman->hears('debug (.*)', function (BotMan $bot) {
    $bot->reply(json_encode($bot->getMessage()->getPayload()));
});

