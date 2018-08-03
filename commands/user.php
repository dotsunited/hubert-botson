<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('userinfo', function (BotMan $bot) {
    $bot->sendRequest('chat.postEphemeral', [
        'text' => sprintf(
            'Userinfo: #%s - %s %s - @%s',
            $bot->getUser()->getId(),
            $bot->getUser()->getFirstName(),
            $bot->getUser()->getLastName(),
            $bot->getUser()->getUsername()
        )
    ]);
});

