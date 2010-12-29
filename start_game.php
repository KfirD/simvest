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
	<body onload="javascript:setTimeout('window.location.href=window.location.href;',10000);">
		<?php
		
		$_SESSION['stock_num'] = $_SESSION['stock_num'] + $_POST['buy'] - $_POST['sell'] //gets the stock number, new line
		if(isset($_POST['name'])) { 
			// alternatively, we could check the session, forcing people to stick with their names.
			
			if($_POST['name']=='rockefeller' or $_POST['name']=='night fury') { // yep.
				$player = new Player($_POST['name'], 10000000000);
			} else {
				$player = new Player($_POST['name'], 100);
			}
			
			$_SESSION['player'] = $player;
		} else {
			$player = $_SESSION['player'];
			
			$player->stockData->tick();
			

		}
			// prints out charts and current price.
			echo "<img src='" . $player->stockData->chartData() . "' />";
			echo "<br /><img src='" . $player->stockData->chartVolume() . "' />";
			echo "<p>Current price: $" . round(end($player->stockData->allData)*100)/100 . "</p>";
		?>
		
		<p>Name: <?php echo $_SESSION['player']->get_name(); ?></p>
		<p>Money: $<?php echo $_SESSION['player']->get_money(); ?></p>
		<p>Number of stock(s): <?php echo $_SESSION['stock_num']; //new line ?>
		
		<form action="start_game.php" method="post" >
			<input type="text" name="amount" />
			<input type="submit" name="buy" value="Buy" />
			<input type="submit" name="sell" value="Sell" />
		</form>
	</body>


</html>
