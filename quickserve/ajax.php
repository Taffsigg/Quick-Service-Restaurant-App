<?php
session_start();
require "../devsiFiles/includes/functions.php";
$ajax= new Devsi();
if(isset($_POST['delCategory'])){
	$ajax->delDishCategory($_POST['delCategory']);
}elseif(isset($_POST['category']) && isset($_POST['id'])){
	$ajax->delMenuItem($_POST['category'],$_POST['id']);
}elseif(isset($_POST['toggle']) && isset($_POST['tid'])){
	$ajax->toggleStatusId($_POST['toggle'],$_POST['tid']);
}elseif(isset($_POST['welcome'])){
	$ajax->processWelcome($_POST['welcome']);
}elseif(isest($_POST['orders'])){
	$ajax->nOrders();
}elseif(isset($_POST['eorders'])){
	$ajax->eorders();
}
?>