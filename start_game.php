<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>COAL $<?php echo round(end($player->stockData->allData)*100)/100; ?></title>
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
		
		<form name="transaction" method="post" >
			<input type="text" name="amount" />
			<input type="button" name="buy" value="Buy" />
			<input type="button" name="sell" value="Sell" />
		</form>
		<form id="endgame" method="post">
			<input name="endgame" type="submit" value="End Game" />
		</form>
		</div>
		
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-20493848-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
		
	</body>

</html>
