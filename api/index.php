<?php

$temporaryPath = sys_get_temp_dir();

$defaults = [
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'false',
    'APP_CONFIG_CACHE' => $temporaryPath.'/config.php',
    'APP_EVENTS_CACHE' => $temporaryPath.'/events.php',
    'APP_PACKAGES_CACHE' => $temporaryPath.'/packages.php',
    'APP_ROUTES_CACHE' => $temporaryPath.'/routes.php',
    'APP_SERVICES_CACHE' => $temporaryPath.'/services.php',
    'CACHE_STORE' => 'array',
    'LOG_CHANNEL' => 'stderr',
    'QUEUE_CONNECTION' => 'sync',
    'SESSION_DRIVER' => 'cookie',
    'VIEW_COMPILED_PATH' => $temporaryPath.'/views',
];

foreach ($defaults as $key => $value) {
    if (getenv($key) === false) {
        putenv($key.'='.$value);
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

$compiledViewsPath = getenv('VIEW_COMPILED_PATH') ?: $temporaryPath.'/views';

if (! is_dir($compiledViewsPath)) {
    @mkdir($compiledViewsPath, 0777, true);
}

require __DIR__.'/../public/index.php';
