<?php

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

if ($action == 'login') {
	$login = $crud->login();
	if ($login)
		echo $login;
}

if ($action == 'logout') {
	$logout = $crud->logout();
	if ($logout)
		echo $logout;
}

if ($action == 'save_movie') {
	$save = $crud->save_movie();
	if ($save)
		echo $save;
}

if ($action == 'delete_movie') {
	$delete = $crud->delete_movie();
	if ($delete)
		echo $delete;
}
