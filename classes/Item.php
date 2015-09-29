<?php
	
	class Item {
		public $ih;
		public $name;
		public $val;
		public $icon;
		
		public function __construct($ih, $name, $val, $icon) {
			$this->ih = $ih;
			$this->name = $name;
			$this->val = $val;
			$this->icon = $icon;
		}
	}