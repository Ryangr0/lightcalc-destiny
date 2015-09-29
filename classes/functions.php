<?php
	
	function getData($url) {
		
		$context = stream_context_create(array('http' => array('header' => 'X-API-Key: 57559c5a83f04bb08e874e783022caa3')));
		
		$res = file_get_contents($url, false, $context);
		return $res;

	}