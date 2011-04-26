<?php 
include "core/main.inc.php";

if( !isset($_SESSION['logged_in']) ) {
  header("location: login.php");
  die();
}

if ( !isset($_POST['id']) || empty($_POST['id']) ) {
  header("location:$Config->system_home");
}
$id = $_POST['id'];

if ( !isset($_POST['content']) || empty($_POST['content']) ) {
  header("location:$Config->system_home");
}
$content = $_POST['content'];

$message="Saved";

$file_name="items/$id.ini";

if( file_put_contents($file_name, $content) === false ) {
  $message = "Couldn't save file";  
}

if ( parse_ini_file($file_name, true) === false ) {
  $error = error_get_last();
  $message = $error['message'];
}

header("location:edit.php?id={$id}&message=" . urlencode($message));