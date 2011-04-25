<?php 
include "core/main.inc.php";

$View= new View('all');

$Items = ItemModel::getAllItems();
$View->assign('Items', $Items);

$View->display();