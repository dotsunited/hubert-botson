<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('.*transitioned.*a.*from.*⟶.*(Done|Resolved)', function (BotMan $bot, $status) {
    $payload = $bot->getMessage()->getPayload();
    if ('BBYVB4RK4' !== $payload['bot_id']) {
        return;
    }

    $title = $payload['text'];
    if (false !== preg_match('/([A-Z]+-([\d]+))/', $title, $matches)) {
        [,, $issueId] = $matches;
    } else {
        return;
    }

    $bot->reply($status, $issueId);

    $files = scandir(__DIR__ . '/../assets/celebrate-jira-issues', SCANDIR_SORT_ASCENDING);

    $celebrate = false;
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        if ($issueId . '.gif' === $file) {
            $celebrate = $issueId;
            break;
        }
    }

    if (false !== $celebrate) {
        $bot->sendRequest('chat.postMessage', [
            'channel' => $bot->getMessage()->getRecipient(),
            'as_user' => true,
            'attachments' => json_encode([
                [
                    'title' => 'Let\'s celebrate!',
                    'image_url' => 'https://' . $_SERVER['HTTP_HOST'] . '/assets/celebrate-jira-issues/' . $celebrate . '.gif'
                ]
            ]),
        ]);
    }
});
