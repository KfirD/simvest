<?
class Player {
	var $name;
	var $money;
	
	function __construct($player_name,$player_cash) {
		$this->name=$player_name;
		$this->money=$player_cash;
	}
	function get_name() {
		return $this->$name;
	}
}


?>