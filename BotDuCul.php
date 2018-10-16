<?php

include('../safeTweet.php');
include('dbinfo.php');
include('twitterCredentials.php');
require_once('../TwitterAPIExchange.php');
header('Content-Type: text/html; charset=utf-8');

/** Set access tokens here - see: https://apps.twitter.com/ **/
$APIsettings = array(
	'oauth_access_token' => $oauthToken,
	'oauth_access_token_secret' => $oauthTokenSecret,
	'consumer_key' => $consumerKey,
	'consumer_secret' => $consumerSecret
	);

// Connect to applications DB
try {
	$bddApp = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbAppName, $dbAppLogin, $dbAppPassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	$bddApp->exec("SET CHARACTER SET utf8");
} catch (PDOException $e) {
	echo 'Echec de la connexion : ' . $e->getMessage();
	exit;
}

$appResponse = $bddApp->query("SELECT value FROM misc WHERE appName='botDuCul'");
$appResult = $appResponse->fetchAll();
$wordid = $appResult[0][0];
$appResponse->closeCursor();

if($wordid < 46209){
	try {
		$bdd = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $dblogin, $dbpassword, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		$bdd->exec("SET CHARACTER SET utf8");
	} catch (PDOException $e) {
		echo 'Echec de la connexion : ' . $e->getMessage();
		exit;
	}

	$queryWord = "SELECT DISTINCT lemme FROM lexique2 LIMIT 1 OFFSET " . $wordid;
	$response = $bdd->query($queryWord);
	$result = $response->fetchAll();
	$word = $result[0][0];
	$response->closeCursor();

	$tweet = $word . " du cul";

	$appResponse = $bddApp->query("UPDATE misc SET value = value + 1 WHERE appName = 'botDuCul'");
	$appResponse->closeCursor();

	if(safeTweet($tweet)){
		// Post the tweet
		$postfields = array(
			'status' =>  $tweet);
		$url = "https://api.twitter.com/1.1/statuses/update.json";
		$requestMethod = "POST";

		$twitter = new TwitterAPIExchange($APIsettings);
		echo $twitter->buildOauth($url, $requestMethod)
		->setPostfields($postfields)
		->performRequest();
	}else{
		file_get_contents("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
	}
}



?>
