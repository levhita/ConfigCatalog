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

$Item = new ItemModel($id);
$Item->saveContent($content);

header("location:edit.php?id={$Item->id}&saved=true");