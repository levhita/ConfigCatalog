<?php 
include "core/main.inc.php";

if( !isset($_SESSION['logged_in']) ) {
  header("location: login.php");
  die();
}

$message = (!isset($_GET['message']))?false:$_GET['message'];

if ( !isset($_GET['id']) || empty($_GET['id']) ) {
  header("location:$Config->system_home");
}
$id = $_GET['id'];

$View = new View('edit');

$file_content = file_get_contents("items/$id.ini");

$View->assign('file_content', $file_content);
$View->assign('id', $id);
$View->assign('message', $message);

$View->display();