<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('.*\b(Essen|essen)\b.*', function (BotMan $bot) {
    $bot->reply(':chompy: :pizza:');
});

$botman->hears('order at (.*) (.*)? (http.*)?', function (BotMan $bot, $restaurant, $user, $link) {
    $reply = '@here bestellen bei ' . $restaurant . '. ';

    if ($user) {
        $reply .= 'Bestellung an ' . $user;
    }

    if ($link) {
        $reply .= ' (' . $link . ')';
    }

    $bot->reply($reply);
});
