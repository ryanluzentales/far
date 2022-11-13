<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
    body {
        padding-top: 200px;
    }

    #map {
        width: 100%;
        height: 400px;
    }
    </style>


</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 jumbotron">
                <form action="#">
                    <div class="form-group row">
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                        <div class="col-sm-1"></div>
                        <label class="form-control-label col-sm-4">Location</label>
                        <div class="col-sm-6">
                            <a class="btn btn-info" onclick="Modal()"><i class="fa fa-map-marker mr-2"></i>Choose
                                Location</a>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label for="address" class="form-control-label col-sm-4">Address</label>
                        <div class="col-sm-6">
                            <textarea id="address" class="form-control" rows="5" name="address"></textarea>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-5"></div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-info"><i class="fa fa-save"></i>Save Address</button>
                        </div>
                    </div>
                </form>
                <div class="modal fade" id="location-modal" tab-index="-1" role="dialog" aria-labelled="location-modal"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title" id="address-label">Choose Location</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="map"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal"><i
                                        class="fa fa-check"></i>Done</button>
                            </div>
                            <script type="text/javascript">
                            var map, marker;

                            function Modal() {
                                $("#location-modal").modal()
                                var location = new google.maps.LatLng(31.4504, 73.1350);
                                var mapProperty = {
                                    center: location,
                                    zoom: 50,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP

                                };
                                map = new google.maps.Map(document.getElementById('map'), mapProperty);
                                marker = new google.maps.Marker({
                                    map: map,
                                    draggable: true,
                                    animation: google.maps.Animation.DROP,
                                    position: location
                                });
                                geocodePosition(marker.getPosition());
                                google.maps.event.addListener(marker, 'dragend', function() {
                                    map.setCenter(marker.getPosition());
                                    geocodePosition.setCenter(marker.getPosition());
                                    $("#latitude").val(marker.getPosition().lat());
                                    $("#longitude").val(marker.getPosition().lng());

                                });
                                currentLat = $("#latitude").val();
                                currentLng = $("#longitude").val();
                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(function(position) {
                                        pos = {
                                            lat: position.coords.latitude,
                                            lng: position.coords.longitude
                                        };
                                        $("#latitude").val(pos.lat);
                                        $("#longitude").val(pos.lng);
                                        marker.setPosition(pos);
                                        map.setCenter(marker.getPosition());
                                        geoCodePosition(marker.getPosition());


                                    });
                                }
                            }

                            function geocodePosition(pos) {
                                geocoder = new google.maps.Geocoder();
                                geocoder.geocode({
                                        latLng: pos
                                    }),
                                    function(results, status) {
                                        if (status == google.mapsGeocoderStatus.OK) {
                                            $("#address-label").html(results[0].formatted_address);
                                            $("#address").val(results[0].formatted_address);

                                        } else {
                                            $("#address-label").html('Cannot determine address at that location');
                                        }
                                    }
                            }
                            </script>

</body>

</html>