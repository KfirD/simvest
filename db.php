<?php

class Database {
	
	function __construct() {
		$this->url = 'external-db.s72725.gridserver.com';
		$this->user = 'db72725_naplog';
		$this->pass = 'napnap123';
		$this->db = "db72725_coalapp";
		
		$this->link = mysql_connect($this->url, $this->user, $this->pass);
		$this->db = mysql_select_db($this->db, $this->link);
	}
	
	function __destruct() {
		mysql_close($this->link);
	}
	
	function get_user($user_id) {
		$query = mysql_query("SELECT * FROM users WHERE user_id='$user_id'", $this->link);
		$result = mysql_fetch_assoc($query);
		
		return $result;
	}
	
	function addUser($user_id, $money, $stocks) {
		if (!$this->get_user($user_id)) {
			## insert
			mysql_query("INSERT INTO users (user_id, money, stocks) VALUES ('$user_id', '$money', '$stocks')", $this->link);
		}
	}
	
	function updateMoney($user_id, $money) {
		mysql_query("UPDATE users SET money='$money' WHERE user_id='$user_id'", $this->link);
	}
	
	function updateStocks($user_id, $stocks) {
		mysql_query("UPDATE users SET stocks='$stocks' WHERE user_id='$user_id'", $this->link);
	}
	
	function storeSession($user_id, $session) {
		mysql_query("UPDATE users SET session='$session' WHERE user_id='$user_id'", $this->link);
	}
	
	function didShare($user_id) {
		$query = mysql_query("SELECT shared FROM users WHERE user_id='$user_id'", $this->link);
		$result = mysql_fetch_assoc($query);
		
		if ($result['shared']) {
			return true;
		} else {
			return false;
		}
	}
	
	function setShare($user_id) {
		mysql_query("UPDATE users SET shared='1' WHERE user_id='$user_id'", $this->link);
	}
	
}

?>