<?php

function loadConfigs($configDir) {
    $files = scandir($configDir, SCANDIR_SORT_ASCENDING);

    $config = [];
    foreach ($files as $file) {
        if (is_file($configDir . '/' . $file)) {
            $name = substr($file, 0, strpos($file, '.'));
            $config[$name] = include $configDir . '/' . $file;
        }
    }

    return $config;
}

function loadCommands(&$botman, $commandDir) {
    $files = scandir($commandDir, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        if (is_file($commandDir . '/' . $file)) {
            require $commandDir . '/' . $file;
        }
    }
}

function betterReply(\BotMan\BotMan\BotMan $botMan, $message, array $additionalParameters = [])
{
    $thread = $botMan->getMessage()->getPayload()['thread_ts'] ?? null;

    $payload = [];
    if ($thread) {
        $payload['thread_ts'] = $thread;
    }

    $botMan->reply($message, array_merge($additionalParameters, $payload));
}

function betterSendRequest(\BotMan\BotMan\BotMan $botMan, $endpoint, array $additionalParameters = [])
{
    $thread = $botMan->getMessage()->getPayload()['thread_ts'] ?? null;

    $payload = [];
    if ($thread) {
        $payload['thread_ts'] = $thread;
    }

    $botMan->sendRequest($endpoint, array_merge($additionalParameters, $payload));
}
