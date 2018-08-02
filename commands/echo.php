<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('^echo (.*)', function (BotMan $bot, $echo) {
   $bot->reply($echo);
});
