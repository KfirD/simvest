<?php
session_start(); // start up your PHP session! 
?>
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
			$player = new Player($_POST['name'], 50);
			$_SESSION['name'] = $player->get_name();
			$_SESSION['money'] = $player->get_money();
		?>
		<p>Name: <?php echo  $_SESSION['name']; ?></p>
		<p>Money: $<?php echo $_SESSION['money'] ?></p>
		



	</body>


</html>
