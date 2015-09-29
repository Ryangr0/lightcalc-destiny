<?php
		
	class Character
	{

	    public $inventory;
		public $cId;
		public $lightLevel;
		public $baseLevel;
		public $emblem;
		public $bg;
		public $mt;
		public $mid;
		public $cls;
		public $race;
		public $sex;
		
		public $hashes = [
	        '3159615086' => 'Glimmer',
	        '1415355184' => 'Crucible Marks',
	        '1415355173' => 'Vanguard Marks',
	        '898834093'  => 'Exo',
	        '3887404748' => 'Human',
	        '2803282938' => 'Awoken',
	        '3111576190' => 'Male',
	        '2204441813' => 'Female',
	        '671679327'  => 'Hunter',
	        '3655393761' => 'Titan',
	        '2271682572' => 'Warlock',
	        '3871980777' => 'New Monarchy',
	        '529303302'  => 'Cryptarch',
	        '2161005788' => 'Iron Banner',
	        '452808717'  => 'Queen',
	        '3233510749' => 'Vanguard',
	        '1357277120' => 'Crucible',
	        '2778795080' => 'Dead Orbit',
	        '1424722124' => 'Future War Cult',
	        '2033897742' => 'Weekly Vanguard Marks',
	        '2033897755' => 'Weekly Crucible Marks',
		];
		
	    public function __construct($mType, $mId, $id, $ll, $bl, $em, $bg, $rh, $sh, $ch)
	    {
		    $this->mt = $mType;
		    $this->mid = $mId;
	        $this->cId = $id;
	        $this->lightLevel = $ll;
	        $this->baseLevel = $bl;
	        $this->emblem = $em;
	        $this->bg = $bg;
	        $this->cls = $this->hashes[$ch];
	        $this->race = $this->hashes[$rh];
	        $this->sex = $this->hashes[$sh];
	    }

		
	    public static function getInventory($cid, $mt, $mid)
	    {
		    
			$url = 'http://bungie.net/Platform/Destiny/' . $cid . '/Account/' . $mt . '/Character/' . $mid . '/Inventory?definitions=true';
			$r = json_decode(getData('http://bungie.net/Platform/Destiny/' . $mt . '/Account/' . $mid . '/Character/' . $cid . '/Inventory?definitions=true'));
			
	        $e = $r->Response->data->buckets->Equippable;
			$d = $r->Response->definitions;
			$i = 0;
			$j = 0;
			$items = array();

			while ($i < count($e)) {
				if ( $i >= 1 && $i <= 10 ) {			
					$ih = $e[$i]->items[0]->itemHash;
					$name = $d->items->$ih->itemName;
					$val = $e[$i]->items[0]->primaryStat->value;
					$icon = $d->items->$ih->icon;
					$items[$j] = new Item($ih, $name, $val, $icon);
					$j++;
					$i++;
				}
				
				else {
					$i++;
				}	
				
			}	
			
			return $items;		
		}		
	}