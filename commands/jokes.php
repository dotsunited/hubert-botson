<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('tell me a joke', function (BotMan $bot) {
    $response = file_get_contents('http://api.icndb.com/jokes/random');
    $object = json_decode($response);

    $bot->reply($object->value->joke);
});

$botman->hears('tell me a fred', function (BotMan $bot) {
    $response = file_get_contents('http://api.icndb.com/jokes/random');
    $object = json_decode($response);

    $bot->reply(str_replace('Chuck Norris', 'Fred', $object->value->joke));
});

$botman->hears('.*\b(Essen|essen)\b.*', function (BotMan $bot, $name) {
    $bot->reply(':chompy: :pizza:');
});
