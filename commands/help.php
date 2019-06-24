<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('help', function (BotMan $bot) {
    betterSendRequest($bot, 'chat.postMessage', [
        'channel' => $bot->getMessage()->getRecipient(),
        'as_user' => true,
        'attachments' => json_encode([
            [
                'color' => '',
                'title' => 'Hubert Botson Commands',
                'fields' => [
                    [
                        'title' => 'Echo',
                        'value' => 'echo {text} - echos the given text',
                    ],
                    [
                        'title' => 'Food',
                        'value' => 'order {restaurant} {purchaser?} {link?}  - asks @here who wants to purchase food in the given restaurant',
                    ],
                    [
                        'title' => 'Help',
                        'value' => 'help - displays this help',
                    ],
                    [
                        'title' => 'Helpers',
                        'value' => <<<EOD
time|today|now - displays current time
ping - returns pong
debug - returns message payload
lookup {ip} - gives information about the given ip
up {domain} - gives information about the domain response
EOD
                    ],
                    [
                        'title' => 'Jokes',
                        'value' => <<<EOD
tell me a joke - tells you a joke
ene mene muh - select one person from userlist
ene mene mühe - select one person from userlist
EOD
                    ],
                    [
                        'title' => 'Praise',
                        'value' => <<<EOD
h5 {name} - gives positive reaction to {name}
^5 {name} - gives positive reaction to {name}
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
        ]),
    ]);
});
