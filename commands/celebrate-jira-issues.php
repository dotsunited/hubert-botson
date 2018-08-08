<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('/^\*.*\* transitioned a `.*` from `.*` to `(.*)`/', function (BotMan $bot, $status) {
    $bot->reply($status);

    if ('BBYVB4RK4' === $bot->getMessage()->getPayload()['bot_id']) {
        $payload = $bot->getMessage()->getPayload();

        $title = reset($payload['attachments'])['title'];
        if (false !== preg_match('/^([A-Z]+-([0-9]+))/', $title, $matches)) {
            list(,, $issueId) = $matches;
        } else {
            return;
        }

        $bot->reply($issueId);

        $bot->reply($status, $issueId);

        $files = scandir(__DIR__ . '/../assets/celebrate-jira-issues', SCANDIR_SORT_ASCENDING);

        $celebrate = false;
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            if (false !== strpos($file, $issueId)) {
                $celebrate = $issueId;
                break;
            }
        }

        if (false !== $celebrate) {
            $bot->reply('CELEBRATE ISSUE!');
        }
    } else {
        $bot->reply($bot->getUser()->getUsername());
    }
});
