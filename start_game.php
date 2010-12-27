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
	</head>
	<body>
		<?php
		
		if(isset($_POST['name'])) { 
			// alternatively, we could check the session, forcing people to stick with their names.
			
			$player = new Player($_POST['name'], 50);
			$_SESSION['player'] = $player;
		}
			
		?>
		<p>Name: <?php echo $_SESSION['player']->get_name(); ?></p>
		<p>Money: $<?php echo $_SESSION['player']->get_money(); ?></p>
		



	</body>


</html>
