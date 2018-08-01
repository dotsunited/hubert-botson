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

function loadCommands($commandDir) {
    $files = scandir($commandDir, SCANDIR_SORT_ASCENDING);

    foreach ($files as $file) {
        if (is_file($commandDir . '/' . $file)) {
            require $commandDir . '/' . $file;
        }
    }
}
