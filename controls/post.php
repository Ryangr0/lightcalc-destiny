<?php
	
	/*
		
		Type:
		
			0: views
			1: gt search
			2: character select
			3: light calculation
			4: infusion calculation
			
		Acct:
			
			0: no acct
			1: XBL
			2: PSN	
		
	*/

	include_once('../classes/database.php');
	include_once('../classes/details.php');
	
	
	$type = $_GET['type'];
	
	if ( isset($_POST['acct']) ) {
		$acct = $_POST['acct'];
	}
	
	else {
		$acct = 0;
	}
	
	if ( isset($_POST['gt']) ) {
		$gt = $_POST['gt'];
	}
	
	else {
		$gt = "";
	}
	
	Details::insert($type, $acct, $gt);
	echo json_encode(array('status' => true));
