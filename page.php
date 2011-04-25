<?php 
include "core/main.inc.php";

$View= new View('page');

if ( !isset($_GET['page']) || empty($_GET['page']) ) {
  header("location:$Config->system_home");
}

$page = $_GET['page'];

try {
  $View->setTemplate(TO_ROOT . "/pages/$page.phtml", true);
} catch (Exception $e) {
  Logger::log('Missing Page', $page, LOGGER_ERROR);
  header("location:$Config->system_home");
}

$View->display();