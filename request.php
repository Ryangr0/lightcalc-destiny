<?php	
	require 'c/Destiny.php';
	
	if ( $_GET['r'] == 'search' ) {
		$player = Destiny::getPlayer($_POST['gt'], $_POST['platform']);
		echo json_encode($player);
	}
	
	else if ( $_GET['r'] == 'inv' ) {
		$cid = $_POST['cid'];
		$mt = $_POST['mtype'];
		$mid = $_POST['mid'];
		$items = Character::getInventory($cid, $mt, $mid);		
		echo json_encode($items);
	}