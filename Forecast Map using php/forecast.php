<!DOCTYPE html>
<html>
<head>
    <title>Forecast Api</title>
	<meta charset="utf-8" />

    
</head>
  
<body style="margin-top: 53px;">
<h1 style="text-align:center;padding-right: 25px;"> Forecast Search</h1>
    <?php

    error_reporting(E_ERROR);
    $name = $email = "";
$statead="";
$degree="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["stadd"];
    $email = $_POST["city"];
    $statead = $_POST["state1"];
    $degree = $_POST["degree"];
    
}
    
    ?>
        <script>
    function clearForm(formb)
        {
      formb.state1.value = "None";
       formb.stadd.value = "";
        formb.elements["city"].value = "";
            formb.elements["degree"].value = "us"; 
        
            
        var x= document.getElementById("Outputable");
        x.innerHTML="";    
         
        }
        
            function jsfunction()
            {
            
            alert("Enter a valid address");
            
            }
            
            
function validateForm() {
    
    
    
    var x = document.forms["myForm"]["stadd"].value;
    if (x == null || x == "" || x.trim().length == 0) {
        alert("Street Address must be filled out");
        return false;
    }
    var x = document.forms["myForm"]["city"].value;
    if (x == null || x == "" || x.trim().length == 0) {
        alert("City must be filled out");
        return false;
    }
    
 var x = document.forms["myForm"]["state1"].value;
    if (x == "None" || x == "") {
        alert("State must be filled out");
        return false;
    }
 
      var x = document.forms["myForm"]["degree"].value;
    if (x == null || x == "") {
        alert("Degree must be filled out");
        return false;
    }
    
    
    return true;
}
</script>
    
<div id ="remove" style="border: 4px solid rgb(0, 0, 0);width: 334px; margin-left: 483px;">    
<form style ="text-align:center;" action="<?php $_SERVER["PHP_SELF"];?>" name="myForm" onsubmit="return validateForm()" id="forecast" method="post">
<p style ="display: inline-block;">Street Address:*</p>    
 <input value="<?php echo $name;?>" style ="margin-left:33px;" type="text" name="stadd">
  <br>
<p style ="display: inline-block;">City:*</p>
<input  value="<?php echo $email;?>" style ="margin-left:101px;" type="text" name="city">
<br>
 <p style ="display: inline-block;padding-right: 24px;">State:*</p> 
<select style="margin-left: 83px;" name="state1">
    <option <?php if($statead =="None"){echo "selected='selected'"; } ?>value="None">Select Your State</option>
        <option <?php if($statead =="AL"){echo "selected='selected'";}?>value="AL">Alabama</option>
        <option <?php if($statead =="AK"){echo "selected='selected'";}?>value="AK">Alaska</option>
        <option <?php if($statead =="AZ"){echo "selected='selected'";}?>value="AZ">Arizona</option>
        <option <?php if($statead =="AR"){echo "selected='selected'";}?>value="AR">Arkansas</option>
        <option <?php if($statead =="CA"){echo "selected='selected'";}?> value="CA">California</option>
        <option <?php if($statead =="CO"){echo "selected='selected'";}?>value="CO">Colorado</option>
        <option <?php if($statead =="CT"){echo "selected='selected'";}?>value="CT">Connecticut</option>
        <option <?php if($statead =="DE"){echo "selected='selected'";}?>value="DE">Delaware</option>
        <option <?php if($statead =="DC"){echo "selected='selected'";}?>value="DC">District Of Columbia</option>
        <option <?php if($statead =="FL"){echo "selected='selected'";}?>value="FL">Florida</option>
        <option <?php if($statead =="GA"){echo "selected='selected'";}?>value="GA">Georgia</option>
        <option <?php if($statead =="HI"){echo "selected='selected'";}?>value="HI">Hawaii</option>
        <option <?php if($statead =="ID"){echo "selected='selected'";}?>value="ID">Idaho</option>
        <option <?php if($statead =="IL"){echo "selected='selected'";}?>value="IL">Illinois</option>
        <option <?php if($statead =="IN"){echo "selected='selected'";}?>value="IN">Indiana</option>
        <option <?php if($statead =="IA"){echo "selected='selected'";}?>value="IA">Iowa</option>
        <option <?php if($statead =="KS"){echo "selected='selected'";}?>value="KS">Kansas</option>
        <option <?php if($statead =="KY"){echo "selected='selected'";}?>value="KY">Kentucky</option>
        <option <?php if($statead =="LA"){echo "selected='selected'";}?>value="LA">Louisiana</option>
        <option <?php if($statead =="ME"){echo "selected='selected'";}?>value="ME">Maine</option>
        <option <?php if($statead =="MD"){echo "selected='selected'";}?>value="MD">Maryland</option>
        <option <?php if($statead =="MA"){echo "selected='selected'";}?>value="MA">Massachusetts</option>
        <option <?php if($statead =="MI"){echo "selected='selected'";}?>value="MI">Michigan</option>
        <option <?php if($statead =="MN"){echo "selected='selected'";}?>value="MN">Minnesota</option>
        <option <?php if($statead =="MS"){echo "selected='selected'";}?>value="MS">Mississippi</option>
        <option <?php if($statead =="MO"){echo "selected='selected'";}?>value="MO">Missouri</option>
        <option <?php if($statead =="MT"){echo "selected='selected'";}?>value="MT">Montana</option>
        <option <?php if($statead =="NE"){echo "selected='selected'";}?>value="NE">Nebraska</option>
        <option <?php if($statead =="NV"){echo "selected='selected'";}?>value="NV">Nevada</option>
        <option <?php if($statead =="NH"){echo "selected='selected'";}?>value="NH">New Hampshire</option>
        <option <?php if($statead =="NJ"){echo "selected='selected'";}?>value="NJ">New Jersey</option>
        <option <?php if($statead =="NM"){echo "selected='selected'";}?>value="NM">New Mexico</option>
        <option <?php if($statead =="NY"){echo "selected='selected'";}?>value="NY">New York</option>
        <option <?php if($statead =="NC"){echo "selected='selected'";}?>value="NC">North Carolina</option>
        <option <?php if($statead =="ND"){echo "selected='selected'";}?>value="ND">North Dakota</option>
        <option <?php if($statead =="OH"){echo "selected='selected'";}?>value="OH">Ohio</option>
        <option <?php if($statead =="OK"){echo "selected='selected'";}?>value="OK">Oklahoma</option>
        <option <?php if($statead =="OR"){echo "selected='selected'";}?>value="OR">Oregon</option>
        <option <?php if($statead =="PA"){echo "selected='selected'";}?>value="PA">Pennsylvania</option>
        <option <?php if($statead =="RI"){echo "selected='selected'";}?>value="RI">Rhode Island</option>
        <option <?php if($statead =="SC"){echo "selected='selected'";}?>value="SC">South Carolina</option>
        <option <?php if($statead =="SD"){echo "selected='selected'";}?>value="SD">South Dakota</option>
        <option <?php if($statead =="TN"){echo "selected='selected'";}?>value="TN">Tennessee</option>
        <option <?php if($statead =="TX"){echo "selected='selected'";}?>value="TX">Texas</option>
        <option <?php if($statead =="UT"){echo "selected='selected'";}?>value="UT">Utah</option>
        <option <?php if($statead =="VT"){echo "selected='selected'";}?>value="VT">Vermont</option>
        <option <?php if($statead =="VA"){echo "selected='selected'";}?>value="VA">Virginia</option>
        <option <?php if($statead =="WA"){echo "selected='selected'";}?>value="WA">Washington</option>
        <option <?php if($statead =="WV"){echo "selected='selected'";}?>value="WV">West Virginia</option>
        <option <?php if($statead =="WI"){echo "selected='selected'";}?>value="WI">Wisconsin</option>
        <option <?php if($statead =="WY"){echo "selected='selected'";}?>value="WY">Wyoming</option>
</select>
<br>
<p style ="display: inline-block;">Degree:*</p>
    <div style="display: inline-block;margin-left: 86px;">
<input type="radio" checked="checked" name="degree" value="us">Farenhiet
<input type="radio" <?php if ($degree=="si"){echo "checked='checked'";}?> name = "degree" value="si"> Celsius<br>
    </div>
    <br>
<input type="submit" value="Search">
    
<!--<input type="reset" onclick="ClearForm(this.form)" value="Reset">-->
    <input  type="button" name="clear" value="Clear" onclick="clearForm(this.form);">

   
</form>
    <p style="padding-left: 22px;"><i>*-Mandatory Fields</i></p>
<p style="text-align:center;"><a  href="http://forecast.io/">Powered By Forecast.io</a> </p>
    
</div>
<?php if(isset($_POST));
// define variables and set to empty values
$name = $email = "";
$degree="";
$xmlstring ="";
$url ="";
$address="";
$lat ="";
$long ="";
$json1 ="";
$summary="";
$temperature ="";
$icon =" ";
$finalimage="";
$precipIntensity ="";
$precipProbability ="";
$windSpeed ="";
$windSpeed ="";
$dewPoint ="";
$humidity ="";
$visibility ="";
$sunriseTime ="";
$sunsetTime ="";
$statead="";
$pecp ="";
/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $name = $_POST["stadd"];
   $email = $_POST["city"];
}*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["stadd"];
    $email = $_POST["city"];
    $statead = $_POST["state1"];
    $degree = $_POST["degree"];
    $fulladdr = $name.",".$email.",".$statead;
    $address = urlencode($fulladdr);
    $resp_location="";
    //$url ="http://maps.google.com/maps/api/geocode/xml?address={$address}"; 
   $url="https://maps.googleapis.com/maps/api/geocode/xml?address={$address}&key=AIzaSyBcNPUcsvWO-DwJQmTH2qggVzElMYGxo6U";
    $resp_location = file_get_contents($url);
    $xmlstring = new SimpleXMLElement($resp_location);
    $lat =$xmlstring->result->geometry->location->lat;
    $long = $xmlstring->result->geometry->location->lng;
    if($long =="" || $lat =="")
    {
       print '<script type="text/javascript">jsfunction();</script>';
        return;
    
    }
    
    //echo $xmlstring->GeocodeResponse[0]->result[0]->type;
    //echo "hello";
    //echo $lat;
    //echo $long;
    $json1 = file_get_contents("https://api.forecast.io/forecast/28ee38edb7bfb9a0bfae4aa24a6fca4a/{$lat},{$long}?units={$degree}&exclude=flags");
$json1 = json_decode($json1);

//print_r($json1);
//print_r($json1->{'minutely'}->{'summary'});
$summary = $json1->{'currently'}->{'summary'};
    //print $json1;
$temperature = $json1->{'currently'}->{'temperature'};
$temperature = intval($temperature);    
$icon = $json1->{'currently'}->{'icon'};     
$precipIntensity = $json1->{'currently'}->{'precipIntensity'};
$precipProbability = $json1->{'currently'}->{'precipProbability'};  
$windSpeed = $json1->{'currently'}->{'windSpeed'};
$dewPoint = $json1->{'currently'}->{'dewPoint'};
$humidity = $json1->{'currently'}->{'humidity'};
$visibility = $json1->{'currently'}->{'visibility'};
$sunriseTime = $json1->{'daily'}->{'data'}[0]->{'sunriseTime'};
$sunsetTime = $json1->{'daily'}->{'data'}[0]->{'sunsetTime'};
    
date_default_timezone_set($json1->timezone);
    //print"<pre>";
    //print $json1->timezone; 
function calculateIcon($icon1)
{
    //echo $icon1;
    if($icon1=="clear-night")
    {
    
    }
switch ($icon1) {
        case "clear-day":
        $icon1 = "clear.png";
        break;
    case"clear-night":
      $icon1 = "clear_night.png";
        break;
    case "rain":
       $icon1 = "rain.png";
        break;
            case "snow":
        $finalimage = "snow.png";
        break;
            case "sleet":
        $icon1 = "sleet.png";
        break;
            case "wind":
       $icon1 = "wind.png";
        break;
            case "fog":
       $icon1 = "fog.png";
        break;
           case "cloudy":
        $icon1 = "cloudy.png";
        break;
            case "partly-cloudy-day":
       $icon1 = "cloud_day.png";
        break;
        case "partly-cloudy-night":
       $icon1 = "cloud_night.png";
        break;
    default:
        echo "";
}
}    
    
if($icon)
{    
    switch($icon)
{
    case "clear-day":
        $finalimage = "clear.png";
        break;
    case"clear-night":
      $finalimage = "clear_night.png";
        break;
    case "rain":
       $finalimage = "rain.png";
        break;
             case "snow":
        $finalimage = "snow.png";
        break;
            case "sleet":
        $finalimage = "sleet.png";
        break;
            case "wind":
       $finalimage = "wind.png";
        break;
            case "fog":
       $finalimage = "fog.png";
        break;
           case "cloudy":
        $finalimage = "cloudy.png";
        break;
            case "partly-cloudy-day":
       $finalimage = "cloud_day.png";
        break;
        case "partly-cloudy-night":
       $finalimage = "cloud_night.png";
        break;
    default:
        echo "";
}
  //calculateIcon($icon);
    
}    
    if($degree =="si")
    {
      $precipIntensity =floatval($precipIntensity);
       $precipIntensity= ($precipIntensity/25.4);
  if($precipIntensity >= 0 && $precipIntensity < 0.002)
      {    
      $precipIntensity ="None";
      }
   if($precipIntensity >= 0.002 && $precipIntensity < 0.017)
      {  
      $precipIntensity ="Very Light";
       }
   if($precipIntensity >=0.017&& $precipIntensity<0.1)
      {  
      $precipIntensity ="Light";
      }
     if($precipIntensity >= 0.1 && $precipIntensity<0.4)
      {  
      $precipIntensity ="Moderate";
      }
    if($precipIntensity >= 0.4)
    {  
      $precipIntensity ="Heavy";
    }
    }
    if($degree =="us")
    {   
    $precipIntensity =floatval($precipIntensity);
     
  if($precipIntensity >= 0 && $precipIntensity < 0.002)
  {  
      $precipIntensity ="None";
  }
   if($precipIntensity >= 0.002 && $precipIntensity < 0.017)
  {  
      $precipIntensity ="Very Light";
  }
   if($precipIntensity >=0.017&& $precipIntensity<0.1)
  {  
      $precipIntensity ="Light";
  }
     if($precipIntensity >= 0.1 && $precipIntensity<0.4)
  {  
      $precipIntensity ="Moderate";
  }
    if($precipIntensity >= 0.4)
  {  
      $precipIntensity ="Heavy";
  }
    }
    
    
  

if($precipProbability)
{
$precipProbability = $precipProbability*100;
    $precipProbability = intval($precipProbability);
    
}
if($windSpeed)
{
    $windSpeed = intval($windSpeed);
    if($degree =="si")
    {
        $windSpeed = $windSpeed."mps";
    }
    if($degree =="us")
    {
        $windSpeed = $windSpeed."mph";
    }
  
}
if($dewPoint)
{
  $dewPoint = intval($dewPoint);
}
if($humidity)
{
    //echo $humidity;
   $humidity = $humidity*100;
    $humidity= intval($humidity);
   //$humidity = intval($humidity);
}      
if($visibility)
{
   $visibility = intval($visibility);
    if($degree =="si")
    {
        $visibility = $visibility."km";
    }
    if($degree =="us")
    {
        $visibility = $visibility."mi";
    }
    
}
if($sunriseTime)
{
   $sunriseTime = $sunriseTime;
    //echo date('h:i',$sunriseTime);
}
if($sunsetTime)
{
   $sunsetTime = $sunsetTime;
}  
    
   
print '<div id="Outputable" ><div style="margin-left:453px;margin-top: 80px;border: 4px solid rgb(0, 0, 0);width:402px;height: 457px;"><table style ="border-collapse:collapse;margin-left: 66px;">';
print '<tr><td colspan="2" style="padding-left: 104px;">'.$summary.'</td></tr>';
$tempd=""; 
if($degree=="si")
{
    $tempd="&#x2103";
}
else
{
 $tempd ="&#x2109";
}
print '<tr><td colspan="2" style="padding-left: 110px;">'.$temperature.''.$tempd.'</td></tr>';
print '<tr><td colspan="2" style="padding-left: 61px;"><img title="'.$summary.'" alt="'.$summary.'" src ="http://cs-server.usc.edu:45678/hw/hw6/images/'.$finalimage.'"></img></td></tr>';
print '<tr><td style="padding-left: 35px;">Precipitation</td><td style="padding-left: 36px;">'.$precipIntensity.'</td></tr>';
print '<tr><td style="padding-left:35px;">Chance of Rain</td><td style="padding-left: 36px;">'.$precipProbability.'%</td></tr>';
print '<tr><td style="padding-left: 35px;">Wind Speed</td><td style="padding-left: 36px;">'.$windSpeed.'</td></tr>'; 
print '<tr><td style="padding-left: 35px;">Dew Point</td><td style="padding-left: 36px;">'.$dewPoint.''.$tempd.'</td></tr>';
print '<tr><td style="padding-left: 35px;">Humidity</td><td style="padding-left: 36px;">'.$humidity.'%</td></tr>';
print '<tr><td style="padding-left: 35px;">Visibility</td><td style="padding-left: 36px;">'.$visibility.'</td></tr>';
print '<tr><td style="padding-left: 35px;">Sunrise</td><td style="padding-left: 36px;">'.date('h:i A',$sunriseTime).'</td></tr>';
print '<tr><td style="padding-left: 35px;">Sunset</td><td style="padding-left: 36px;">'.date('h:i A',$sunsetTime).'</td></tr>';
print '</table></div></div>';     
    

}
?>

    
</body>
    
</html>