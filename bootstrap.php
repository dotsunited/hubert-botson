<?php

use Dotenv\Dotenv;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\BotManFactory;

/**
 * Load Environment Variables
 */
$dotenv = new Dotenv(__DIR__);
$dotenv->load();

/**
 * Load Drivers
 */
DriverManager::loadDriver(\BotMan\Drivers\Slack\SlackDriver::class);

/**
 * Load Helper Functions
 */
require __DIR__ . '/functions.php';

/**
 * Load Configs
 */
$config = loadConfigs(__DIR__ . '/configs');

/**
 * Turn on the lights
 */
return BotManFactory::create($config);
