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
        $customer_phone = $shipping_data['phone'];
        $customer_name_phone = $customer_name . ' (' . $customer_phone . ')';
        $order_address = $shipping_data['address_1'] . ' ' . $shipping_data['address_2'] . ', ' . $shipping_data['country'] . ' ' . $shipping_data['city'] . ' ' . $shipping_data['state'] . ' ' . $shipping_data['postcode'];
        $results = $wpdb->get_results("SELECT COUNT(order_id) as count FROM " . $table_name . " WHERE order_id = " . $order_id . "");
        foreach ($results as $result) {
        }
        if ($result->count == 0) {
            $total_weight = 0.0;
            $weight_table = $wpdb->prefix . "wp_postmeta";
            foreach ($order->get_items() as $item_key => $item) {
                $product_id = $item->get_data()['product_id'];
                $quantity = $item->get_quantity();
                $weight = get_post_meta( $product_id, '_weight', true);
                $total_weight += $weight * $quantity;
            }
            $wpdb->insert("wp_dms_orders", array(
                "order_id" => $order_id,
                "customer_name" => $customer_name_phone ,
                "order_address" => $order_address,
                "delivery_status" => "Processing",
                "order_weight" => $total_weight,
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
