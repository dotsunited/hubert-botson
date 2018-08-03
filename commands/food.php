<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('.*\b(Essen|essen)\b.*', function (BotMan $bot) {
    $bot->reply(':chompy: :pizza:');
});

$botman->hears('order (.*) ?(.*)? ?(http.*)?', function (BotMan $bot, $restaurant, $user, $link) {
    $reply = '@here wir bestellen bei ' . $restaurant . '. Wer möchte mitbestellen?';

    if ($user) {
        $reply .= 'Bestellung an ' . $user . '. ';
    }

    if ($link) {
        $reply .= '(' . $link . ')';
    }

    $bot->reply($reply);
});
