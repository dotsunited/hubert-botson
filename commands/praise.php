<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('^\^5 {name}', function (BotMan $bot, $name) {
    $bot->reply(':raised_hands: ' . $name);
});

$botman->hears('^h5 {name}', function (BotMan $bot, $name) {
    $bot->reply(':raised_hands: ' . $name);
});

$botman->hears('^you rock {name}', function (BotMan $bot, $name) {
    $bot->reply(':muscle: ' . $name);
});

$botman->hears('^nice {name}', function (BotMan $bot, $name) {
    $bot->reply(':+1: ' . $name);
});

$botman->hears('^gg {name}', function (BotMan $bot, $name) {
    $bot->reply(':ok_hand: ' . $name);
});
