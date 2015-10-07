<?php
	
	function getData($url) {
		
		$context = stream_context_create(array('http' => array('header' => 'X-API-Key: ')));
		
		$res = file_get_contents($url, false, $context);
		return $res;

	}
