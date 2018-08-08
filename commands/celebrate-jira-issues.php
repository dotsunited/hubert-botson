<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('(.*)', function (BotMan $bot, $pattern) {
    $bot->reply(json_encode($bot->getMessage()->getPayload()));
});
