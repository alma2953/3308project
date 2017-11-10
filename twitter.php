<?php
require "twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

$connection = new TwitterOAuth("pKfIFt8arqfzL938yGcwdafOl", "MXrHCQZakr5wwUBDewKnhxLcRnJhSB0p7RYqIUIjazK1axj0YH", "4236306143-JHRg98yv2UJfDGzyzVkzhLBUrjngMgOIReJT7nc", "6pxQaH2cmKXT28H1zQ1XR5HlQjDwmNvD5Na9SInBOETrj");
$content = $connection->get("account/verify_credentials");
$places = $connection->get("search/tweets", ["q" => " ", "geocode" => "40.0076,-105.2659,1mi"]);
$placesArray = $places->statuses;
echo json_encode($placesArray);
?>