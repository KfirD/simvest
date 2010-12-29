<?php
include ("library.php");
$player = new Player('', 0); // Needs initialization before starting session. Why? Who knows...
session_start(); // *lovingly* start up your PHP session! 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>simvest</title>
		<link rel="stylesheet" type="text/css" href="base.css" />
		<link rel="stylesheet" type="text/css" href="controls.css" />
	</head>
	<body onload="document.transaction.amount.focus();setTimeout('window.location.href=window.location.href;',5000);">
		<?php
			
		
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
			
		} else {
			$player = $_SESSION['player'];		
			
			
			/*
				NOTES ON STOCK PURCHASES:
				I added $stocks to Player class to record in player object. They start with 0.

				The purchase form has multiple submit buttons. First, I check which is clicked, buy or sell.
				Then, I check in buy to see if they have enough money and in sell to see if they have enough stocks.
				If they aren't trying to cheat, I will allow the transaction (with a $1 brokerage fee each way)


			*/
			
			if($_POST['buy']) { // they clicked "buy"
				$stocksToBuy = (int)$_POST['amount'];
				$stockPrice = round(end($player->stockData->allData)*100)/100;
				
				if($stocksToBuy*$stockPrice <= $player->money) {
					$player->money -= $stocksToBuy*$stockPrice + 1;	// subtract price + brokerage fee
					$player->stocks += $stocksToBuy;				// give stocks
				} else {
					echo "You have too little money.<br />"; // messy-looking, but temporary
				}

			} else if($_POST['sell']) { // they clicked "sell"
				$stocksToSell = (int)$_POST['amount'];
				$stockPrice = round(end($player->stockData->allData)*100)/100;
				
				if($stocksToSell <= $player->stocks) {
					$player->stocks -= $stocksToSell;					// subtract stocks
					$player->money += $stocksToSell*$stockPrice - 1;	// give money - brokerage fee
				} else {
					echo "You have too few stocks.<br />"; // again, messy-looking, but temporary
				}
			}		
			
			
			$player->stockData->tick();
			

		}
			// prints out charts and current price.
			echo "<img src='" . $player->stockData->chartData() . "' />";
			echo "<br /><img src='" . $player->stockData->chartVolume() . "' />";
			echo "<p>Current price: $" . round(end($player->stockData->allData)*100)/100 . "</p>";
		?>
		
		<p>Name: <?php echo $player->get_name(); ?></p>
		<p>Money: $<?php echo $player->get_money(); ?></p>
		<p>Number of stock(s): <?php echo $player->stocks; //new line ?>
		
		<form name="transaction" action="start_game.php" method="post" >
			<input type="text" name="amount" />
			<input type="submit" name="buy" value="Buy" />
			<input type="submit" name="sell" value="Sell" />
		</form>
	</body>


</html>
