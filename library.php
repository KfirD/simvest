<?

include ("DataSource.php");

class Player {
	var $name;
	var $money;
	var $stockData; # we can embed this in the player so we only have to post the person's player object, and not the DataSource one as well
	
	function __construct($player_name,$player_cash) {
		$this->name=$player_name;
		$this->money=$player_cash;
		$this->stockData = new DataSource;
		$this->stockData->tick(); # providing the first $10 value.
	}
	function get_name() {
		return $this->name;
	}
	function get_money() {
		return $this->money;
	}
}


?>
