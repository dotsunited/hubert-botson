<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('tell me a (joke|fred)', function (BotMan $bot, $param) {
    $response = file_get_contents('http://api.icndb.com/jokes/random');
    $object = json_decode($response);

    switch (mb_strtolower($param)) {
        case 'fred':
            $joke = str_replace('Chuck Norris', 'Fred', $object->value->joke);
            break;
        default:
            $joke = $object->value->joke;
    }

    betterReply($bot, htmlspecialchars_decode($joke));
});
