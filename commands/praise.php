<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('(\^5|h5) (.*)', function (BotMan $bot, $highfive, $name) {
    $bot->randomReply([
        ':kissing_heart: ' . $name,
        ':star-struck: ' . $name,
        ':muscle: ' . $name,
        ':raised_hands: ' . $name,
        ':ok_hand: ' . $name,
        ':+1: ' . $name,
        ':clap: ' . $name,
        ':i_love_you_hand_sign: ' . $name,
        ':handshake: ' . $name,
        ':fist: ' . $name,
        ':hugging_face: ' . $name,
        ':heartpulse: ' . $name,
        ':awwyeah: ' . $name,
        ':heart: ' . $name,
        ':thumbsup_all: ' . $name,
        ':excellent: ' . $name,
        ':heart_eyes: ' . $name,
        ':kissing_closed_eyes: ' . $name,
    ]);
});

$botman->hears('peace {name}', function (BotMan $bot, $name) {
    $bot->reply(':spock-hand: ' . $name);
});

$botman->hears('sad {name}', function (BotMan $bot, $name) {
    $bot->reply(':sob: ' . $name);
});

$botman->hears('(.*) :\+1:(:.*:)?', function (BotMan $bot, $name, $color = null) {
    $bot->reply('keep doing great work ' . $name);
});

$botman->hears(':\+1:(:.*:)? (.*)', function (BotMan $bot, $color, $name) {
    $bot->reply('keep doing great work ' . $name);
});
