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
        ));
    }
}

?>



<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
<div class="wrap">
    <div class="title">Order Manager</div>
    <div class="tabs">
        <div class="tab-header">
            <div class="tab active">Unassigned Orders</div>
            <div class="tab">Assigned Orders</div>
            <div class="tab">Export</div>
        </div>

        <div class="tab-body">
            <div class="tab-content active">
                <div class="sub-title">Unassigned Orders</div>
                <table class="table table-bordered">
                    <thead class="table-dark table-bordered">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Delivery Personnel</th>
                            <th>Weight</th>
                            <th>Delivery Status</th>
                            <th>Datetime</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $order_list = $wpdb->get_results("SELECT * FROM " . $table_name . "");
                        foreach ($order_list as $index => $data) {
                            $ol_id = isset($data->order_id) ? $data->order_id : '-';
                            $ol_customer_name = isset($data->customer_name) ? $data->customer_name : '-';
                            $ol_order_address = isset($data->order_address) ? $data->order_address : '-';
                            $ol_dp = isset($data->delivery_personnel) ? $data->delivery_personnel : '-';
                            $ol_weight = isset($data->order_weight) ? $data->order_weight : '-';
                            $ol_status = isset($data->delivery_status) ? $data->delivery_status : '-';
                            $ol_datetime = isset($data->delivery_datetime) ? $data->delivery_datetime : '-';
                        ?>
                            <tr>
                                <td><?php esc_html_e($ol_id); ?></td>
                                <td><?php esc_html_e($ol_customer_name); ?></td>
                                <td><?php esc_html_e($ol_order_address); ?></td>
                                <td><?php esc_html_e($ol_dp); ?></td>
                                <td><?php esc_html_e($ol_weight); ?></td>
                                <td><?php esc_html_e($ol_status); ?></td>
                                <td><?php esc_html_e($ol_datetime); ?></td>
                            <?php
                        }
                            ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-content">
                <div class="sub-title">Assigned Orders</div>
                <table class="table table-bordered">
                    <thead class="table-dark table-bordered">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Order Address</th>
                            <th>Delivery Personnel</th>
                            <th>Order Weight</th>
                            <th>Delivery Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($assigned_results as $a_row) {
                            $order_id = isset($a_row->order_id) ? $a_row->order_id : '-';
                            $customer_name = isset($a_row->customer_name) ? $a_row->customer_name : '-';
                            $order_address = isset($a_row->order_address) ? $a_row->order_address : '-';
                            $delivery_personnel = isset($a_row->delivery_personnel) ? $a_row->delivery_personnel : '-';
                            $order_weight = isset($a_row->order_weight) ? $a_row->order_weight : '-';
                            $delivery_status = isset($a_row->delivery_status) ? $a_row->delivery_status : '-';
                        ?>
                            <tr>
                                <td><?php echo $order_id ?></td>
                                <td><?php echo $customer_name ?></td>
                                <td><?php echo $order_address ?></td>
                                <td><?php echo $delivery_personnel ?></td>
                                <td><?php echo $order_weight ?></td>
                                <td><?php echo $delivery_status ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-content">
                <div class="sub-title">Export Section</div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>