
 <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3 footer-col">
          <div class="footer_detail">
            <h4>
              About
            </h4>
            <p>
              Necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with
            </p>
            <div class="footer_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer-col">
          <div class="footer_contact">
            <h4>
              Reach at..
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Location
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +01 1234567890
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  deffetto.style@gmail.com
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer-col">
          <div class="footer_contact">
            <h4>
              Subscribe
            </h4>
            <form action="index.php#newsletter" method="post">
              <input type="text" placeholder="Full Name" name="name" />
              <input type="email" placeholder="Enter email" name="email" />
              <button type="submit" onClick="goHere()">
                Subscribe
              </button>
            </form>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 footer-col">
          <div class="map_container">
            <div class="map">
              <div id="googleMap"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a>
        </p>
      </div>
    </div>
  </footer>
  <!-- footer section -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
<!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAvKZN-V6xzNr3Vz13AgCHCpdZ5q8qSyRw&callback=initMap" async defer></script>
  <!-- End Google Map -->

  <script type="text/javascript">
    function initMap() {

    function AddCustomControl(controlDiv, map) {

        google.maps.event.addDomListener(controlDiv, 'click', function() {

        });
    }
    
    var myLatlng = new google.maps.LatLng(54.977775, -1.604488);
        var mapOptions = {
            center: myLatlng,
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            streetViewControl: true,
            overviewMapControl: false,
            rotateControl: false,
            scaleControl: false,
            panControl: false,

        };

        var map = new google.maps.Map(document.getElementById("googleMap"),
            mapOptions);

        var customControlDiv = document.createElement('div');
        customControlDiv.id="customControlDiv";
        AddCustomControl(customControlDiv, map);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(customControlDiv);


        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: "Northumbria University"
        });

        marker.setMap(map);
}


  </script>

  </body>
</html>


