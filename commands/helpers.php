<?php

use BotMan\BotMan\BotMan;
use GuzzleHttp\Client;

/** @var $botman BotMan */
$botman->hears('ping', function (BotMan $bot) {
    betterReply($bot, 'pong');
});

$botman->hears('(time|today|now)', function (BotMan $bot) {
    $date = new DateTime('now', new DateTimeZone('Europe/Berlin'));
    betterReply($bot, $date->format('l, d. F Y (W. \C\W) H:i:s'));
});

$botman->hears('^debug$', function (BotMan $bot) {
    $payload = $bot->getMessage()->getPayload();
    betterReply($bot, json_encode($payload));
});

$botman->hears('^lookup ((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))$', function (BotMan $bot, $_, $ip) {
    $client = new Client();

    $response = $client->get(sprintf('https://ipapi.co/%s/json', $ip));

    $object = json_decode($response->getBody()->getContents(), true);

    if (isset($object['reserved']) && true === $object['reserved']) {
        betterReply($bot, sprintf('%s: reserved', $ip));
    } else {
        betterReply($bot, sprintf(
            '%s: %s %s, %s, %s - Coordinates: %s / %s (%s)',
            $ip,
            $object['postal'],
            $object['city'],
            $object['region'],
            $object['country_name'],
            $object['latitude'],
            $object['longitude'],
            $object['org']
        ));
    }
});
