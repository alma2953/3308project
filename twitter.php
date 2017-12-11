<?php
require "twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
$lat = $_REQUEST['lat'];
$long = $_REQUEST['long'];

$connection = new TwitterOAuth("pKfIFt8arqfzL938yGcwdafOl", "MXrHCQZakr5wwUBDewKnhxLcRnJhSB0p7RYqIUIjazK1axj0YH", "4236306143-JHRg98yv2UJfDGzyzVkzhLBUrjngMgOIReJT7nc", "6pxQaH2cmKXT28H1zQ1XR5HlQjDwmNvD5Na9SInBOETrj");
$content = $connection->get("account/verify_credentials");
$places = $connection->get("search/tweets", ["q" => " ", "geocode" => "{$lat},{$long},1mi","tweet_mode"=>extended]);
$places2 = $connection->get("search/tweets", ["q" => "a", "geocode" => "{$lat},{$long},1mi","tweet_mode"=>extended]);
$places3 = $connection->get("search/tweets", ["q" => "the", "geocode" => "{$lat},{$long},1mi","tweet_mode"=>extended]);
$places4 = $connection->get("search/tweets", ["q" => "I", "geocode" => "{$lat},{$long},1mi","tweet_mode"=>extended]);
$places5 = $connection->get("search/tweets", ["q" => "to", "geocode" => "{$lat},{$long},1mi","tweet_mode"=>extended]);
$places6 = $connection->get("search/tweets", ["q" => "and", "geocode" => "{$lat},{$long},1mi","tweet_mode"=>extended]);
$places7 = $connection->get("search/tweets", ["q" => "you", "geocode" => "{$lat},{$long},1mi","tweet_mode"=>extended]);
$places8 = $connection->get("search/tweets", ["q" => "is", "geocode" => "{$lat},{$long},1mi","tweet_mode"=>extended]);
$places8 = $connection->get("search/tweets", ["q" => "in", "geocode" => "{$lat},{$long},1mi","tweet_mode"=>extended]);
$places9 = $connection->get("search/tweets", ["q" => "of", "geocode" => "35,35,1mi","tweet_mode"=>extended]);


$placesArray = array_merge($places->statuses,$places2->statuses,$places3->statuses,$places4->statuses,$places5->statuses,$places6->statuses);
echo json_encode($placesArray);
?>