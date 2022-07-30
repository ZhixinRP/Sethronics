<?php

if(isset($_POST["export"]))
{
    global $wpdb;
    $table_name = $wpdb->prefix . "dms_orders";
    
    header('Content-Type: text/csv; charset=urf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('Order ID', 'Customer Name', 'Address', 'Weight', 'Delivery Personnel', 'Delivery Datetime'));

    $order_list = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE delivery_status = 'Delivered'");
    foreach ($order_list as $index => $data) {
        $ol_id = isset($data->order_id) ? $data->order_id : '-';
        $ol_customer_name = isset($data->customer_name) ? $data->customer_name : '-';
        $ol_order_address = isset($data->order_address) ? $data->order_address : '-';
        $ol_weight = isset($data->order_weight) ? $data->order_weight : '-';



        fputcsv($output, $order_list);
    }

    fclose($output);

}
?>
