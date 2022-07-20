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

function send_email()
{
    $email_to = "";
    $subject = "";
    $message = "";

    $headers = ""

    if( mail($email_to, $subject, $message, $headers) ){

    } else {

    }
}
?>


