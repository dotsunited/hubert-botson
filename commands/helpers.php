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

$botman->hears('^lookup ((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))$', function (BotMan $bot, $ip) {
    $client = new Client();

    $response = $client->get(sprintf('https://ipapi.co/%s/json', $ip));

    $object = json_decode($response->getBody()->getContents(), true);

    if (isset($object['reserved']) && true === $object['reserved']) {
        betterReply($bot, sprintf('IP %s: reserved', $ip));
    } else {
        betterReply($bot, sprintf(
            'IP %s: %s %s, %s, %s - Coordinates: %s|%s (%s)',
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

$botman->hears('up (.*)', function (BotMan $bot, $domain) {
    if (!filter_var($domain, FILTER_VALIDATE_URL)) {
        betterReply($bot, $domain . ' is not a valid URL!');
    }

    $client = new Client();

    try {
        $response = $client->head($domain, [
            'timeout' => 10
        ]);

        betterReply($bot, $domain . ' responded with status code ' . $response->getStatusCode());
        return;

    } catch (\GuzzleHttp\Exception\RequestException $exception) {
        betterReply($bot,$domain . ' is not up!');
        return;
    }
});
