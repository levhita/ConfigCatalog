<?php
define( 'TO_ROOT', '.');

include "core/Autoloader.php";
Autoloader::registerAutoload();

$Config = Config::getInstance();

ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_lifetime', 0);
ini_set('short_open_tag', 1);
ini_set('default_charset', 'UTF-8');

header('Content-Type: text/html; charset=UTF-8');
