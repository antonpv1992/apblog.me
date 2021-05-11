<?php
use tools\core\App;

error_reporting(-1);

require_once dirname(__DIR__) . '/config/init.php';
require_once LIBS . '/functions.php';
require_once CONF . '/routes.php';

new App();