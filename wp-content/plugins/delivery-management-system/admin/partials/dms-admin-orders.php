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
require_once(DMS_PLUGIN_PATH . "/admin/functions.php");
update_dms_table();
global $wpdb;
$table_name = $wpdb->prefix . "dms_orders";


// Delivery Personnel Selection
// if(isset($_POST['select_btn'])){
//     $DP_selected = $_POST['select_dp'];
//     echo $DP_selected;
// }


// Update DMS table for dp selected
if(isset($_POST['assign_dp_btn'])){

    $DP_selected = $_POST['select_dp'];
    $order_id = $_POST['assign_dp_btn'];
    

    // $order_id = $_POST['assign-id'];
    // echo $order_id;
    // echo $_POST['assign-id'];
    // echo $_POST['assign-id-text'];

    $sql = $wpdb->prepare("

    UPDATE $table_name 
    SET delivery_personnel = '$DP_selected' 
    WHERE order_id = '$order_id'

    ");

    $result = $wpdb->query($sql);

    if ($result) {
        echo "<p id='alert' class='alert alert-success'>Order Assigned</p>";
    } else {
        echo "<p id='alert' class='alert alert-danger'>Error" . $wpdb->last_error . "</p>";
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
                <div>Select Delivery Personnel:</div>


                <form method="post">
                <?php
                $args = array(
                    'role' => 'delivery_personnel'
                );
                $users = get_users($args);
                echo '<select id="select_dp" name="select_dp">';
                foreach ($users as $user){
                    echo '<option <?php if($_POST["select_dp"]) && $_POST["select_dp"]=='.$user->user_login.') echo "selected=\"selected\"";?>  value='. $user->user_login . '>'.esc_html($user->user_login).'</option>';
                }
                echo '</select>';
                ?>

                <table class="table table-bordered">
                    <thead class="table-dark table-bordered">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Delivery Personnel</th>
                            <th>Weight</th>
                            <th>Delivery Status</th>
                            <th>Delivered Datetime</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        global $wpdb;
                        $table_name = $wpdb->prefix . "dms_orders";
                        $order_list = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE delivery_personnel IS NULL OR delivery_personnel = ''");
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
                                
                                
                                
                                <td><button type="submit" name="assign_dp_btn" class="btn btn-success assignBtn" value="<?php esc_html_e($ol_id); ?>">Assign</button></td>
                                
                            <?php
                        }
                            ?>
                    </form>
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
