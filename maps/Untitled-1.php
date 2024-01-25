<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>FoodGuard Map</title>
    <style>
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

      body {
  font-family: 'Roboto', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f8f9fa;
  color: #15222e;
  background-image: url("resto2.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
}

      
      .sidebar {
  margin: 0;
  padding: 0;
  top: 0;
  width: 200px;
  background-color: rgb(10, 12, 72);
  position: fixed;
  height: 100%;
  overflow: auto;
  color: white;
}

.sidebar a {
  display: block;
  color: white;
  padding: 16px;
  text-decoration: none;
}

.sidebar a.active {
  background-color: blue;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #6495ED;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {
    float: left;
  }
  div.content {
    margin-left: 0;
  }
}

   

    </style>
  </head>

<html>
  <body>
  <div class="sidebar">
      <div class="logo" style="display: flex; align-items: center;">
        <img src="http://localhost/img/WhatsApp_Image_2024-01-02_at_9.34.56_PM-removebg-preview.png" alt="Logo" style="width: 50px; height: 50px;">
        <h2 style="color: white; margin-left: 10px;">FoodGuard</h2>
      </div>
      <a href="http://localhost/home.php">Home</a>
      <a class="active" href="#restaurant locator">Restaurant Locator</a>
      <a href="http://localhost/FoodGuard/home.php">Logout</a>
    </div>
<div class="content">
    <div id="map"></div>

    <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(1.5584794817985355, 103.63711242733415),
          zoom: 15
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('http://localhost/maps/xml.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var operating_hours =  markerElem.getAttribute('operating_hours');
              var image_url = markerElem.getAttribute('image_url');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));
              var nameElement = document.createElement('h3'); // Assuming the restaurant name is a heading level 3 (h3)
              nameElement.textContent = name; // Assuming 'name' is the restaurant name
              nameElement.style.textAlign = 'center'; // Center-align the text
              infowincontent.appendChild(nameElement);

              

              var image = document.createElement('img');
              image.src = image_url; // Assuming 'image_url' is fetched from XML
              image.style.display = 'block'; // Set display to block for centering
              image.style.margin = '0 auto';
              image.style.width = '300px';
              image.style.height = 'auto'
              infowincontent.appendChild(image);
              var addressText = document.createElement('text');
              addressText.textContent = '\nAddress: ' + address
              infowincontent.appendChild(addressText);
              var operatingHoursText = document.createElement('p');
              operatingHoursText.textContent = 'Operating Hours: ' + operating_hours;
              infowincontent.appendChild(operatingHoursText);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
<script async
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgiUUjSQ6pcZEJzLi63lEYoXK3tj3Wxzw&callback=initMap"
      defer
    ></script>
    </div>
  </body>
</html>