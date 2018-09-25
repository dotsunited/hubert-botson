<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('.*\b(Essen|essen)\b.*', function (BotMan $bot) {
    betterReply($bot, ':chompy: :pizza:');
});

$botman->hears('order ([^ ]+)( [^ ]+)?( \<http[^ ]+\>)?', function (BotMan $bot, $restaurant, $user = null, $link = null) {
    $reply = '<!here> wir bestellen bei ' . $restaurant . '. Wer möchte mitbestellen? ';

    if ($user) {
        $reply .= 'Bestellung an ' . trim($user) . '. ';
    }

    if ($link) {
        $reply .= '(' . trim($link) . ')';
    }

    betterReply($bot, $reply);
});
