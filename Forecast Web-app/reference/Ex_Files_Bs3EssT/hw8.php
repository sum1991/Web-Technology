<!DOCTYPE html>
<html>

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>    
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.js"></script>
	<script src="http://openlayers.org/api/OpenLayers.js"></script>
	<link rel="stylesheet" href="http://leaflet.cloudmade.com/dist/leaflet.css"> 
	<script type="text/javascript" src="moment.js"></script>
	<script type="text/javascript" src="moment-timezone.js"></script>
	<script type="text/javascript" src="moment-timezone-with-data.js"></script>

	
	<style>
		.table-striped>tbody>tr:nth-child(even)>td,
		.table-striped>tbody>tr:nth-child(even)>th {
			background-color: lightpink;
		}
		.nav-pills > li{
			background-color: #EEEEEE;  
		} 
		.table{
			background-color: white;  
		}
		.bgBrown
		{
			background-color: #EEEEEE;  
		} 
		.bgBlck
		{
			background-color: black;  
		} 		
		.bgBlue
		{
			background-color: blue;  
		} 	
		.bgRed
		{
			background-color: red;  
		} 	
		.bgTab1
		{
			background-color:#327CB7;
		}
		.bgTab2
		{
			background-color:#EF423E;
		}
		.bgTab3
		{
			background-color:#E88E48;
		}
		.bgTab4
		{
			background-color:#A7A52E;
		}
		.bgTab5
		{
			background-color:#986EA8;
		}
		.bgTab6
		{
			background-color:#F57B7C;
		}
		.bgTab7
		{
			background-color:#D04270;
		}
		.settingTab1
			{			   
			   margin-right: 6px;				
			   margin-top: 10px;				
			   margin-bottom: 10px;				
			   border-radius: 10px;
			}
			.settingTab
			{			   
			   margin-left: 6px;			   
			   margin-right: 6px;				
			   margin-top: 10px;				
			   margin-bottom: 10px;				
			   border-radius: 10px;
			}
			.fbIcon 
			{
				background-image: url("http://cs-server.usc.edu:45678/hw/hw8/images/fb_icon.png");
				background-position: center center;
				width : 40px;
				height : 40px;	
			}
			.myMap
			{
				width:50%;
				height: 500px;
     		}

			
			
			.services{
				background-color: black;
			}
			.icon {
			  max-width: 150px;
			  margin: 0 auto;
			  display: block;
			  color: white;
			}
			.Fontcolorclass{
				font-size: 27px;
			}
			.modal-body {
				overflow-y: hidden;
			}
				
				
				.modalfonts{
				font-weight: bold;
			font-size: 18px;
			}
			.modalsummary{
				font-size: 22px;
			}
			.week1{
				background-color: blue; 
				 margin-right: 6px;
				margin-top: 10px;
				margin-bottom: 10px;
				border-radius: 10px;
			}
			.week2{
				background-color: red; 
				
			}
			.week3{
				background-color: orange; 
				
			}
			.week4{
				background-color: forestgreen; 
				
			}
			.week5{
				background-color: purple; 
				
			}
			.week6{
				background-color: pink; 
				
			}
				.week7{
					background-color: #d04270;
				}    
			.seetingTab3
			{
			   margin-left: 6px;
			   margin-right: 6px;
				margin-top: 10px;
				margin-bottom: 10px;
				border-radius: 10px;
			}

			.rightTemp
			{
				color: white;
				font-size: 57px;
			}
			.rightsum{
				
			}
			.rightMaxMin{
				padding-top: 25px;
			}
			.transbox
			{
			  margin: 30px;
			  background-color: #ffffff;
			  border: 1px solid black;
			  opacity:0.6;
			  filter:alpha(opacity=60); /* For IE8 and earlier */
			}
			.frontData
			{
			  margin: 5%;
			  font-weight: bold;
			  color: #000000;
			}
			.textColorWhite
			{
				color:white
			}
							
	</style>
    </head>
    
    <body style="background-image:url('http://cs-server.usc.edu:45678/hw/hw8/images/bg.jpg'); ">
        <script>              

			var tempUnit="";
			var TimeZone="";
			function initFb()
			{
				  
				  window.fbAsyncInit = function() {
					FB.init({
					  appId      : '973547939357895',
					  xfbml      : true,
					  version    : 'v2.5'
					});
				  };

				  (function(d, s, id){
					 var js, fjs = d.getElementsByTagName(s)[0];
					 if (d.getElementById(id)) {return;}
					 js = d.createElement(s); js.id = id;
					 js.src = "//connect.facebook.net/en_US/sdk.js";
					 fjs.parentNode.insertBefore(js, fjs);
				   }(document, 'script', 'facebook-jssdk'));	
			}
			
			function postFb()
			{
				FB.ui(
				 {
				  method: 'share',
				  href: 'http://forecast.io/'
				}, function(response){
					if (response && !response.error_message) {
						  alert('Posted Successfully' );
						} else {
						  alert('Not Posted');
						}
				});				   			
			}
			
			function initMap(rawData)
			{
				var parsedData = jQuery.parseJSON(rawData);
				var latitude = parsedData.latitude;
				var longitude = parsedData.longitude;
							//Center of map
				var lonlat = new OpenLayers.LonLat( longitude,latitude);

				var map = new OpenLayers.Map("mapId");
				// Create OSM overlays
				var mapnik = new OpenLayers.Layer.OSM();
				    var layer_cloud = new OpenLayers.Layer.XYZ(
						"clouds",
						"http://${s}.tile.openweathermap.org/map/clouds/${z}/${x}/${y}.png",
						{
							isBaseLayer: false,
							opacity: 0.7,
							sphericalMercator: true
						}
					);

					var layer_precipitation = new OpenLayers.Layer.XYZ(
						"precipitation",
						"http://${s}.tile.openweathermap.org/map/precipitation/${z}/${x}/${y}.png",
						{
							isBaseLayer: false,
							opacity: 0.7,
							sphericalMercator: true
						}
					);


					map.addLayers([mapnik, layer_precipitation, layer_cloud]);					     	
				    map.setCenter(new OpenLayers.LonLat(longitude, latitude).transform('EPSG:4326', 'EPSG:3857'), 18);
			}
			
			function getImageName(icon)
			{
				var icon_image="";
			     switch(icon)
					{
						case "clear-day":icon_image ="clear.png";break;
						case "clear-night":icon_image ="clear_night.png";break;
						case "rain":icon_image ="rain.png";break;
						case "snow":icon_image ="snow.png";break;
						case "sleet":icon_image="sleet.png";break;
						case "wind":icon_image ="wind.png";break;
						case "fog":icon_image ="fog.png";break;
						case "cloudy":icon_image ="cloudy.png";break;
						case "partly-cloudy-day":icon_image ="cloud_day.png";break;
						case "partly-cloudy-night":icon_image ="cloud_night.png";break;
						default : break;
					}
					return "http://cs-server.usc.edu:45678/hw/hw8/images/"+icon_image;
			}
			
			function getPrecipIntensity(precipVAl)
			{
				var precipIntensity="none";
					if(precipVAl >= 0 && precipVAl<0.002)
						precipIntensity="none";
					if(precipVAl >= 0.002 && precipVAl<0.017)
						precipIntensity="Very Light";
					if(precipVAl >= 0.017 && precipVAl<0.1)
						precipIntensity="Light";
					if(precipVAl >= 0.1 && precipVAl<0.4)
						precipIntensity="Moderate";
					if(precipVAl >= 0.4)
						precipIntensity="Heavy";
				
				return precipIntensity;
			}
			
			function fillRightNowData(rawData)
			{
			   var parsedData = jQuery.parseJSON(rawData);
			   TimeZone = parsedData.timezone;
			   
			   $("#weatherIcon").html("<img id=\"wIcon\" src="+getImageName(parsedData.currently.icon)+" width=200px/>");
			   
			   var location = $("#city").val() + ","+$("#state").val();
			   var summary = "<p style=\"color: white;\">"+parsedData.currently.summary+" "+location+"</p>";
			   var tempType = "";
			   
			   if(tempUnit == "Fahrenheit")
				   tempType = " &#8457"
			   else
				   tempType = " &#8451"
			   
			   var temperature = "<h1 style=\"color:white;font-size:57px;\">"+Math.floor(parsedData.currently.temperature)+tempType+"</h1>";
			   var lowTemp = Math.floor(parsedData.daily.data[0].temperatureMax);
			   var highTemp = Math.floor(parsedData.daily.data[0].temperatureMin);
			   var extraSpace="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
			   var fbButton = "<img id=\"fb\" src=\"http://cs-server.usc.edu:45678/hw/hw8/images/fb_icon.png\" width=\"68px\" height=\"80px\" />";
			   var lowHigh="<p><span style=\"color: blue;\">"+"L:"+lowTemp+"</span>|<span style=\"color: green;\">"+"H:"+highTemp+extraSpace+fbButton+"</p>";			 
			   
			   $("#tempDetails").html(summary+temperature+lowHigh);
			   
			   var precipIntensity = parsedData.currently.precipIntenextraSpacesity;
			   var rainChance = Math.floor(parsedData.currently.precipProbability*100)+"%";
			   var windSpeed = parsedData.currently.windSpeed;
			   var dewPoint = parsedData.currently.dewPoint;
			   var humidity = Math.floor(parsedData.currently.humidity*100)+"%";
			   var visibility = parsedData.currently.visibility;
			   var sunrisetime = getTime(parsedData.daily.data[0].sunriseTime);
			   var sunsettime = getTime(parsedData.daily.data[0].sunsetTime);
			   
			   var precipitation ="<tr><td>Precipitation</td><td>"+getPrecipIntensity(precipIntensity)+"</td></tr>";
			   var rchance="<tr><td>Chances of Rain</td><td>"+rainChance+"</td></tr>";
			   var wspd="<tr><td>Wind Speed</td><td>"+windSpeed+"</td></tr>";
			   var dpt="<tr><td>Dew Point</td><td>"+dewPoint+"</td></tr>"
			   var hudty="<tr><td>Humidity</td><td>"+humidity+"</td></tr>";
			   var visity="<tr><td>Visibility</td><td>"+visibility+"</td></tr>";
			   var srt="<tr><td>Sunrise</td><td>"+sunrisetime+"</td></tr>";
			   var sst="<tr><td>Sunset</td><td>"+sunsettime+"</td></tr>";
			   
			   
			   $("#tab1table").html("");
			   $("#tab1table").append(precipitation+rchance+wspd+dpt+hudty+visity+srt+sst);
			 
				$("#fb").on('click', function (e) {
					alert("fb success");
					postFb();
				})			 
			}
			
			
			function unhideTabs()
			{
				document.getElementById("tabDiv").style.visibility="visible";
				document.getElementById("tabData").style.visibility="visible";
			}
			function hideTabs()
			{
				document.getElementById("tabDiv").style.visibility="hidden";
				document.getElementById("tabData").style.visibility="hidden";
			}
			
			
			function getTime(unixTime)
			{
				var format = ' hh:mm A';
				var convertMyTimeStamp = moment( unixTime * 1000).tz(TimeZone).format(format);
				return convertMyTimeStamp;
			}
			
			function fillNext24Hours(rawData)
			{
				var htmlData = "";
				var tableHeader = "<table class=\"table\"><thead class=\"info\"><td> Time </td><td> Summary </td><td> Cloud Cover </td><td> Temp(F) </td><td> View Details </td></thead>";
				var finalHtmlOutput = tableHeader;
				
				 var parsedData = jQuery.parseJSON(rawData);
				 for(var i =0;i<24;i++)
				 {
					 var time = getTime(parsedData.hourly.data[i].time);
					 var icon_path=getImageName(parsedData.hourly.data[i].icon);
					 var cloudCover = Math.floor(parsedData.hourly.data[i].cloudCover)+"%";
					 var temp=parsedData.hourly.data[i].temperature;
					 var wind=parsedData.hourly.data[i].windSpeed;
					 var humidity=Math.floor(parsedData.hourly.data[i].humidity)+"%";
					 var visibility = parsedData.hourly.data[i].visibility;
					 var pressure = parsedData.hourly.data[i].pressure;
					 var ids="ids"+i;
					 var htmlData = "<table class=\"table\"><tr><td>" + time +" </td><td>"+"<img src="+icon_path+" width=50px height=50px/>  </td><td>" + cloudCover +" </td><td> "+ temp +" </td><td><button type=\"button\" class=\"btn btn-info\" data-toggle=\"collapse\" data-target=\"#"+ids+"\">+</button></td></tr></table><div id=\""+ids+"\" class=\"collapse\"><table class=\"table\"> <thead><td>Wind</td><td>Humidity</td><td>Visibility</td><td>Pressure</td></thead> <tr><td>"+wind+"</td><td>"+humidity+"</td><td>"+visibility+"</td><td>"+pressure+"</td></tr></table> </div>";
					 finalHtmlOutput += htmlData;
					 
				 }
				 $("#next24").html(finalHtmlOutput);
			}
			
			function fillNext7Days(rawData)
			{
				var parsedData = jQuery.parseJSON(rawData);
				mytab3Function(parsedData);
			}
					
			function submitFunction()
			{							
				tempUnit = $("input[name=temperature]:checked").val();
				$.ajax({
					url: "processhw8.php",	
					contentType:"text",
					dataType:"text",					
					data: 
						{ 							
							Address : $("#address").val(),
							City: $("#city").val(),
							State : $("#state").val(),
							Temperature : $("input[name=temperature]:checked").val()
						},
					type: "GET",
					success: function(output) {	
					
						fillRightNowData(output);
						fillNext24Hours(output);
						fillNext7Days(output);
						initMap(output);
						initFb();
						unhideTabs();
					},
					error: 
						function(xhr, status, error)
						{
							  alert("error");
						}
			});
			}
			
			function parseJsonData(jsonData)
			{
				var parsedData = jQuery.parseJSON(jsonData);
			
			}
						
     		function clearFunc(){			
				hideTabs();
				$("#address").val("");
				$("#city").val("");				
				document.getElementsByName("temperature")[0].checked = true;
				document.getElementsByName("State")[0].selectedIndex = 0;				
			}
			$(document).ready(function(){	
			
				$("#form1").submit(submitFunction);
				$("#clear").on('click', clearFunc);
			});		

			function mytab3Function(parseData3)
					{
					   
						for(var i=1;i<=7;i++)
						{
							var t = new Date(Number(parseData3.daily.data[i-1].time));
							var month = t.getMonth();
							var day = t.getDay();
							var year = t.getYear();
							var hours = t.getHours();
							var month = setMonth(month);
							var day = setDay(day);
							$("#week"+i+"Tab1").html("<p>"+day+"</p>");
							$("#week"+i+"Tab2").html("<p>"+month+"</p>");
							var iconData = seticonFortab3(parseData3.daily.data[i-1].icon);
							iconData="http://cs-server.usc.edu:45678/hw/hw8/images/"+iconData;
							$("#week"+i+"Tab3").html("<img width='56px' id='theImg"+i+"'/>");
							$("#theImg"+i).attr("src",iconData);
							setTempSymbol(parseData3.daily.data[i-1].temperatureMin,parseData3.daily.data[i-1].temperatureMax,i);
							setModalLoop(day,month,iconData,parseData3.daily.data[i-1].summary,parseData3.daily.data[i-1].sunriseTime,parseData3.daily.data[i-1].sunsetTime,parseData3.daily.data[i-1].humidity,parseData3.daily.data[i-1].windSpeed,parseData3.daily.data[i-1].visibility,i);
						}
					}

					
				function setModalLoop(day,month,iconData,summary,rise,set,humdity,windspeed,visib,i)
				{										
						$("#ModalImage"+i).html("<img width='161px;'id='Img"+i+"'/>");
						$("#Img"+i+"").attr("src",iconData);
						$("#ModalSummary"+i).html("<p>"+summary+"</p>");
						$("#Sunrise"+i).html("<p class='modalfonts'>Sunrise</p><p>"+rise+"</p>");
						$("#Sunset"+i).html("<p class='modalfonts'>SunSet</p><p>"+set+"</p>");
						$("#Humidity"+i).html("<p class='modalfonts'>Humiditity</p><p>"+humdity+"</p>");
					    $("#WindSpeed"+i).html("<p class='modalfonts'>Windspeed</p><p>"+windspeed+"</p>");
					   $("#Visibility"+i).html("<p class='modalfonts'>Visibility</p><p>"+visib+"</p>");									
				}
				
				function setMonth(iconVal)
				{
				switch(iconVal)
				 {
					    case 0:
							finalImage = "January";
							break;
						case 1:
							finalImage = "Febrauray";
							break;
						case 2:
						  finalImage = "Marach";
							break;
						case 3:
						   finalImage = "April";
							break;
								 case 4:
							finalImage = "May";
							break;
								case 5:
							finalImage = "june";
							break;
								case 6:
						   finalImage = "july";
							break;
								case 7:
						   finalImage = "August";
							break;
							   case 8:
							finalImage = "September";
							break;
								case 9:
						   finalImage = "October";
							break;
							case 10:
						   finalImage = "November";
							break;
							case 11:
						   finalImage = "December";
							break;
						default:
							finalImage = "cloud_night.png";
						}
					return finalImage;
				}
				
				 function setDay(iconVal)
				{
				switch(iconVal)
				 {
				 case 0:
					finalDay = "Sunday";
					break;
				case 1:
					finalDay = "Monday";
					break;
				case 2:
				  finalDay = "Tuesday";
					break;
				case 3:
				   finalDay = "Wednesday";
					break;
				case 4:
					finalDay = "Thursday";
					break;
				case 5:
					finalDay = "Friday";
					break;
				case 6:
				   finalDay = "Saturday";
					break;
				default:
					finalDay = "cloud_night.png";
			}
					   return finalDay;
					
				}
					
				
				
				function setTempSymbol(temp1,temp2,i)
					{     
						$("#week"+i+"Tab4").html("Min<br>Temp");
						$("#week"+i+"Tab5").html(temp1);
						$("#week"+i+"Tab6").html("Max<br>Temp");
						$("#week"+i+"Tab7").html(temp2);
					}
					
				  function  seticonFortab3(iconVal)
				   {
					   
					   switch(iconVal)
				 {
				case "clear-day":
					finalImage = "clear.png";
					break;
				case"clear-night":
				  finalImage = "clear_night.png";
					break;
				case "rain":
				   finalImage = "rain.png";
					break;
						 case "snow":
					finalImage = "snow.png";
					break;
						case "sleet":
					finalImage = "sleet.png";
					break;
						case "wind":
				   finalImage = "wind.png";
					break;
						case "fog":
				   finalImage = "fog.png";
					break;
					   case "cloudy":
					finalImage = "cloudy.png";
					break;
						case "partly-cloudy-day":
				   finalImage = "cloud_day.png";
					break;
					case "partly-cloudy-night":
				   finalImage = "cloud_night.png";
					break;
				default:
					finalImage = "cloud_night.png";
			}
					   return finalImage;
				   }
							
        </script>
        
        
        <div class="container"  >            
            <div class="row" style="background-color: rgba(180,180,180,0.6);">
			<section class="col-md-12">
                <form class="form-inline" id="form1" onsubmit="return false">
                    <div>
                        <h1><center>            Forecast Search       </center>      </h1>
                    </div>
                    <div class="form-group">
                        <div class="input-group ">
                            <label for="Address" class="textColorWhite">Street Address</label>
                          <input class="form-control" name="Address" type="text" id="address"  size="10" placeholder="Enter Street Address" >  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group" >
                          <label for="City" class="textColorWhite">City</label>
                          <input class="form-control" name="City" type="text" id="city"  size="10" placeholder="Enter the city name">  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label for="State" class="textColorWhite">State</label>
                            <select class="form-control" name="State" id="state"  class="form-control select2">                            
                                <option value="None">Select Your State</option>
                                <option value="CA">California</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <h5><b class="textColorWhite">Degree</b></h5>
                        <div class="input-group">                                                        
                              <label class="radio-inline textColorWhite"> 
                                  <input  name="temperature" type="radio" value="Fahrenheit" checked>
                                  Fahrenheit
                              </label >
                              <label class="radio-inline textColorWhite"> 
                                  <input name="temperature" type="radio" value="Celsius">
                                  Celsius
                              </label>                             
                        </div>
                   </div>
                   <div class="form-group">
                          <button type="submit" class="btn btn-primary">
                             <span class="glyphicon glyphicon-search"></span>Search
                        </button>
                          <button type="button" id="clear" class="btn btn-default">
                             <span class="glyphicon glyphicon-refresh"></span>Clear
                          </button>
                    </div>
                </form>
			</div>

			</section>
		
		
					<div id="tabDiv" style="visibility:hidden">
						 <ul class="nav nav-pills">
							<li class="active"><a data-toggle="pill" href="#rightnow">RightNow</a></li>							
							<li><a data-toggle="pill" href="#next24">Next 24 Hours</a></li>
							<li><a data-toggle="pill" href="#next7">Next 7 Days</a></li>
						  </ul>
					  </div>
							<div class="tab-content" id="tabData" style="visibility:hidden">
									<div id="rightnow" class="tab-pane fade in active" >									
										<div class="row">
											<div class="col-sm-6" >									
											  
											    <div id="weatherIcon"class="col-lg-6 bgTab6">
													
												</div>
												<div id="tempDetails" class="col-lg-6 bgTab6">
												    
												</div>																							 
												 <table class="table table-striped" id="tab1table">
													
												 </table>
											</div>
												  <div class="col-sm-6 myMap" id="mapId" >
													
												  </div>
									    </div>
									</div>										  
								    

								<div id="next24" class="tab-pane fade bgBrown">
							
								</div>
								<div id="next7" class="tab-pane fade">
								  <div class="container bgBlck">
									  <div class="row ">
										<section class=" week1 col-lg-1 col-lg-offset-2" role="button" data-toggle="modal" data-target="#myModal">
												<div id="week1Tab1"> </div>
												<div id="week1Tab2"> </div>
												<div id="week1Tab3"> </div>
												<div id="week1Tab4"> </div>
												<div id="week1Tab5" class="Fontcolorclass"></div>
												<div id="week1Tab6"></div>
												<div id="week1Tab7" class="Fontcolorclass"></div>
											</section>

										 <section class=" week2 seetingTab3 col-lg-1" role="button" data-toggle="modal" data-target="#myModal2">
											  <div id="week1Tab1"></div>
												<div id="week2Tab2"></div>
												<div id="week2Tab3"></div>
												<div id="week2Tab4"></div>
												<div id="week2Tab5" class="Fontcolorclass"></div>
												<div id="week2Tab6"></div>
												<div id="week2Tab7" class="Fontcolorclass"></div>
											</section>

										  <section class="week3 seetingTab3 col-lg-1" role="button" data-toggle="modal" data-target="#myModal3">
											  <div   id="week1Tab1"></div>
												<div id="week3Tab2"></div>
												<div id="week3Tab3"></div>
												<div id="week3Tab4"></div>
												<div id="week3Tab5" class="Fontcolorclass"></div>
												<div id="week3Tab6"></div>
												<div id="week3Tab7" class="Fontcolorclass"></div>
											</section>

										   <section class="week4 seetingTab3 col-lg-1" role="button" data-toggle="modal" data-target="#myModal4">
											<div id="week1Tab1"></div>
												<div id="week4Tab2"></div>
												<div id="week4Tab3"></div>
												<div id="week4Tab4"></div>
												<div id="week4Tab5" class="Fontcolorclass"></div>
												<div id="week4Tab6"></div>
												<div id="week4Tab7" class="Fontcolorclass"></div>
											</section>

										   <section class="week5 seetingTab3 col-lg-1" role="button" data-toggle="modal" data-target="#myModal5">
											<div id="week1Tab1"></div>
												<div id="week5Tab2"></div>
												<div id="week5Tab3"></div>
												<div id="week5Tab4"></div>
												<div id="week5Tab5" class="Fontcolorclass"></div>
												<div id="week5Tab6"></div>
												<div id="week5Tab7" class="Fontcolorclass"></div>
											</section>

										 <section class="week6 seetingTab3 col-lg-1" role="button" data-toggle="modal" data-target="#myModal6">
											   <div id="week6Tab1"></div>
												<div id="week6Tab2"></div>
												<div id="week6Tab3"></div>
												<div id="week6Tab4"></div>
												<div id="week6Tab5" class="Fontcolorclass"></div>
												<div id="week6Tab6"></div>
												<div id="week6Tab7" class="Fontcolorclass"></div>
											</section>
											<section class=" week7 seetingTab3 col-lg-1" role="button" data-toggle="modal" data-target="#myModal7">
												<div id="week7Tab1"></div>
												<div id="week7Tab2"></div>
												<div id="week7Tab3"></div>
												<div id="week7Tab4"></div>
												<div id="week7Tab5" class="Fontcolorclass"></div>
												<div id="week7Tab6"></div>
												<div id="week7Tab7" class="Fontcolorclass"></div>
											</section> 
									  
									  </div><!-- row -->   
								 </div>
								 
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Modal title</h4>
									  </div>
									  <div class="modal-body" style="text-align: -moz-center;">
											<div class="Row"> 
											<div id="ModalImage1">
												
											</div>
											 <div id="ModalSummary1" class="modalsummary">
												
											</div>
											</div>
											<div class="Row">
												 <div class="col-lg-4">
											<div id="Sunrise1">
												
												jfhgdhgwifdajkjxa
											</div>
											  <div id="Sunset1">
												  jfhgdhgwifdajkjxahhjbj
											</div>        
											</div>
												 <div id="" class="col-lg-4">
											<div id="Humidity1">
												jfhgdhgwifdajkjxa
											</div>
												<div id="WindSpeed1">
											
													 jfhgdhgwifdajkjxa
													 </div>
											</div>
												 <div class="col-lg-4">
										 
											<div id="Visibility1">
											
													
													 </div>
										   <div id="Pressure1">
											
													 
													 </div>
											</div>
									  </div>
										 
										</div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									  </div>
									</div>
								  </div>
								</div>	
								<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Modal title</h4>
									  </div>
									  <div class="modal-body" style="text-align: -moz-center;">
											<div class="Row"> 
											<div id="ModalImage2">
												
											</div>
											 <div id="ModalSummary2" class="modalsummary">
												
											</div>
											</div>
											<div class="Row">
												 <div class="col-lg-4">
											<div id="Sunrise2">
												
												jfhgdhgwifdajkjxa
											</div>
											  <div id="Sunset2">
												  jfhgdhgwifdajkjxahhjbj
											</div>        
											</div>
												 <div id="" class="col-lg-4">
											<div id="Humidity2">
												jfhgdhgwifdajkjxa
											</div>
												<div id="WindSpeed2">
											
													 jfhgdhgwifdajkjxa
													 </div>
											</div>
												 <div class="col-lg-4">
										 
											<div id="Visibility2">
											
													
													 </div>
										   <div id="Pressure2">
											
													 
													 </div>
											</div>
									  </div>
										 
										</div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									  </div>
									</div>
								  </div>
								</div>	
								<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Modal title</h4>
									  </div>
									  <div class="modal-body" style="text-align: -moz-center;">
											<div class="Row"> 
											<div id="ModalImage3">
												
											</div>
											 <div id="ModalSummary3" class="modalsummary">
												
											</div>
											</div>
											<div class="Row">
												 <div class="col-lg-4">
											<div id="Sunrise3">
												
												jfhgdhgwifdajkjxa
											</div>
											  <div id="Sunset3">
												  jfhgdhgwifdajkjxahhjbj
											</div>        
											</div>
												 <div id="" class="col-lg-4">
											<div id="Humidity3">
												jfhgdhgwifdajkjxa
											</div>
												<div id="WindSpeed3">
											
													 jfhgdhgwifdajkjxa
													 </div>
											</div>
												 <div class="col-lg-4">
										 
											<div id="Visibility3">
											
													
													 </div>
										   <div id="Pressure3">
											
													 
													 </div>
											</div>
									  </div>
										 
										</div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									  </div>
									</div>
								  </div>
								</div>	
								 <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Modal title</h4>
									  </div>
									  <div class="modal-body" style="text-align: -moz-center;">
											<div class="Row"> 
											<div id="ModalImage4">
												
											</div>
											 <div id="ModalSummary4" class="modalsummary">
												
											</div>
											</div>
											<div class="Row">
												 <div class="col-lg-4">
											<div id="Sunrise4">
												
												jfhgdhgwifdajkjxa
											</div>
											  <div id="Sunset4">
												  jfhgdhgwifdajkjxahhjbj
											</div>        
											</div>
												 <div id="" class="col-lg-4">
											<div id="Humidity4">
												jfhgdhgwifdajkjxa
											</div>
												<div id="WindSpeed4">
											
													 jfhgdhgwifdajkjxa
													 </div>
											</div>
												 <div class="col-lg-4">
										 
											<div id="Visibility4">
											
													
													 </div>
										   <div id="Pressure4">
											
													 
													 </div>
											</div>
									  </div>
										 
										</div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									  </div>
									</div>
								  </div>
								</div>
								<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Modal title</h4>
								  </div>
								  <div class="modal-body" style="text-align: -moz-center;">
										<div class="Row"> 
										<div id="ModalImage5">
											
										</div>
										 <div id="ModalSummary5" class="modalsummary">
											
										</div>
										</div>
										<div class="Row">
											 <div class="col-lg-4">
										<div id="Sunrise5">
											
											jfhgdhgwifdajkjxa
										</div>
										  <div id="Sunset5">
											  jfhgdhgwifdajkjxahhjbj
										</div>        
										</div>
											 <div id="" class="col-lg-4">
										<div id="Humidity5">
											jfhgdhgwifdajkjxa
										</div>
											<div id="WindSpeed5">
										
												 jfhgdhgwifdajkjxa
												 </div>
										</div>
											 <div class="col-lg-4">
									 
										<div id="Visibility5">
										
												
												 </div>
									   <div id="Pressure5">
										
												 
												 </div>
										</div>
								  </div>
									 
									</div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								  </div>
								</div>
							  </div>
							</div>
						   <div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Modal title</h4>
							  </div>
							  <div class="modal-body" style="text-align: -moz-center;">
									<div class="Row"> 
									<div id="ModalImage6">
										
									</div>
									 <div id="ModalSummary6" class="modalsummary">
										
									</div>
									</div>
									<div class="Row">
										 <div class="col-lg-4">
									<div id="Sunrise6">
										
										jfhgdhgwifdajkjxa
									</div>
									  <div id="Sunset6">
										  jfhgdhgwifdajkjxahhjbj
									</div>        
									</div>
										 <div id="" class="col-lg-4">
									<div id="Humidity6">
										jfhgdhgwifdajkjxa
									</div>
										<div id="WindSpeed6">
									
											 jfhgdhgwifdajkjxa
											 </div>
									</div>
										 <div class="col-lg-4">
								 
									<div id="Visibility6">
									
											
											 </div>
								   <div id="Pressure6">
									
											 
											 </div>
									</div>
							  </div>
								 
								</div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							  </div>
							</div>
						  </div>
						</div>							
                       <div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Modal title</h4>
						  </div>
						  <div class="modal-body" style="text-align: -moz-center;">
								<div class="Row"> 
								<div id="ModalImage7">
									
								</div>
								 <div id="ModalSummary7" class="modalsummary">
									
								</div>
								</div>
								<div class="Row">
									 <div class="col-lg-4">
								<div id="Sunrise7">
									
									jfhgdhgwifdajkjxa
								</div>
								  <div id="Sunset7">
									  
								</div>        
								</div>
									 <div id="" class="col-lg-4">
								<div id="Humidity7">
									
								</div>
									<div id="WindSpeed7">
								
									   
										 </div>
								</div>
									 <div class="col-lg-4">
							 
								<div id="Visibility7">
								
										
										 </div>
							   <div id="Pressure7">
								
										 
										 </div>
								</div>
						  </div>
							 
							</div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						  </div>
						</div>
					  </div>
					</div>   						
				</div>
													 
		</div>				  
					
				                       
    </body>
    
</html>
