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
$tablename = $wpdb->prefix . "dms_orders";
//retrieve all status completed data from woocommerce orders
$orders = wc_get_orders(array('status' => 'completed'));
//update the wp_dms_orders table 
foreach ($orders as $order) {
    $order_data = $order->get_data();
    $customer_name = $order_data['shipping']['first_name'] . ' ' . $order_data['shipping']['last_name'];
    $order_address = $order_data['shipping']['address_1'] . ' ' . $order_data['shipping']['address_2'] . ', ' . $order_data['shipping']['country'] . ' ' . $order_data['shipping']['city'] ?: '' . ' ' . $order_data['shipping']['state'] ?: '' . ' ' . $order_data['shipping']['postcode'];

    $sql = $wpdb->prepare("INSERT INTO `$tablename` (`order_id`, `customer_name`, `order_address`, `delivery_personnel`, `order_weight`, `delivery_status`, `delivery_datetime`, `photo_evidence`) values (NULL, $customer_name, $order_address, NULL, NULL, 'pending', NULL, NULL)");
    $wpdb->query($sql);
}


//Retrieve data from wp_dms_orders table
$unassigned_results = $wpdb->get_results("SELECT * FROM $tablename WHERE delivery_personnel IS NULL ");
$assigned_results = $wpdb->get_results("SELECT * FROM $tablename WHERE delivery_personnel IS NOT NULL");
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
                            <th>Order Address</th>
                            <th>Delivery Personnel</th>
                            <th>Order Weight</th>
                            <th>Delivery Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($unassigned_results as $ua_row) {
                            $order_id = isset($ua_row->order_id) ? $ua_row->order_id : '-';
                            $customer_name = isset($ua_row->customer_name) ? $ua_row->customer_name : '-';
                            $order_address = isset($ua_row->order_address) ? $ua_row->order_address : '-';
                            $delivery_personnel = isset($ua_row->delivery_personnel) ? $ua_row->delivery_personnel : '-';
                            $order_weight = isset($ua_row->order_weight) ? $ua_row->order_weight : '-';
                            $delivery_status = isset($ua_row->delivery_status) ? $ua_row->delivery_status : '-';
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