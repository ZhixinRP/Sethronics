<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin/partials
 */



global $wpdb;
$user = wp_get_current_user();
$table_name = $wpdb->prefix . "dms_orders";
$orders = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE delivery_personnel='" . $user->user_login . "' AND delivery_status = 'In Transit'");

foreach ($orders as $order) {
    echo esc_html_e($order->order_address);
}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<div class="wrap">
    <h1>Order Locations</h1>
    <!--The div element for the map -->
    <div id="map"></div>
</div>
<script>
    //call geocode
    geocode()

    function geocode() {
        var location = '22 main st boston MA';
        axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
            params: {
                address: location,
                key: 'AIzaSyD_qKzzCPoC3GTGB2li2YKddgmOXyTBYkY'
            }
        }).then(function(response) {
            console.log(response)
        }).catch(function(response) {
            console.log(error)
        })
    }


    // Initialize and add the map
    function initMap() {
        var locations = [
            ['53 Ang Mo Kio Avenue 3 Singapore 569933', 1.369400, 103.848557],
            ['Blk 145 Lorong 2 Toa Payoh Singapore 310145', 1.335230, 103.846210],
        ];

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: new google.maps.LatLng(1.3521, 103.8198),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }

    }
    window.initMap = initMap;
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7zqC7d3_gVvXTuXoOujvGOA5dT2bhP1s&callback=initMap" defer></script>