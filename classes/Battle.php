<?php
class Battle extends BasicObject {
	protected static function default_order() {
		return 'id desc';
	}

	protected static function table_name() {
		return 'battles';
	}

	public function date() {
		return strtotime($this->created_at);
	}

	public function strdate() {
		return date("Y-m-d", $this->date());
	}

	public function __tostring() {
		return $this->name . " (" . $this->strdate() . ")";
	}

};
