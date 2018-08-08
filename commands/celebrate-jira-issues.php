<?php

use BotMan\BotMan\BotMan;

/** @var $botman BotMan */
$botman->hears('(.*)', function (BotMan $bot, $pattern) {
    if ('BBYVB4RK4' === $bot->getMessage()->getPayload()['bot_id']) {
        $payload = $bot->getMessage()->getPayload();

        $title = reset($payload['attachments'])['title'];
        if (false !== preg_match('/^([A-Z]+-([0-9]+))/', $title, $matches)) {
            list(,, $issueId) = $matches;
        } else {
            return;
        }

        $bot->reply($issueId);
        $bot->reply($payload['attachments'][0]);

        $text = reset($payload['attachments'])['pretext'];
        if (false !== preg_match('/^\*.*\* transitioned a `.*` from `.*` to `(.*)`/', $text, $matches)) {
            $status = $matches[1];

            $bot->reply($status);
            if (!in_array($status, ['Done', 'Resolved'])) {
                return;
            }
        } else {
            $bot->reply($text);
        }

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
