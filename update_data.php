<?php
include ("library.php");
$player = new Player('', 0); // Needs initialization before starting session. Why? Who knows...
session_start(); // *lovingly* start up your PHP session! 

$player = $_SESSION['player'];

$return['error'] = ""; // start with no error

if ((int)$_POST['amount'] > 0) {
	if($_POST['action'] == "buy") { // they clicked "buy"
		$stocksToBuy = (int)$_POST['amount'];
		$stockPrice = round(end($player->stockData->allData)*100)/100;

		if($stocksToBuy*$stockPrice <= $player->money) {
			$player->money -= $stocksToBuy*$stockPrice + 1;	// subtract price + brokerage fee
			$player->stocks += $stocksToBuy;				// give stocks
		} else {
			$return['error'] = "You have too little money."; // messy-looking, but temporary
		}

	} else if($_POST['action'] == "sell") { // they clicked "sell"
		$stocksToSell = (int)$_POST['amount'];
		$stockPrice = round(end($player->stockData->allData)*100)/100;

		if($stocksToSell <= $player->stocks) {
			$player->stocks -= $stocksToSell;					// subtract stocks
			$player->money += $stocksToSell*$stockPrice - 1;	// give money - brokerage fee
		} else {
			$return['error'] = "You have too few stocks."; // again, messy-looking, but temporary
		}
	}
}

$player->stockData->tick();	

$return['current_price'] = round(end($player->stockData->allData)*100)/100;
$return['big_chart'] = $player->stockData->chartData();
$return['little_chart'] = $player->stockData->chartVolume();
$return['money'] = $player->get_money();
$return['stocks'] = $player->stocks;

echo json_encode($return);

?>