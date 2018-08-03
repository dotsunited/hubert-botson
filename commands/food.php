<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('.*\b(Essen|essen)\b.*', function (BotMan $bot) {
    $bot->reply(':chompy: :pizza:');
});

$botman->hears('order ([^ ]+)( [^ ]+)?( http[^ ]+)?', function (BotMan $bot, $restaurant, $user, $link) {
    $reply = '<!here> wir bestellen bei ' . $restaurant . '. Wer möchte mitbestellen?';

    if (trim($user)) {
        $reply .= 'Bestellung an ' . trim($user) . '. ';
    }

    if (trim($link)) {
        $reply .= '(' . trim($link) . ')';
    }

    $bot->reply($reply);
});
