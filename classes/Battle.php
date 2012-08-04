<?php
class Battle extends BasicObject {
	protected static function default_order() {
		return 'id desc';
	}

	protected static function table_name() {
		return 'battles';
	}

};
