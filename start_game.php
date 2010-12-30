<?php
include ("library.php");
$player = new Player('', 0); // Needs initialization before starting session. Why? Who knows...
session_start(); // *lovingly* start up your PHP session! 

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
	
	header("Location: start_game.php"); // redirect to clear all post vars;
	
} else {
	$player = $_SESSION['player'];		
	
	
	/*
		NOTES ON STOCK PURCHASES:
		I added $stocks to Player class to record in player object. They start with 0.

		The purchase form has multiple submit buttons. First, I check which is clicked, buy or sell.
		Then, I check in buy to see if they have enough money and in sell to see if they have enough stocks.
		If they aren't trying to cheat, I will allow the transaction (with a $1 brokerage fee each way)


	*/			
	
	$player->stockData->tick();
	

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>simvest</title>
		<link rel="stylesheet" type="text/css" href="base.css" />
		<link rel="stylesheet" type="text/css" href="controls.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript"></script>
		<script src="main.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="everything">
		<div class="error"></div>
		<img class="big_chart" src="<?php echo $player->stockData->chartData() ?>" />
		<br />
		<img class="litte_chart" src="<?php echo $player->stockData->chartVolume() ?>">
		<p class="current_price">Current price: $<span><?php echo round(end($player->stockData->allData)*100)/100; ?></span></p>
					
		<ul id="data">
			<li class="data name">Name: <span><?php echo $player->get_name(); ?></spna></li>
			<li class="data money">Money: $<span><?php echo $player->get_money(); ?></span></li>
			<li class="data stocks">Number of stock(s): <span><?php echo $player->stocks;?></span></li>
		</ul>
		
		<form name="transaction" action="start_game.php" method="post" >
			<input type="text" name="amount" />
			<input type="button" name="buy" value="Buy" />
			<input type="button" name="sell" value="Sell" />
		</form>
		</div>
	</body>


</html>
