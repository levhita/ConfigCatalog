<?php 
include "core/main.inc.php";

$View= new View('test');
$View->assign('variable', $Config->test);
$View->setPageTitle('Tests');
$View->display();