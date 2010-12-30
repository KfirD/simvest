<?php

include("library.php");

if (isset($_POST['endgame'])) {
	$_SESSION['start_game'] = false;
}

if ($_SESSION['start_game']) {
	## load the game ##
	$player = $_SESSION['player'];	
	$player->stockData->tick();
	include("start_game.php");
} else {
	## load the setup ##
	if(isset($_POST['name'])) { 
		// alternatively, we could check the session, forcing people to stick with their names.

		if($_POST['name']=='rockefeller' or $_POST['name']=='night fury') { // yep.
			$player = new Player($_POST['name'], 10000000000); // isn't this slightly excessive?
		} else {
			$player = new Player($_POST['name'], 50);
		}


		for ($i=0; $i < 10; $i++) { 
			$player->stockData->tick();
		}

		$_SESSION['player'] = $player;
		$_SESSION['start_game'] = true;

		header("Location: /"); // now go play the game!

	}
	include("setup_game.php");
}

?>