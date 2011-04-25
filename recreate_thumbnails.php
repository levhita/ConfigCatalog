<?php 
include "core/main.inc.php";

if( !isset($_SESSION['logged_in']) ) {
  header("location: login.php");
  die();
}

$results = shell_exec("./process_images.sh");

$View = new View('recreate_thumbnails');
$View->assign('results', $results);
$View->display();