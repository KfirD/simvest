<?php

try { //create or open the database
	$db = new SQLiteDatabase('db.sqlite', 0666, $error);
} catch(Exception $e) {
	die($error);
}

$queryType = "result";

//$query = "DROP TABLE Users";
//$query = "CREATE TABLE Users (username TEXT, password TEXT, player_cash INT, player_stocks INT)";
//$query = "INSERT INTO Users (username, password) VALUES ('spencer', '".md5("sdslondon")."')";
$query = "SELECT * FROM Users";
//$query = "UPDATE Users SET player_cash='50' WHERE username='spencer'";

if ($queryType == "result") {
	if (!$result = $db->query($query, $error)) echo $error;

	while($row = $result->fetch()) {
		print_r($row);
	}
} else {
	if (!$result = $db->queryExec($query, $error)) echo $error;
}


?>