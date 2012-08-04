<?php
class Entity extends BasicObject {
	protected static function table_name() {
		return 'entities';
	}

	protected static function default_order() {
		return 'life_remaining/life desc, id desc';
	}

	public function dead() {
		return $this->life_remaining == 0;
	}

	public function armor_protection() {
		return floor($this->armor / 10);
	}

	public function armor_str() {
		if($this->armor_type == 'natural') {
			return $this->armor;
		} else {
			return $this->armor . " / " . $this->armor_protection();
		}
	}

	public function hit($damage) {
		if($damage > $this->armor_protection()) {
			
		}
	}

	public function life_percent() {
		$val = $this->life_remaining / $this->life;
		return round($val * 100.0);
	}
}
