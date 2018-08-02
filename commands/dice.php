<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('{name} roll the dice', function (BotMan $bot, $name) {
    if ($name === '@UC1QKMCPR') {
        $bot->reply(random_int(1, 6));
    }
});
