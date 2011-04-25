<?php 
include "core/main.inc.php";

$View= new View('all');
$View->setPageTitle('Items');

$Items = ItemModel::getAllItems();
$View->assign('Items', $Items);

$Item = new ItemModel('items/gourmet.ini');

$View->display();