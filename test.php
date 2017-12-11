<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Google Maps with Contact Form</title>
    <meta name="description" content="This is a working demo of a contact form with Google Maps in the background. The map is dynamic and you can zoom or pan as well.">
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv-GgCEfo8ntMixpbrvAP5KgDAyy45EX0&libraries=places&callback=initMap">
    </script>
    <style>
    a#msg {
        font-size: 11px;
        font-family: arial;
        text-decoration: none;
        color: black;
        display:inline-block;
        padding: 5px 0;
        border-bottom: 2px dotted lightgrey;
    }
    #map {
        height: 100%;
        width: 100%;
        position:absolute;
        top: 0;
        left: 0;
        z-index: 0;
        opacity: .75;
    }
    #info {
        position: relative;
        z-index: 1;
        width: 300px;
        margin: 50px auto 0;
    }
    input, textarea {
        border: none;
        outline: none;
        resize: none;
        width: 100%;
        -moz-appearance: none;
        -webkit-appearance: none;
        font-size: 13px;
        margin: 0;
        padding: 0;
    }
    .contact-form {
        background: white;
        height: auto;
        max-width: 500px;
        overflow: hidden;
        width: 327px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        -moz-box-shadow: rgba(26, 26, 26, 0.1) 0 1px 3px 0;
        -webkit-box-shadow: rgba(26, 26, 26, 0.1) 0 1px 3px 0;
        box-shadow: rgba(26, 26, 26, 0.1) 0 1px 3px 0;
    }
    @media (max-width: 500px) {
        .contact-form {
            margin: 0 0 100px;
            width: 100%;
        }
    }
    .contact-form .email, .contact-form .message, .contact-form .name {
        position: relative;
    }
    .contact-form .email input:focus, .contact-form .email textarea:focus, .contact-form .message input:focus, .contact-form .message textarea:focus, .contact-form .name input:focus, .contact-form .name textarea:focus {
        background: #f4f5f6;
    }
    @media (max-width: 500px) {
        .contact-form .email, .contact-form .name {
            width: 100%;
        }
    }
    .contact-form .email input, .contact-form .name input {
        padding: 23px 0 8px 23px;
    }
    .contact-form .email {
        border-left: 1px #e6e6e6 solid;
        float: right;
    }
    @media (max-width: 500px) {
        .contact-form .email {
            border-left: none;
            border-top: 1px #e6e6e6 solid;
        }
    }
    .contact-form .message {
        border-bottom: 1px #e6e6e6 solid;
        border-top: 1px #e6e6e6 solid;
        clear: both;
    }
    .contact-form .message textarea {
        height: 100px;
        padding: 20px;
    }
    .contact-form .name {
        float: left;
    }
    .contact-form .submit {
        background: #f4f5f6;
        display: block;
        overflow: hidden;
        padding: 10px;
    }
    .contact-form .submit .button {
        background: #3498db;
        border: 1px #3498db solid;
        color: white;
        float: right;
        padding: 9px 0;
        width: 100px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
    }
    @media (max-width: 500px) {
        .contact-form .submit .button {
            float: none;
        }
    }
    .contact-form .submit .button:hover {
        background: #4aa3df;
    }
    .contact-form .submit .button:active {
        background: #258cd1;
    }
    .contact-form .submit .button:focus {
        border-color: #b6daf2;
        -moz-box-shadow: #75b9e7 0 0 4px 1px, #75b9e7 0 0 4px 1px inset;
        -webkit-box-shadow: #75b9e7 0 0 4px 1px, #75b9e7 0 0 4px 1px inset;
        box-shadow: #75b9e7 0 0 4px 1px, #75b9e7 0 0 4px 1px inset;
    }
    .contact-form .submit .user-message {
        float: left;
        padding-top: 22px;
    }
    @media (max-width: 500px) {
        .contact-form .submit .user-message {
            float: none;
            padding: 0 0 10px;
        }
    }
    </style>
      <script src="http://code.jquery.com/jquery-2.2.0.js"></script>
</head>
<body>
    <div id="map">
    </div>
        <script>
      var map, position;
      var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
      };
      function success(pos) {
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
            var basePath = "http://127.0.0.1/Trendzy/img/";
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
      function getTwitterData(latitude, longitude){
        var twitterJsonObject;
        console.log("here");
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
   <!--  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv-GgCEfo8ntMixpbrvAP5KgDAyy45EX0&libraries=places&callback=initMap">
    </script> -->
    <div id="info">
        <form class="contact-form">
            <div class="name">
                <input type="text" id="name" placeholder="Your Name" />
            </div>
            <div class="email">
                <input type="text" id="email" placeholder="Your Email Address" />
            </div>
            <div class="message">
                <textarea name="message" id="message" placeholder="Your Message"></textarea>
            </div>
            <div class="submit">
                <a href="http://www.labnol.org/internet/embed-google-maps-background/28457/" id="msg">Contact Form with Google Maps</a>
                <input type="button" value="Contact" class="button" onclick="document.getElementById('message').value='This is a demo only.'" />
            </div>
        </form>
    </div>
</body>
</html>