<?php 
include "core/main.inc.php";

$View= new View('view');

if ( !isset($_GET['item']) || empty($_GET['item']) ) {
  header("location:$Config->system_home");
}

$file_name = "items/{$_GET['item']}.ini";
$Item = new ItemModel($file_name);

$View->assign('Item', $Item);

$View->display();