<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <title>FoodGuard Map</title>
  <style>
    #map {
      height: 100%;
    }

    html,
    body {
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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgiUUjSQ6pcZEJzLi63lEYoXK3tj3Wxzw&libraries=places&callback=initMap" async defer></script>
</head>

<body>
  <div class="sidebar">
    <div class="logo" style="display: flex; align-items: center;">
      <img src="http://localhost/FoodGuard/img/logo.png" alt="Logo" style="width: 50px; height: 50px;">
      <h2 style="color: white; margin-left: 10px;">FoodGuard</h2>
    </div>
    <a href="http://localhost/FoodGuard/foodguard.php">Home</a>
    <a href="http://localhost/Review/Review/index.html">Review Page</a>
    <a class="active" href="#restaurant locator">Restaurant Locator</a>
    <a href="http://localhost/FoodGuard/user_dashboard.php">Dashboard</a>
    <a href="http://localhost/FoodGuard/home.php">Logout</a>
  </div>
  <div class="content">
    <div id="map"></div>
    <!-- Your scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      var map;

      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(1.5584794817985355, 103.63711242733415),
          zoom: 15
        });
        var infoWindow = new google.maps.InfoWindow;

        downloadUrl('http://localhost/maps/xml.php', function (data) {
          if (data.status === 200) {
            var xml = data.responseXML;
            if (xml) {
              var markers = xml.documentElement.getElementsByTagName('marker');

              Array.prototype.forEach.call(markers, function (markerElem) {
                var id = markerElem.getAttribute('id');
                var name = markerElem.getAttribute('name');
                var address = markerElem.getAttribute('address');
                var type = markerElem.getAttribute('type');
                var operating_hours = markerElem.getAttribute('operating_hours');
                var image_url = markerElem.getAttribute('image_url');
                var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng'))
                );

                var infowincontent = document.createElement('div');

                var nameDiv = document.createElement('div');
                var strong = document.createElement('strong');
                strong.textContent = name;
                nameDiv.appendChild(strong);
                nameDiv.appendChild(document.createElement('br'));
                var nameElement = document.createElement('h3');
                nameElement.textContent = name;
                nameElement.style.textAlign = 'center';
                nameDiv.appendChild(nameElement);
                infowincontent.appendChild(nameDiv);

                var image = document.createElement('img');
                image.src = image_url;
                image.style.display = 'block';
                image.style.margin = '0 auto';
                image.style.width = '300px';
                image.style.height = 'auto';
                infowincontent.appendChild(image);

                var addressText = document.createElement('text');
                addressText.textContent = '\nAddress: ' + address;
                infowincontent.appendChild(addressText);

                var operatingHoursText = document.createElement('p');
                operatingHoursText.textContent = 'Operating Hours: ' + operating_hours;
                infowincontent.appendChild(operatingHoursText);

                var reviewsTableHeader = document.createElement('h4');
                reviewsTableHeader.textContent = "User's Ratings:";
                infowincontent.appendChild(reviewsTableHeader);

                var reviewsTableDiv = document.createElement('div');
                reviewsTableDiv.id = 'reviewsTable';
                reviewsTableDiv.style.overflowX = 'auto';
                reviewsTableDiv.style.maxHeight = '600px';
                infowincontent.appendChild(reviewsTableDiv);

                var navigateButton = document.createElement('button');
                navigateButton.textContent = 'Navigate';
                navigateButton.style.display = 'block';
                navigateButton.style.margin = '10px auto';
                navigateButton.style.backgroundColor = '#8142b1';
                navigateButton.style.color = '#fff';
                navigateButton.style.border = 'none';
                navigateButton.style.padding = '10px';
                navigateButton.style.cursor = 'pointer';
                infowincontent.appendChild(navigateButton);

                var icon = customLabel[type] || {};
                var marker = new google.maps.Marker({
                  map: map,
                  position: point,
                  label: icon.label
                });

                google.maps.event.addDomListener(navigateButton, 'click', function () {
                  calculateRoute(point);
                });

                marker.addListener('click', function () {
                  getReviews(id, reviewsTableDiv);
                  infoWindow.setContent(infowincontent);
                  infoWindow.open(map, marker);
                });
              });
            } else {
              console.error('Error loading XML:', data.statusText);
            }
          } else {
            console.error('Failed to download XML. Status:', data.status);
          }
        });
      }

      $('#distance_form').submit(function (e) {
        e.preventDefault();

        var origin = $('#origin').val();
        var destination = $('#destination').val();
        var travelMode = $('#travel_mode').val();

        calculateDistanceAndRoute(origin, destination, travelMode);
      });

      function calculateDistanceAndRoute(origin, destination, travelMode) {
        var directionsService = new google.maps.DirectionsService();
        var directionsRenderer = new google.maps.DirectionsRenderer();

        directionsRenderer.setMap(map);

        var request = {
          origin: origin,
          destination: destination,
          travelMode: travelMode
        };

        directionsService.route(request, function (response, status) {
          if (status == 'OK') {
            directionsRenderer.setDirections(response);

            var distanceText = 'Distance: ' + response.routes[0].legs[0].distance.text;
            var durationText = 'Duration: ' + response.routes[0].legs[0].duration.text;

            $('#in_mile').text(distanceText);
            $('#in_kilo').text(durationText);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }

      function getReviews(markerId, reviewsTableDiv) {
        $.ajax({
          url: 'http://localhost/Review/Review/get_review.php',
          type: 'GET',
          dataType: 'json',
          success: function (response) {
            if (response.success) {
              var restaurantReviews = response.reviews.filter(function (review) {
                return review.restaurant_id == markerId;
              });

              var tableHtml = '<table border="1"><tr><th>Username</th><th>Rating</th><th>Review</th></tr>';
              restaurantReviews.forEach(function (review) {
                tableHtml += '<tr><td>' + review.user_name + '</td><td>' + review.rating + '</td><td>' + review.review_text + '</td></tr>';
              });
              tableHtml += '</table>';

              reviewsTableDiv.innerHTML = tableHtml;
            } else {
              console.error('Failed to fetch reviews.');
            }
          },
          error: function (xhr, status, error) {
            console.error('Error fetching reviews:', error);
          }
        });
      }

      function calculateRoute(destination) {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            function (position) {
              var origin = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
              var destinationLatLng = new google.maps.LatLng(destination.lat(), destination.lng());

              var directionsService = new google.maps.DirectionsService();
              var directionsRenderer = new google.maps.DirectionsRenderer();

              directionsRenderer.setMap(map);

              var request = {
                origin: origin,
                destination: destinationLatLng,
                travelMode: 'DRIVING'
              };

              directionsService.route(request, function (response, status) {
                if (status == 'OK') {
                  directionsRenderer.setDirections(response);

                  var infoWindow = new google.maps.InfoWindow;

                  infoWindow.setContent('<div style="text-align:center;"><strong>Destination</strong><br/><button onclick="closeInfoWindow()">Close</button></div>');
                  infoWindow.setPosition(destination);
                  infoWindow.open(map);

                  google.maps.event.addListener(infoWindow, 'closeclick', function () {
                    directionsRenderer.setMap(null);
                  });
                } else {
                  window.alert('Directions request failed due to ' + status);
                }
              });
            },
            function (error) {
              console.error('Error getting current position:', error);
            }
          );
        } else {
          window.alert('Geolocation is not supported by this browser.');
        }
      }

      function closeInfoWindow() {
        infoWindow.close();
      }

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

        request.onreadystatechange = function () {
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
  </div>
</body>

</html>
