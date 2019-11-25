<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('.*transitioned.*a.*from.*⟶(.*)', function (BotMan $bot, $status) {
    $payload = $bot->getMessage()->getPayload();
    betterReply($bot, "Message recognized");
    betterReply($bot, $payload);
    betterReply($bot, $status);
/*    if ('BBYVB4RK4' !== $payload['bot_id']) {
        betterReply($bot, "Invalid id: " . $payload['bot_id']);
        return;
    }*/

    if (!in_array($status, ['Done', 'Resolved'])) {
        betterReply($bot, "No status recognized: " . $status);
        return;
    }

    $title = reset($payload['attachments'])['title'];
    if (false !== preg_match('/^([A-Z]+-([\d]+))/', $title, $matches)) {
        betterReply($bot, "Matches: " . $matches);
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

    betterReply($bot, "Celebrate: " . $celebrate);

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
