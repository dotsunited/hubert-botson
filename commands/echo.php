<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('echo (.*)', function (BotMan $bot, $echo) {
    betterReply($bot, $echo);
});
