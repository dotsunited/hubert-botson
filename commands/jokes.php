<?php

use BotMan\BotMan\BotMan;
use GuzzleHttp\Client;

/** @var $botman BotMan */
$botman->hears('tell me a joke', function (BotMan $bot) {
    $apis = [
        [
            'url' => 'http://api.icndb.com/jokes/random',
            'extract' => ['value', 'joke']
        ],
        [
            'url' => 'https://icanhazdadjoke.com/',
            'options' => [
                'headers' => [
                    'Accept' => 'application/json',
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

$botman->hears('ene mene muh', function (BotMan $bot) {
    $client = new Client();

    $response = $client->get('https://slack.com/api/conversations.members', [
        'query' => [
            'token' => getenv('SLACK_TOKEN'),
            'channel' => 'C03DDHLD4'
        ]
    ]);

    $json = json_decode($response->getBody()->getContents(), true);

    $users = $json['members'];

    $caught = array_rand($users, 1);

    betterReply($bot, 'und raus bist du <@' . $users[$caught] . '>');
});

$botman->hears('ene mene mühe', function (BotMan $bot) {
    $client = new Client();

    $response = $client->get('https://slack.com/api/conversations.members', [
        'query' => [
            'token' => getenv('SLACK_TOKEN'),
            'channel' => 'C03DDHLD4'
        ]
    ]);

    $json = json_decode($response->getBody()->getContents(), true);

    $users = $json['members'];

    $caught = array_rand($users, 1);

    betterReply($bot, '<@' .  $users[$caught] . '> steht auf Kühe!');
});
