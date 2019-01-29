<?php

use BotMan\BotMan\BotMan;
use GuzzleHttp\Client;

/** @var $botman BotMan */
$botman->hears('tell me a joke', function (BotMan $bot, $param) {
    $apis = [
        [
            'url' => 'http://api.icndb.com/jokes/random',
            'extract' => ['value', 'joke']
        ],
        [
            'url' => 'https://icanhazdadjoke.com/',
            'options' => [
                'headers' => [
                    'accept' => 'application/json',
                ]
            ],
            'extract' => ['joke']
        ],
    ];

    $api = $apis[array_rand($apis, 1)];

    $client = new Client();

    $response = $client->get($api['url'], $api['options'] ?? []);

    $object = json_decode($response->getBody()->getContents());

    $joke = $object;
    foreach ($api['extract'] as $value) {
        $joke = $joke->$value;
    }

    betterReply($bot, htmlspecialchars_decode($joke));
});
