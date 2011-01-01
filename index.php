<?php

require("facebook.php");
require("library.php");
require("db.php");

$db = new Database();

$did_share = $db->didShare($_SESSION['user_id']);

$facebook = new Facebook(array(
  'appId'  => '130100847053889',
  'secret' => '1637a37b64afa08e41bc8e59997e56a7',
  'cookie' => true,
));

$fb_session = $facebook->getSession();
$me = null;
if ($fb_session) {
	try {
		$uid = $facebook->getUser();
		$me = $facebook->api('/me');
	} catch (FacebookApiException $e) {
		error_log($e);
	}
}
if ($me) {
	$logoutUrl = $facebook->getLogoutUrl();
} else {
	$data['req_perms'] = "publish_stream";
	$loginUrl = $facebook->getLoginUrl($data);
}

switch ($_GET['q']) {
	case "fb_share":
		if (!$db->didShare($_SESSION['user_id'])) {
			$player = $_SESSION['player'];
			
			$data['link'] = "http://coalapp.com";
			$data['message'] = "play coal app -- an addicting game where you buy and sell stocks";
			$facebook->api("/me/links", "POST", $data);
						
			$money = $player->get_money();
			$money = $money + 10;
			$player->money = $money;
			$db->updateMoney($_SESSION['user_id'], $money);
			
			$db->setShare($_SESSION['user_id']);
		}
		
		header("Location: /");
	break;
	case "scores":
		$friends_all = $facebook->api("/me/friends");
		foreach ($friends_all['data'] as $friend) {
			$friends[] = $friend['id'];
		}
		$friends_all = null;
		print_r($friends);
	break;
	case "logout":
		$_SESSION['start_game'] = false;
		if ($me) {
			header("Location: ".$logoutUrl);
			$db->storeSession($_SESSION['user_id'], json_encode($_SESSION['player']));
		} else {
			header("Location: /");
		}
		$_SESSION['user_id'] = null;
	break;
	case "startover":
		$player = new Player($player->name, 50, 0);
		$_SESSION['player'] = $player;
		header("Location: /");
	break;
	default:
		if ($_SESSION['start_game']) {
			## load the game ##
			$player = $_SESSION['player'];	
			$player->stockData->tick();
			include("start_game.php");
		} else {
			## load the setup ##
			
			if($me) {
				$name = $me['name'];
				$user_id = $me['id'];
				$_SESSION['user_id'] = $user_id;
				if ($result=$db->get_user($user_id)) {
					$money = $result['money'];
					$stocks = $result['stocks'];
				} else {
					$money = 50;
					$stocks = 0;
					$db->addUser($user_id, $money, $stocks);
				}
			} else if (isset($_POST['name'])) {
				$name = $_POST['name'];
				$money = 45;
				$stocks = 0;
			}
			
			if ($name) {
				if($name=='rockefeller' || $name=='night fury') { // yep.
					$player = new Player($name, 10000000000, 0); // isn't this slightly excessive?
				} else {
					$player = new Player($name, $money, $stocks);
				}

				for ($i=0; $i < 10; $i++) { 
					$player->stockData->tick();
				}

				$_SESSION['player'] = $player;
				$_SESSION['start_game'] = true;

				header("Location: /"); // now go play the game!
			}

			include("setup_game.php");
		}
	break;
}

?>