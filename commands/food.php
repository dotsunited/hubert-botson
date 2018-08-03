<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('.*\b(Essen|essen)\b.*', function (BotMan $bot) {
    $bot->reply(':chompy: :pizza:');
});

$botman->hears('order ([^ ]+)( [^ ]+)?( http[^ ]+)?', function (BotMan $bot, $matches) {
    $reply = '<!here> wir bestellen bei ' . $matches[1] . '. Wer möchte mitbestellen?';

    if ($matches[2]) {
        $reply .= 'Bestellung an ' . trim($matches[2]) . '. ';
    }

    if ($matches[3]) {
        $reply .= '(' . trim($matches[3]) . ')';
    }

    $bot->reply($reply);
});
