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

    $reponse = $client->get('https://slack.com/api/users.list', [
        'query' => [
            'token' => getenv('SLACK_TOKEN')
        ]
    ]);

    $json = json_decode($reponse->getBody()->getContents(), true);

    $members = [];
    foreach ($json['members'] as $member) {
        if ($member['is_bot']) { continue; }

        $members[$member['id']] = $member['profile'];
    }

    $caught = array_rand($members, 1);

    betterReply($bot, 'und raus bist du <@' . $caught . '>');
});

$botman->hears('ene mene mühe', function (BotMan $bot) {
    betterReply($bot, '<@DCBJSUQ7P> steht auf Kühe!');
});
