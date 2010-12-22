<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>simvest</title>
		<?php include ("library.php");  ?>
		<link rel="stylesheet" type="text/css" href="base.css" />
	</head>
	<body>
		<?php
			$player = new Player($_GET['name'], 50);
		?>
		<p>Name: <?php echo $player->get_name(); ?></p>
		<p>Money: $<?php echo $player->get_money() ?></p>
		



	</body>


</html>