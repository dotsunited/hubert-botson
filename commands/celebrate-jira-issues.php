<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('(.*)', function (BotMan $bot, $pattern) {
    if ('Jira Cloud' === $bot->getUser()->getUsername()) {
        $payload = $bot->getMessage()->getPayload();

        $title = reset($payload['attachments'])['title'];
        $issueId = 0;
        if (false !== preg_match('/^([A-Z]+-([0-9]+))/', $title, $matches)) {
            list(,, $issueId) = $matches;
            $bot->reply($issueId);
        } else {
            $bot->reply($title);
        }

        $text = reset($payload['attachments'])['text'];
        if (false !== preg_match('/^\*.*\* transitioned a `.*` from `.*` to `(.*)`/', $text, $matches)) {
            $status = $matches[1];

            if (!in_array($status, ['Done', 'Resolved'])) {
                return;
            }
        } else {
            $bot->reply($text);
        }

        $bot->reply($payload['attachments']);

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
