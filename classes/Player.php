<?php
		
	class Player {
		public $iconPath;
	    public $membershipType;
	    public $membershipId;
	    public $displayName;
	    public $characters;
	    
	    public function __construct($iconPath, $membershipType, $membershipId, $displayName)
	    {
	        $this->iconPath = $iconPath;
	        $this->membershipType = $membershipType;
	        $this->membershipId = $membershipId;
	        $this->displayName = $displayName;
	        $this->characters = $this->getCharacters();
	    }
	    
	    protected function getCharacters()
	    {
	        $url = 'http://bungie.net/Platform/Destiny/' . $this->membershipType . '/Account/' . $this->membershipId;
			$r = json_decode(getData($url));
			
	        if (count($r->Response->data->characters) < 1) {
		        return false;
	        }
	
	        foreach ($r->Response->data->characters as $character) {
		        $id = $character->characterBase->characterId;
				$ll = $character->characterBase->powerLevel;
				$em = $character->emblemPath;
				$bg = $character->backgroundPath;
				$bl = $character->baseCharacterLevel;
				$rh = $character->characterBase->raceHash;
				$sh = $character->characterBase->genderHash;
				$ch = $character->characterBase->classHash;
	            $characters[] = new Character($this->membershipType, $this->membershipId, $id, $ll, $bl, $em, $bg, $rh, $sh, $ch);
	        }
	
	        return $characters;
	    }
	}