<?php
function update_dms_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "dms_orders";
    $orders = wc_get_orders(array('status' => 'completed'));
    foreach ($orders as $order) {
        $shipping_data = $order->get_data()['shipping'];
        $billing_data = $order->get_data()['billing'];
        $order_id = $order->id;
        $customer_name = $shipping_data['first_name'] . ' ' . $shipping_data['last_name'];
        $customer_phone = $billing_data['phone'];
        $order_address = $shipping_data['address_1'] . ' ' . $shipping_data['address_2'] . ', ' . $shipping_data['country'] . ' ' . $shipping_data['postcode'];
        $postal_code = $shipping_data['postcode'];
        $results = $wpdb->get_results("SELECT COUNT(order_id) as count FROM " . $table_name . " WHERE order_id = " . $order_id . "");
        foreach ($results as $result) {
        }
        if ($result->count == 0) {
            $total_weight = 0.0;
            foreach ($order->get_items() as $item) {
                $product_id = $item->get_data()['product_id'];
                $quantity = $item->get_quantity();
                $weight = get_post_meta($product_id, '_weight', true);
                $total_weight += $weight * $quantity;
            }
            $distance = round((get_distance($postal_code)/1000), 1);
            $wpdb->insert("wp_dms_orders", array(
                "order_id" => $order_id,
                "customer_name" => $customer_name,
                "customer_phone" => $customer_phone,
                "order_address" => $order_address,
                "delivery_status" => "Processing",
                "order_weight" => $total_weight,
                "postal_code" => $postal_code,
                "distance" => $distance,
            ));
        }
    }
}

function send_email($email_to, $subject, $id, $name, $dp, $address, $type)
{

    //location of template file
    $template_file = DMS_PLUGIN_PATH . "assets/templates/email.php";

    if ($type == 'accepted') {
        $email_title = "Order has been Accepted!";
        $btn_text = "View in dashboard";
    } else if ($type == 'rejected') {
        $email_title = "Order has been Rejected!";
        $btn_text = "View in dashboard";
    }

    //create swap variables array
    $swap_var = array(
        "{SITE_ADDR}" => "http://fypteam1.amos-ng.tech/",
        "{EMAIL_LOGO}" => DMS_PLUGIN_URL . "assets/images/sethtronics_logo.png",
        "{EMAIL_TITLE}" => $email_title,
        "{BUTTON_TEXT}" => $btn_text,
        "{BUTTON_LINK}" => "http://fypteam1.amos-ng.tech/wp-admin/",
        "{ORDER_ID}" => $id,
        "{CUSTOMER_NAME}" => $name,
        "{DELIVERY_PERSONNEL}" => $dp,
        "{ADDRESS}" => $address,
    );

    // Set content-type header for sending HTML email 
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    if (file_exists($template_file)) {
        $message = file_get_contents($template_file);
    } else {
        echo "unable to locate template file";
    }

    foreach (array_keys($swap_var) as $key) {
        if (strlen($key) > 2 && trim($key) != "") {
            $message = str_replace($key, $swap_var[$key], $message);
        }
    }
    mail($email_to, $subject, $message, $headers);
}

function get_distance($address)
{
    // Current Token expires 8th August 2022 10:00 AM UTC, 
    
    $ozil_geo = '1.279860,103.844582'; // Ozil Services location: 20 MAXWELL ROAD, #09-17, MAXWELL HOUSE, Singapore 069113
    $end = geocode($address);

    $queryString = http_build_query([
        'start' => $ozil_geo,
        'end' => $end,
        'routeType' => 'drive',
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjkwOTYsInVzZXJfaWQiOjkwOTYsImVtYWlsIjoibGlhbmd6aWthaTExMTFAZ21haWwuY29tIiwiZm9yZXZlciI6ZmFsc2UsImlzcyI6Imh0dHA6XC9cL29tMi5kZmUub25lbWFwLnNnXC9hcGlcL3YyXC91c2VyXC9zZXNzaW9uIiwiaWF0IjoxNjU5NjY3NTUyLCJleHAiOjE2NjAwOTk1NTIsIm5iZiI6MTY1OTY2NzU1MiwianRpIjoiZGM0ZGJmMmI0ZjdhMjZiNjljNmFjYzQ3NmFiMmVkZDgifQ._yD60AexA1TgXpvyBwrxZa-hydBY3bb_T4HYNdeS5gg'
    ]);

    $ch = curl_init();

    $url = sprintf('%s&%s', 'https://developers.onemap.sg/privateapi/routingsvc/route?', $queryString);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $resp = curl_exec($ch);

    if($e = curl_error($ch)) {
        echo $e;
    }
    else {
        $decoded = json_decode($resp, true);
        return($decoded['route_summary']['total_distance']);
    }
    curl_close($ch);


}

function geocode($address)
{
    $queryString = http_build_query([
        'searchVal' => $address,
        'returnGeom' => 'Y',
        'getAddrDetails' => 'N'
    ]);
    $ch = curl_init(sprintf('%s&%s', 'https://developers.onemap.sg/commonapi/search?', $queryString));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    curl_close($ch);
    $apiResult = json_decode($json, true);

    $latitude = $apiResult['results'][0]['LATITUDE'];
    $longitude = $apiResult['results'][0]['LONGITUDE'];
    $latlong = $latitude . ',' . $longitude;
    
    return $latlong;
}

