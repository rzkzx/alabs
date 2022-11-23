<?php
// Load Config
require_once 'config/config.php';
// Load Helper
require_once 'helpers/Helpers.php';

// Autoload Core Libraries
spl_autoload_register(function ($className) {
  require_once 'libs/' . $className . '.php';
});

//Load Middleware
require_once 'libs/Middleware.php';
