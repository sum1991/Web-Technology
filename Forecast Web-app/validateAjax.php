<?php
$name = $email = "";
$degree="";
$xmlstring ="";
$url ="";
$address="";
$fulladdr ="";
$lat ="";
$long ="";
$email="";
$statead="";
$json1="";
$resp_location="";

   
    $name = $_GET["streetInput"];
    $email = $_GET["cityInput"];
    $statead = $_GET["stateInput"];
     if($_GET["Temperature"] == "Farenhiet")
     {
         $degree = "us";
     }
else
{
    $degree ="si";
}
    $fulladdr = $name.",".$email.",".$statead;
    $address = urlencode($fulladdr);
    $resp_location="";
    //$url ="http://maps.google.com/maps/api/geocode/xml?address={$address}"; 
   $url="https://maps.googleapis.com/maps/api/geocode/xml?address={$address}&key=AIzaSyBcNPUcsvWO-DwJQmTH2qggVzElMYGxo6U";
    $resp_location = file_get_contents($url);
    $xmlstring = new SimpleXMLElement($resp_location);
    $lat =$xmlstring->result->geometry->location->lat;
    $long = $xmlstring->result->geometry->location->lng;
    $json1 = file_get_contents("https://api.forecast.io/forecast/28ee38edb7bfb9a0bfae4aa24a6fca4a/{$lat},{$long}?units={$degree}&exclude=flags");
    echo "$json1";
    //print_r($json1);



?>