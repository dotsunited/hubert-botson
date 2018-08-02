<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('^echo (.*)', function (BotMan $bot, $echo) {
   $bot->reply($echo);
});

$botman->on('message', function($payload, BotMan $bot) {
    if (1 === preg_match('/^echo (.*)/', $payload['event']['text'], $matches)) {
        $bot->say($matches[0], $payload['event']['channel'], \BotMan\Drivers\Slack\SlackDriver::class);
    }
});
