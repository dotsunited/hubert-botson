<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('help', function (BotMan $bot) {
    $reply = <<<EOD
echo {text} - echos given text
help - prints this help
time|today|now - prints current time
tell me a joke - tells you a joke
tell me a fred - tells you a fred joke
h5 {name} - give {name} a positive reaction
peace {name} - Dif-tor heh smusma {name} / live long and prosper {name}
sad {name} - give {name} a sad reaction
{name} :+1: - give {name} a positive reaction
:+1: {name} - give {name} a positive reaction
userinfo - give you some information about you
EOD;

    $bot->reply($reply);
});
