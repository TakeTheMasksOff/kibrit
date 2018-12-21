<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkRnJl0N4PafPZwZydn-pOCmSZikd5vq8" type="text/javascript"></script>
<?php $str=<<<JAVASCRIPT

      var myCenter=new google.maps.LatLng(40.39761, 49.86042);
      function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
          center: myCenter,
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({
          position: myCenter,
          map: map,
          icon:  '/assets/images/gmap-marker.png'
        });

        var infowindow = new google.maps.InfoWindow({
            content:"Premium Plaza <br /> 106, Yahya Bakuvi street, Baku, Azerbaijan, AZ1072"
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });

      }
      google.maps.event.addDomListener(window, 'load', initialize);
    
JAVASCRIPT;
    Yii::app()->clientscript->registerScript('contactspageScript',$str,  CClientScript::POS_READY);
?>

  <div id="map-canvas" class="overlay map-canvas"></div>

