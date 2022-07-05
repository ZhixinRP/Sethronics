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
$orders = wc_get_orders(array('status' => 'completed'));
foreach ($orders as $order) {
    echo $order;
}
?>


<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
<div class="wrap">
    <div class="title">Order Manager</div>
    <div class="tabs">
        <div class="tab-header">
            <div class="tab active">Manage Orders</div>
            <div class="tab">Assign Orders</div>
            <div class="tab">Export</div>
        </div>

        <div class="tab-body">
            <div class="tab-content active">
                <div class="sub-title">Orders List</div>
                <table class="table table-bordered">
                    <thead class="table-dark table-bordered">
                        <tr>
                            <th>Order ID</th>
                            <th>Order Name</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $orders = wc_get_orders(array('status' => 'completed'));
                        foreach ($orders as $order) {
                            $oder_data = $order->get_data();
                            echo '<tr>
                            <td>' . esc_html($order->id) . '</td>
                            <td>' . esc_html($oder_data['shipping_address_1']) . '</td>
                            <td>' . esc_html($oder_data['billing']['address_1']. ', '.$oder_data['billing']['address_2'].' '.$oder_data['billing']['shipping_city'.', '.$oder_data['billing']['city'].''.$oder_data['billing']['state'].' '.$oder_data['billing']['postcode']]) . '</td>
                            <td class="flex">';

                            echo '<form method="post" action="' . get_the_permalink() . '" class="inline-block">';
                            echo '<button type="submit" name="" class="edit btn btn-primary" value="">Edit</button>';
                            echo '</form>';

                            echo '<form method="post" action="' . get_the_permalink() . '" class="inline-block">';
                            echo '<button type="submit" name="delete_dp" class="delete btn btn-danger" value="");">Delete</button>';
                            echo '</form></td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-content">
                <div class="sub-title">Assign Orders</div>
            </div>
            <div class="tab-content">
                <div class="sub-title">This is Manage Order section</div>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi architecto illo facere voluptate unde blanditiis temporibus incidunt. Aperiam error eius culpa, debitis eum beatae minima, molestiae, ipsum animi nulla excepturi.</p>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>