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

function geocode($address)
{
    // print_r($address);
    $queryString = http_build_query([
        'access_key' => '7d28b67a04aab394d16c0ad8066c916f',
        'query' => $address,
        'limit' => 1,
    ]);
    $ch = curl_init(sprintf('%s?%s', 'http://api.positionstack.com/v1/forward', $queryString));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    curl_close($ch);
    $apiResult = json_decode($json, true);
    // print_r($apiResult);
    $formatted_address = $apiResult['data'][0]['label'];
    $latitude = $apiResult['data'][0]['latitude'];
    $longitude = $apiResult['data'][0]['longitude'];

    print_r($formatted_address . $latitude . $longitude);
}



global $wpdb;
$user = wp_get_current_user();
$table_name = $wpdb->prefix . "dms_orders";
$orders = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE delivery_personnel='" . $user->user_login . "' AND delivery_status = 'In Transit'");
foreach ($orders as $order) {
    //call geocode
    geocode($order->order_address);
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