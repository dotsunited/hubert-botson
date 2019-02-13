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
    $user = getRandomUserID();

    betterReply($bot, 'und raus bist du <@' . $user . '>');
});

$botman->hears('ene mene mühe', function (BotMan $bot) {
    $user = getRandomUserID();

    betterReply($bot, '<@' .  $user . '> steht auf Kühe!');
});

function getRandomUserID()
{
    $client = new Client();

    $response = $client->get('https://slack.com/api/users.list', [
        'query' => [
            'token' => getenv('SLACK_TOKEN'),
        ]
    ]);

    $exclude = [
        'U03DDHLCN', // dotsunited
        'UBYRVK3DJ', // hubert
        'UBZ3ZM8MB', // jira
        'UBZTD8NP5', // weather hippie
        'UC03LP50V', // github
        'UC1QKMCPR', // hubert botman
        'UCKCZJZ36', // confluence
        'UD4NZQSJG', // tempo
        'UDRJW7HKJ', // sentry
        'UEEU600H1', // translate
        'USLACKBOT', // slackbot
    ];

    $json = json_decode($response->getBody()->getContents(), true);

    $users = $json['members'];

    foreach ($users as $key => $user) {
        if (in_array($user['id'], $exclude, true)) {
            unset($users[$key]);
        }
    }

    $caught = array_rand($users, 1);

    return $users[$caught]['id'];
}
