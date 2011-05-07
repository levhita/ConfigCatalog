<?php 
include "core/main.inc.php";

if( !isset($_SESSION['logged_in']) ) {
  header("location: login.php");
  die();
}

$items = Utils::preg_ls('items/', false, "/.*\.ini/i");
$configs = array();
foreach($items AS $file_name) {
  $id = substr(basename($file_name), 0, -4);
  try {
    $Item = new ItemModel($id);
    $configs[$id] = $Item; 
  } catch(Exception $e){
    @parse_ini_file($file_name);
    $error = error_get_last();
    $configs[$id] = $error['message']; 
  }
}

$View = new View('admin');
$View->assign('configs', $configs);

$View->display();