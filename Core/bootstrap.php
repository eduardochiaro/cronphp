<?php
// Including global autoloader
require_once dirname(__FILE__) . '/autoload.php';

// Init config data
$config = array();

// Load config file
$configFile = dirname(__FILE__) . '/../Config/default.php';

if (is_readable($configFile)) {
    require_once $configFile;
}


// Only invoked if mode is "production"
$app->configureMode('production');
