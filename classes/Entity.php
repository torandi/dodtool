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
		if($this->armor <= 0) return 0;
		return max(floor($this->armor / 10),1);
	}

	public function armor_str() {
		return $this->armor . " / " . $this->armor_protection();
	}

	public function hit($damage) {
		$damage_done = max($damage - $this->armor_protection(), 0);
		$this->armor -= $damage_done;
		$this->life_remaining -= $damage_done;
		if($this->armor < 0) $this->armor = 0;
		if($this->life_remaining < 0) $this->life_remaining = 0;
		return $damage_done;	
	}

	public function life_percent() {
		$val = $this->life_remaining / $this->life;
		return round($val * 100.0);
	}
}
