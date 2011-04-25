<?php 
include "core/main.inc.php";

if( !isset($_SESSION['logged_in']) ) {
  header("location: login.php");
  die();
}

$View = new View('admin');
$View->display();