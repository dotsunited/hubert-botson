<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('userinfo', function (BotMan $bot) {
    $bot->sendRequest('chat.postEphemeral', [
        'channel' => $bot->getMessage()->getRecipient(),
        'text' => sprintf(
            '%s %s (%s), id: %s',
            $bot->getUser()->getFirstName(),
            $bot->getUser()->getLastName(),
            $bot->getUser()->getUsername(),
            $bot->getUser()->getId()
        ),
        'user' => $bot->getUser()->getId(),
        'as_user' => true,
    ]);
});

