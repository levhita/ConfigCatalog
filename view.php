<?php 
include "core/main.inc.php";

$View= new View('view');

if ( !isset($_GET['id']) || empty($_GET['id']) ) {
  header("location:$Config->system_home");
}
$id = $_GET['id'];
$Item = new ItemModel($id);

$View->assign('page_name', $Item->name);
$View->assign('Item', $Item);

$View->display();