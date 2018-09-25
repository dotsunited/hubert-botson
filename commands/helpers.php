<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('ping', function (BotMan $bot) {
    $bot->reply('pong');
});

$botman->hears('(time|today|now)', function (BotMan $bot) {
    $date = new DateTime('now', new DateTimeZone('Europe/Berlin'));
    $bot->reply($date->format('l, d. F Y (W. \C\W) H:i:s'));
});

$botman->hears('^debug$', function (BotMan $bot) {
    $payload = $bot->getMessage()->getPayload();
    betterReply($bot, json_encode($payload));
});
