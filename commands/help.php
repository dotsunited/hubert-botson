<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('help', function (BotMan $bot) {
    $bot->sendRequest('chat.postMessage', [
        'channel' => $bot->getMessage()->getRecipient(),
        'attachments' => [
            [
                'color' => '',
                'title' => 'Hubert Botson Commands',
                'fields' => [
                    [
                        'title' => 'Echo',
                        'value' => 'echo {text} - echos the given text',
                    ],
                    [
                        'title' => 'Help',
                        'value' => 'help - displays this help',
                    ],
                    [
                        'title' => 'Helpers',
                        'value' => 'time|today|now - displays current time'
                    ],
                    [
                        'title' => 'Jokes',
                        'value' => <<<EOD
tell me a joke - tells you a joke
tell me a fred - tells you a joke with fred
EOD
                    ],
                    [
                        'title' => 'Praise',
                        'value' => <<<EOD
h5 {name} - gives positive reaction to {name}
peace {name} - dif-tor heh smusma {name} / live long and prosper {name}
sad {name} - gives sad reaction to {name}
{name} :+1: - gives positive reaction to {name}
:+1: {name} - gives positive reaction to {name}
EOD
                    ],
                    [
                        'title' => 'User',
                        'value' => 'userinfo - gives you some information about yourself'
                    ]
                ]
            ]
        ],
        'user' => $bot->getUser()->getId(),
        'as_user' => true,
    ]);
});
