<?php
class Entity extends BasicObject {
	protected static function table_name() {
		return 'entities';
	}

	public function armor_protection() {
		return $this->armor % 10;
	}

	public function armor_str() {
		if($this->armor_type == 'natural') {
			return $this->armor;
		} else {
			return $this->armor . "/" . $this->armor_protection();
		}
	}

	public function hit($damage) {
		//TODO: Calculate armor and update, return damage done
	}

	public function life_percent() {
		$val = $this->life_remaining / $this->life;
		return round($val * 100.0);
	}
}
