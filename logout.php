<?php 
include "core/main.inc.php";

$_SESSION = array();
session_destroy();

header("location:admin.php");
