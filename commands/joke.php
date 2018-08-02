<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('tell me a joke', function (BotMan $bot, $name) {
    $response = file_get_contents('http://api.icndb.com/jokes/random');
    $object = json_decode($response);

    $bot->reply($object->value->joke);
});
