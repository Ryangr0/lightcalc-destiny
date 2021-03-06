<?php
	
	require 'Player.php';
	require 'Character.php';
	require 'Item.php';
	require 'functions.php';
	
	class Destiny {
			
		public static function getPlayer($gt, $platform) {
			$url = 'http://www.bungie.net/Platform/Destiny/SearchDestinyPlayer/' . $platform . '/' . $gt;
			$r = json_decode(getData($url));

			$p =  new Player(
				$r->Response[0]->iconPath,
				$r->Response[0]->membershipType,
				$r->Response[0]->membershipId,
				$r->Response[0]->displayName
			);
			
			return $p;
		}
	}
	
	