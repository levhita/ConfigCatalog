<?php 
include "core/main.inc.php";

if( !isset($_SESSION['logged_in']) ) {
  header("location: login.php");
  die();
}

$saved = (!isset($_GET['saved']))?false:$_GET['saved'];

if ( !isset($_GET['id']) || empty($_GET['id']) ) {
  header("location:$Config->system_home");
}
$id = $_GET['id'];

$View = new View('edit');

$Item = new ItemModel($id);
$View->assign('Item', $Item);
$View->assign('saved', $saved);
$View->display();