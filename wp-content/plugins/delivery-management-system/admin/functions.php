<?php
function update_dms_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "dms_orders";
    $orders = wc_get_orders(array('status' => 'completed'));
    foreach ($orders as $order) {
        $shipping_data = $order->get_data()['shipping'];
        $order_id = $order->id;
        $customer_name = $shipping_data['first_name'] . ' ' . $shipping_data['last_name'];
        $order_address = $shipping_data['address_1'] . ' ' . $shipping_data['address_2'] . ', ' . $shipping_data['country'] . ' ' . $shipping_data['city'] ?: '' . ' ' . $shipping_data['state'] ?: '' . ' ' . $shipping_data['postcode'];
        $results = $wpdb->get_results("SELECT COUNT(order_id) as count FROM " . $table_name . " WHERE order_id = " . $order_id . "");
        foreach ($results as $result) {
        }
        if ($result->count == 0) {
            $wpdb->insert("wp_dms_orders", array(
                "order_id" => $order_id,
                "customer_name" => $customer_name,
                "order_address" => $order_address,
                "delivery_status" => "processing",
            ));
        }
    }
}

function send_email($email_to, $subject)
{

    //location of template file
    $template_file = DMS_PLUGIN_PATH . "assets/templates/email.php";

    //create swap variables array
    $swap_var = array(
        "{SITE_ADDR}" => "http://fypteam1.amos-ng.tech/",
        "{EMAIL_LOGO}" => DMS_PLUGIN_URL . "assets/images/sethtronics_logo.png",
        "{EMAIL_TITLE}" => "You have an Incoming Order!",
        "{BUTTON_TEXT}" => "Accept/Reject Order",
        "{BUTTON_LINK}" => "http://fypteam1.amos-ng.tech/wp-admin/",
    );

    // Set content-type header for sending HTML email 
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    if (file_exists($template_file)) {
        $message = file_get_contents($template_file);
    } else {
        die("unable to locate template file");
    }

    foreach (array_keys($swap_var) as $key) {
        if (strlen($key) > 2 && trim($key) != "") {
            $message = str_replace($key, $swap_var[$key], $message);
        }
    }

    echo $message;

    if (mail($email_to, $subject, $message, $headers)) {
        echo 'success';
    } else {
        echo 'not sent';
    }
}
