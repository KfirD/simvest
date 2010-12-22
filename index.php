<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>welcome to simvest</title>
		<?php include ("library.php") ; ?>
		
		<link rel="stylesheet" type="text/css" href="base.css" />
	</head>
	<body>
		<div id="box">
			<p class="big">Welcome to SimVest</p>
			<p class="awkward">Enter your name to start playing</p>
			<form action="start_game.php" method="post" >
				<div id="name"><input type="text" name="name" /></div>
			</form>
		</div>



	</body>


</html>