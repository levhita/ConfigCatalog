<?php 
include "core/main.inc.php";

if ( !isset($_POST['password']) || empty($_POST['password']) ) {
  Logger::log('Empty Password');
  header("location:login.php");
  die();
}

$password = $_POST['password'];

if (sha1($password) !== $Config->system_password) {
  Logger::log('Bad Password', $password);
  header("location:login.php");
  die();

}
$_SESSION['logged_in'] = true; 
header("location:admin.php");
