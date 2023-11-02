<?php

$action = $_GET['action'];

include 'user_class.php';

$crud = new Action();

if ($action == 'save_reserve') {
	$save = $crud->save_reserve();
	if ($save)
		echo $save;
}
