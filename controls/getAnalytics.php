<?php
	include_once('../classes/details.php');
	
	if ( $_GET['r'] == 'getCounts' ) {
		$response = array('t' => Details::getTotalCounts(), 'm' => Details::getMonthlyCounts(), 'w' => Details::getWeeklyCounts(), 'd' => Details::getDailyCounts());
		echo json_encode($response);
	}
	
	else if ( $_GET['r'] == 'getPlatformData' ) {
		$gtdata = Details::getAcctStats(1);
		$chardata = Details::getAcctStats(2);
		$lightdata = Details::getAcctStats(3);
		
		$response = array('gt' => $gtdata, 'char' => $chardata, 'light' => $lightdata);
		echo json_encode($response);
	}