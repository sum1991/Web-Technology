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
	<script src="http://leaflet.cloudmade.com/dist/leaflet.js"></script>
	
	<style>
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
				height: 400px;
     		}
	</style>
    </head>
    
    <body style="background-image:url('http://cs-server.usc.edu:45678/hw/hw8/images/bg.jpg'); ">
        <script>              

			var tempUnit="";
			var rightNowData = {
				timeZone:"",
				imageIcon : "",
				summary:"",
				location:"",
				temperature:"",
				lowTemperature:"",
				highTemperature:"",
				precipitation:"",
				chancesOfRain:"",
				windSpeed:"",
				dewPoint:"",
				humidity:"",
				visibility:"",
				sunRise:"",
				sunSet:""				
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
				var precipIntensity="";
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
			   var lowHigh="<p><span style=\"color: blue;\">"+"L:"+lowTemp+"</span>|<span style=\"color: green;\">"+"H:"+highTemp+"</p>";			 
			   var fbButton = "<button class=\"btn \"><img src=\"http://cs-server.usc.edu:45678/hw/hw8/images/fb_icon.png\" width=\"30px\" height=\"30px\" /> </button>";
			   $("#tempDetails").html(summary+temperature+lowHigh+fbButton);
			   
			   var precipIntensity = parsedData.currently.precipIntensity;
			   var rainChance = Math.floor(parsedData.currently.precipProbability*100)+"%";
			   var windSpeed = parsedData.currently.windSpeed;
			   var dewPoint = parsedData.currently.dewPoint;
			   var humidity = Math.floor(parsedData.currently.humidity*100)+"%";
			   var visibility = parsedData.currently.visibility;
			   var sunrisetime = parsedData.daily.data[0].sunriseTime;
			   var sunsettime = parsedData.daily.data[0].sunsetTime;
			   
			   var precipitation =" <tr><td>Precipitation</td><td>"+getPrecipIntensity(precipIntensity)+"</td></tr>";
			   var rchance="<tr><td>Chances of Rain</td><td>"+rainChance+"</td></tr>";
			   var wspd="<tr><td>Wind Speed</td><td>"+windSpeed+"</td></tr>";
			   var dpt="<tr><td>Dew Point</td><td>"+dewPoint+"</td></tr>"
			   var hudty="<tr><td>Humidity</td><td>"+humidity+"</td></tr>";
			   var visity="<tr><td>Visibility</td><td>"+visibility+"</td></tr>";
			   var srt="<tr><td>Sunrise</td><td>"+sunrisetime+"</td></tr>";
			   var sst="<tr><td>Sunset</td><td>"+sunsettime+"</td></tr>";
			   
			   
			   $("#tab1table").append(precipitation+rchance+wspd+dpt+hudty+visity+srt+sst);
			   
			}
			
			function fillNext24Hours(rawData)
			{
				var htmlData = "";
				var tableHeader = "<table class=\"table\"><thead class=\"info\"><td> Time </td><td> Summary </td><td> Cloud Cover </td><td> Temp(F) </td><td> View Details </td></thead>";
				var finalHtmlOutput = tableHeader;
				
				 var parsedData = jQuery.parseJSON(rawData);
				 for(var i =0;i<24;i++)
				 {
					   var time = parsedData.hourly.data[i].time
					 //var t = new Date(time);
					 //var formatted = t.format("dd.mm.yyyy hh:MM");
					    var t = new Date(Number(time));
    					var month = t.getMonth();
						var day = t.getDay();
						var year = t.getYear();
						var hours = t.getHours();
					 
					 var icon_path=getImageName(parsedData.hourly.data[i].icon);
					 var cloudCover = Math.floor(parsedData.hourly.data[i].cloudCover)+"%";
					 var temp=parsedData.hourly.data[i].temperature;
					 var wind=parsedData.hourly.data[i].windSpeed;
					 var humidity=Math.floor(parsedData.hourly.data[i].humidity)+"%";
					 var visibility = parsedData.hourly.data[i].visibility;
					 var pressure = parsedData.hourly.data[i].pressure;
					 var ids="ids"+i;
					 var htmlData = "<table class=\"table\"><tr><td>" + hours +" </td><td>"+"<img src="+icon_path+" width=50px height=50px/>  </td><td>" + cloudCover +" </td><td> "+ temp +" </td><td><button type=\"button\" class=\"btn btn-info\" data-toggle=\"collapse\" data-target=\"#"+ids+"\">+</button</td></tr></table><div id=\""+ids+"\" class=\"collapse\"><table class=\"table\"> <thead><td>Wind</td><td>Humidity</td><td>Visibility</td><td>Pressure</td></thead> <tr><td>"+wind+"</td><td>"+humidity+"</td><td>"+visibility+"</td><td>"+pressure+"</td></tr></table> </div>";
					 finalHtmlOutput += htmlData;
					 
				 }
				 $("#next24").html(finalHtmlOutput);
			}
			
			function fillNext7Days(rawData)
			{
				
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
						alert("success"+output);
						//parseJsonData(output);
						fillRightNowData(output);
						fillNext24Hours(output);
						initMap(output);
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
				alert("Latitude "+parsedData.latitude);
			}
			
			$(document).ready(function(){	
			
				$("#form1").submit(submitFunction);
					
				});			
        </script>
        
        
        <div class="container" >            
            <div class="row">
			<section class="col-md-12">
                <form class="form-inline" id="form1" onsubmit="return false">
                    <div>
                        <h1>            Forecast Search             </h1>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label for="Address">Street Address</label>
                          <input class="form-control" name="Address" type="text" id="address" placeholder="Enter Street Address" >  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                          <label for="City">City</label>
                          <input class="form-control" name="City" type="text" id="city" placeholder="Enter the city name">  
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label for="State">State</label>
                            <select class="form-control" name="State" id="state" class="form-control select2">                            
                                <option value="None">Select Your State</option>
                                <option value="CA">California</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <h4>Degree</h4>
                        <div class="input-group">                                                        
                              <label class="radio-inline"> 
                                  <input name="temperature" type="radio" value="Fahrenheit" checked>
                                  Fahrenheit
                              </label >
                              <label class="radio-inline"> 
                                  <input name="temperature" type="radio" value="Celsius">
                                  Celsius
                              </label>                             
                        </div>
                </div>
                    <div class="form-group">
                          <button type="submit" class="btn btn-primary">
                             <span class="glyphicon glyphicon-search"></span>Search
                        </button>
                          <button type="button" class="btn btn-default">
                             <span class="glyphicon glyphicon-refresh"></span>Clear
                          </button>
                    </div>					
                </form>
			</div>
			</section>
		
		
					
						 <ul class="nav nav-pills">
							<li class="active"><a data-toggle="pill" href="#rightnow">RightNow</a></li>							
							<li><a data-toggle="pill" href="#next24">Next 24 Hours</a></li>
							<li><a data-toggle="pill" href="#next7">Next 7 Days</a></li>
						  </ul>
					  
							<div class="tab-content">
									<div id="rightnow" class="tab-pane fade in active" >									
										<div class="row">
											<div class="col-sm-6" >									
											  
											    <div id="weatherIcon"class="col-lg-6 bgTab6">
													
												</div>
												<div id="tempDetails" class="col-lg-6 bgTab6">
												    
												</div>												
											 
												 <table id="tab1table" class="table">
													
												 </table>
											</div>
												  <div class="col-sm-6 myMap" id="mapId" >
													
												  </div>
									    </div>
									</div>										  
								    

								<div id="next24" class="tab-pane fade bgBrown">
							
								</div>
								<div id="next7" class="tab-pane fade">
								  <div class="services container bgBlck">
										  <div class="row ">

   										  <section class="col-lg-1 col-lg-offset-3 bgTab1 settingTab1 " role="button" data-toggle="modal" data-target="#myModal">										  
											  <img class="icon" src="images/icon-exoticpets.svg" alt="Icon">
											  <h3>Exotic Pets</h3>
											  <p>We offer specialized care for reptiles, rodents, birds, and other exotic pets.</p>
											</section>
											

 										  <section class="col-lg-1 bgTab2 settingTab " role="button" data-toggle="modal" data-target="#myModal">
											  <img class="icon" src="images/icon-exoticpets.svg" alt="Icon">
											  <h3>Exotic Pets</h3>
											  <p>We offer specialized care for reptiles, rodents, birds, and other exotic pets.</p>
											</section>

											<section class="col-lg-1 bgTab3 settingTab" role="button" data-toggle="modal" data-target="#myModal">
											  <img class="icon" src="images/icon-exoticpets.svg" alt="Icon">
											  <h3>Exotic Pets</h3>
											  <p>We offer specialized care for reptiles, rodents, birds, and other exotic pets.</p>
											</section>

										  <section class="col-lg-1 bgTab4 settingTab" role="button" data-toggle="modal" data-target="#myModal">
											  <img class="icon" src="images/icon-exoticpets.svg" alt="Icon">
											  <h3>Exotic Pets</h3>
											  <p>We offer specialized care for reptiles, rodents, birds, and other exotic pets.</p>
											</section>

										  <section class="col-lg-1 bgTab5 settingTab" role="button" data-toggle="modal" data-target="#myModal">
											  <img class="icon" src="images/icon-exoticpets.svg" alt="Icon">
											  <h3>Exotic Pets</h3>
											  <p>We offer specialized care for reptiles, rodents, birds, and other exotic pets.</p>
											</section>

										  <section class="col-lg-1 bgTab6 settingTab" role="button" data-toggle="modal" data-target="#myModal">
											  <img class="icon" src="images/icon-exoticpets.svg" alt="Icon">
											  <h3>Exotic Pets</h3>
											  <p>We offer specialized care for reptiles, rodents, birds, and other exotic pets.</p>
											</section>

										  <section class="col-lg-1 bgTab7 settingTab" role="button" data-toggle="modal" data-target="#myModal">
											  <img class="icon" src="images/icon-exoticpets.svg" alt="Icon">
											  <h3>Exotic Pets</h3>
											  <p>We offer specialized care for reptiles, rodents, birds, and other exotic pets.</p>
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
											  <div class="modal-body">
												...
											  </div>
											  <div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="button" class="btn btn-primary">Save changes</button>
											  </div>
											</div>
										  </div>
										</div>								
							  </div>
													 
		</div>				  
					
				                       
    </body>
    
</html>
