<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('{name} roll the dice', function (BotMan $bot, $name) {
    $bot->reply(mb_strtolower(str_rot13($name)));
});
