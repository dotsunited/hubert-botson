<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('/^\*.*\* transitioned a `.*` from `.*` to `(.*)`/', function (BotMan $bot, $status) {
    $payload = $bot->getMessage()->getPayload();
    if ('BBYVB4RK4' !== $payload['bot_id']) {
        return;
    }

    if (!in_array($status, ['Done', 'Resolved'])) {
        return;
    }

    $title = reset($payload['attachments'])['title'];
    if (false !== preg_match('/^([A-Z]+-([\d]+))/', $title, $matches)) {
        list(,, $issueId) = $matches;
    } else {
        return;
    }

    $bot->reply($status, $issueId);

//    $files = scandir(__DIR__ . '/../assets/celebrate-jira-issues', SCANDIR_SORT_ASCENDING);
//
//    $celebrate = false;
//    foreach ($files as $file) {
//        if ($file === '.' || $file === '..') {
//            continue;
//        }
//
//        if (false !== strpos($file, $issueId)) {
//            $celebrate = $issueId;
//            break;
//        }
//    }
//
//    if (false !== $celebrate) {
//        $bot->reply('CELEBRATE ISSUE!');
//    }
});
