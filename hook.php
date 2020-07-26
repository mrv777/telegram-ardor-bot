<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

$bot_api_key  = 'KEY';
$bot_username = 'USERNAME';

$mysql_credentials = [
   'host'     => 'localhost',
   'user'     => 'USER',
   'password' => 'PASSWORD',
   'database' => 'DB',
];

// Define all paths for your custom commands in this array (leave as empty array if not used)
$commands_paths = [
    __DIR__ . '/Commands/',
];

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Requests Limiter (tries to prevent reaching Telegram API limits)
    $telegram->enableLimiter();
    
    // Add commands paths containing your custom commands
    $telegram->addCommandsPaths($commands_paths);
    
    $telegram->enableAdmin(ADMIN_ID);
    
    //$telegram->enableMySql($mysql_credentials);

    // Handle telegram webhook request
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    //echo $e;
    // Log telegram errors
    Longman\TelegramBot\TelegramLog::error($e);
} catch (Longman\TelegramBot\Exception\TelegramLogException $e) {
    // Silence is golden!
    // Uncomment this to catch log initialisation errors
    //echo $e;
}
