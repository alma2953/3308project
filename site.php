<?php
  ob_start();
  session_start();
  require_once("includes/functions.php");

  if(isset($_SESSION['id']) == null)
  {
    $var1 = "Login";
    $var2 = "Register";
    $path1 = "public/log_in.php";
    $path2 = "public/register.php";
  }
  else
  {
    $var1 = "Logout";
    $var2 = "Favorites";
    $path1 = "public/log_out.php";
    $path2 = "#";
  }

  if(isset($_POST['addplace']))
  {
    $place = $_POST['addplace'];
    $arr = getCoordinates($place);

    $lat = $arr['lat'];
    $lng = $arr['lng'];

    insert_Places($lng, $lat, $place, $_SESSION['id']);
  }
?>

<html>
  <head>
    <title>Trendzy</title>

    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div  id="map-canvas"></div>

    
    <style>

      @font-face {
          font-family: buffalo;
          src: url(BuffaloScript-Regular.otf);
      }

      .dropdown-content {
          display: none;
          position: ;
          background-color: #f9f9f9;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
      }

      .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
          text-align: center;
      }

      .dropdown-content a:hover {background-color: gray;}

      .dropdown:hover .dropdown-content {
          display: block;
      }
      .show {
        display: block;
      }
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
            #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
      body {
    font-family: 'Lato', sans-serif;
      }

      .overlay {
          height: 100%;
          width: 0;
          position: fixed;
          z-index: 1;
          top: 0;
          left: 0;
          background-color: rgb(0,0,0);
          background-color: rgba(0,0,0, 0.9);
          overflow-x: hidden;
          transition: 0.5s;
      }

      .overlay-content {
          position: relative;
          top: 25%;
          width: 100%;
          text-align: center;
          margin-top: 30px;
      }

      .overlay a {
          padding: 8px;
          text-decoration: none;
          font-size: 50px;
          color: #818181;
          display: block;
          transition: 0.3s;
      }

      .overlay a:hover, .overlay a:focus {
          color: #f1f1f1;
      }

      .overlay .closebtn {
          position: absolute;
          top: 20px;
          right: 45px;
          font-size: 60px;
      }

      @media screen and (max-height: 450px) {
        .overlay a {font-size: 20px}
        .overlay .closebtn {
          font-size: 40px;
          top: 15px;
          right: 35px;
        }
      }
    </style>

    <script src="http://code.jquery.com/jquery-2.2.0.js"></script>
  </head>
  <body>
      <div id="myNav" class="overlay" style="font-family: buffalo;">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <div class="overlay-content">
        <a href="<?php echo $path1 ?>">
            <?php echo $var1?>
        </a>
        <?php 
          global $var2;
          if($var2 == "Favorites") { ?>

            <div class="dropdown">
              <a href="javascript:void(0)" class ="dropbtn">
                  <?php echo $var2?>
              </a>
              <div class="dropdown-content" id = "Places">
                <script>
                  function getPlaces(data){
                    var json = data.split('\n');
                    for (i = 0; i < json.length; i++){
                      console.log(json[0]);
                    }
                  }
                </script>
                  <?php
                    $places = list_Places($_SESSION['id']);
                    foreach($places as $place)  {
                      $arr = str_getcsv($place); //separate returned csv string to display place and not lat/long
                      $name = $arr[0];
                      $lat = $arr[1];
                      $long = $arr[2];
                      echo "<a>$name</a>";
                    }
                  ?>
                <!-- <a  href="javascript:addPlaces()"> Add Place </a> -->
                <form action="site.php" method="post">
                <input type="text" name="addplace" value="" placeholder="Enter place name"> <br>
                <input type="submit" name="submit" value="Add Place"> <br><br>
              </form>
              </div>
            </div>

          <?php } else { ?>

            <a href="<?php echo $path2 ?>">
              <?php echo $var2 ?>
            </a>

          <?php } ?>
      </div>
    </div>
    <span style="font-size:60px; font-family: buffalo; font-weight: bold; cursor: pointer;" onclick="openNav()">&#9776; Trendzy</span>

    <script>
    function openNav() {
        document.getElementById("myNav").style.width = "30%";
    }

    function closeNav() {
        document.getElementById("myNav").style.width = "0%";
    }
    </script>

    <script>
      function showPlaces(){
        document.getElementById("Places").classList.toggle("show");
      }
      window.onclick = function(e){
        if(!e.target.matches('.dropbtn')) {
          var dropDown = document.getElementById("Places");
          if(dropDown.classList.contains('show')){
            dropDown.classList.remove('show');
          }
        }
      }
    </script>
    <div id="map"></div>
    <script>
      var map, position;
      var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
      };

      function success(pos) {
       getUserID();
       position = pos.coords;
        var latLng = new google.maps.LatLng({lat: position.latitude, lng: position.longitude});
        map.panTo(latLng);
        var marker = new google.maps.Marker({
          position: latLng,
          map: map,
          title: 'Your Location'
        });
        getTwitterData(position.latitude, position.longitude);
        console.log('Your current position is:');
        console.log(`Latitude : ${position.latitude}`);
        console.log(`Longitude: ${position.longitude}`);
        console.log(`More or less ${position.accuracy} meters.`);
      };

      function loadURL(marker){
        return function(){
          if(marker.url != null){
            window.open(
            marker.url,
            '_blank' //Opens in new tab
        );
          }
        }
      }

      function error(err) {
        console.warn(`ERROR(${err.code}): ${err.message}`);
      };
      function initMap() {
          
          map = new google.maps.Map(document.getElementById('map'), {
                  center: {lat: 40.0076, lng: -105.2659},
                  zoom: 15
                });
          navigator.geolocation.getCurrentPosition(success, error, options);
          if (position != null) {
            getTwitterData(position.latitude, position.longitude);
          } else {
            getTwitterData(40.0076,-105.2659);
          }
          //addPlaces();

           // Create the search box and link it to the UI element.
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));

  // [START region_getplaces]
  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });
      getTwitterData(place.geometry.location.lat(), place.geometry.location.lng());

      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });
  // [END region_getplaces]

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });

      }
      var infowindow;

      function parseTwitterData(data){
        infowindow = new google.maps.InfoWindow();
        for(i in data){
          if (data[i].coordinates != null){

            var dataSplit = data[i].full_text.split(' ');
            var sourceUrl = dataSplit[dataSplit.length-1];

            var src = data[i].source.split("\"")[1];
            var basePath = "img/";
            var iconPath;
            if (src == "http://instagram.com"){
              iconPath = "instagram.png";
            } else if (src == "http://foursquare.com"){
              iconPath = "foursquare.png";
            } else {
              iconPath = "twitter.png";
              sourceUrl = null; //twitter links don't work
            }
            basePath += iconPath;

            var latLng = new google.maps.LatLng({lat: data[i].coordinates.coordinates[1],lng: data[i].coordinates.coordinates[0]});
            var marker = new google.maps.Marker({
              position: latLng,
              map: map,
          icon: basePath,
          url: sourceUrl,
              title: data[i].full_text
            });

            google.maps.event.addListener(marker, 'click', loadURL(marker));

            console.log(marker.getTitle());
            google.maps.event.addListener(marker, 'click', function () {
              infowindow.setContent(this.title);
              infowindow.open(map, this);
            });
        console.log(data[i]);
          }


        }    
      }

      function getUserID(){
        var id  = "<?php echo $_SESSION['id']; ?>";
        return id;
      }

      function addPlaces(){
        console.log("here");
        getUserID();
        var latlng = map.getCenter();
        var addy;
        var geocoder = new google.maps.Geocoder;
         geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              addy = results[0].formatted_address;
            }
          }
        })
         console.log(getUserID());
        $(document).ready(function() {
          var url = 'includes/addPlace.php'
          $.ajax({url:url, dataType:"json", 
            data: {lat: latlng.lat(), long: latlng.lng(), location: addy, user_id: getUserID()}
        })
        })

        list_Places();
      }

      function list_Places() {

        $(document).ready(function() {
          var url = 'includes/listPlaces.php'
          $.ajax({url:url, dataType: "json",
            data: {user_id: getUserID()}
        }).then(function(data) {
              console.log(data);
          })
          })

      }

      function getTwitterData(latitude, longitude){
        var twitterJsonObject;
       $(document).ready(function() {
          var url = 'twitter.php'
          $.ajax({url:url, dataType:"json", 
            data: {lat: latitude, long: longitude}
        }).then(function(data) {
              parseTwitterData(data);
          })
        })
      }


    </script>
    <script 
    src="https://maps.googleapis.com/maps/api/js?key= AIzaSyCtw3lW1ZxI4fmZv_Umde-aX1pSnSrWzTU&libraries=places&callback=initMap">
    </script>
  </body>
</html>
