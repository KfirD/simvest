<?

try { //create or open the database
	$db = new SQLiteDatabase('db.sqlite', 0666, $error);
} catch(Exception $e) {
	die($error);
}

function saveState($obj = null) {
	if (!$db->queryExec("INSERT INTO Users (username, player_cash, player_stocks) VALUES ('twi', '123', '2')", $error)) return $error;
}

include ("DataSource.php");

class Player {
	var $name;
	var $money;
	var $stockData; # we can embed this in the player so we only have to post the person's player object, and not the DataSource one as well
	var $stocks; # how many stocks they own
	
	function __construct($player_name,$player_cash=0,$player_stock=0) {
		$this->stocks = $player_stock; # sorry, but this is how the world works.
		
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

session_start(); // *lovingly* start up your PHP session! 

?>
