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

// Get delivery personnel
$args = array(
    'role' => 'delivery_personnel'
);
$users = get_users($args);

// Update DMS table for assigning delivery personnel
if(isset($_POST['assign_dp_btn'])){
    $DP_selected = $_POST['select_dp'];
    $order_id = $_POST['assign_dp_btn'];
    if($DP_selected == 'none'){
        echo "<p class='alert alert-info'>Please select a valid delivery personnel!</p>";
    }
    else{
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
}

//Filter order by delivery personnel
$sql_filter = $wpdb->prepare("SELECT * FROM $table_name WHERE  (delivery_personnel != ''  OR delivery_personnel IS NOT NULL) ");
if(isset($_POST['filter_order_btn'])){
    $dp_filter = $_POST['fetchval'];
    if($dp_filter != 'all'){
        $sql_filter .= $wpdb->prepare("AND delivery_personnel = '$dp_filter'");
    }
    $result = $wpdb->query($sql_filter);
    if($result) {
        echo "<p class='alert alert-success'>".$result." Orders found for ".$dp_filter."</p>";
    } else {
        echo "<p class='alert alert-info'>No orders found for delivery personnel</p>";
    }

}

?>



<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">


<!-- Files for Jquery Ajax filter dropdown list -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="wrap">
    <div class="title">Order Manager</div>
    <div class="tabs">
        <div class="tab-header">
            <div class="tab active unassign-orders-tab">Unassigned Orders</div>
            <div class="tab assign-orders-tab">Assigned Orders</div>
            <div class="tab">Export</div>
        </div>

        <div class="tab-body">
            <div class="tab-content active unassign-orders-tab-content">
                <div class="sub-title">Unassigned Orders</div>
                <div>Select Delivery Personnel:</div>


                <form method="post">

                <select class="dropdown mb-4" id="select_dp" name="select_dp">
                    <option value="none">Select a delivery personnel</option>
                <?php
                foreach ($users as $user){
                ?>

                    <option value=<?php esc_html_e($user->user_login);?>><?php esc_html_e($user->user_login)?> [<?php esc_html_e($user->user_email)?>]</option>
                
                <?php
                }
                ?>

                </select>

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
                        // global $wpdb;
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
            <div class="tab-content assign-orders-tab-content">
                <form method="post">
                <div class="sub-title">Assigned Orders</div>
                <div></div>
                <div id="filters">
                    <select name="fetchval" id="fetchval" class="dropdown mb-4">
                        <option selected="" value="all">All</option>
                    <?php
                        foreach ($users as $user){
                    ?>

                            <option value=<?php esc_html_e($user->user_login);?>><?php esc_html_e($user->user_login)?> [<?php esc_html_e($user->user_email)?>]</option>
                
                    <?php
                        }
                    ?>

                    </select>
                    <button type="submit" name="filter_order_btn" class="btn btn-info mb-4 filterbtn" onclick="switchToAssign">Filter</button>
                </form>
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
                        <?php 
                        $order_filter = $wpdb->get_results($sql_filter);
                        foreach ($order_filter as $index => $data){
                            $ol_id = isset($data->order_id) ? $data->order_id : '-';
                            $ol_customer_name = isset($data->customer_name) ? $data->customer_name : '-';
                            $ol_order_address = isset($data->order_address) ? $data->order_address : '-';
                            $ol_dp = isset($data->delivery_personnel) ? $data->delivery_personnel : '-';
                            $ol_weight = isset($data->order_weight) ? $data->order_weight : '-';
                        ?>
                        <tr>
                            <td><?php esc_html_e($ol_id); ?></td>
                            <td><?php esc_html_e($ol_customer_name); ?></td>
                            <td><?php esc_html_e($ol_order_address); ?></td>
                            <td><?php esc_html_e($ol_dp); ?></td>
                            <td><?php esc_html_e($ol_weight); ?></td>
                            <td><?php esc_html_e($ol_status); ?></td>

                        </tr>

                        <?php
                        }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-content">
                <div class="sub-title">Export Section</div>
            </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script type="text/javascript">
    <?php if(isset($_POST['select_dp'])){ ?>
        document.getElementById('select_dp').value = "<?php echo $_POST['select_dp'];?>";
    <?php } ?>

    <?php if(isset($_POST['fetchval'])){ ?>
        document.getElementById('fetchval').value = "<?php echo $_POST['fetchval'];?>";
    <?php } ?>

    
    // function switchToAssign() {
    //     var UOTab = document.getElementById("unassign-orders-tab");
    //     var UOContent = document.getElementById("unassign-orders-tab-content");
    //     var AOTab = document.getElementById("assign-orders-tab");
    //     var AOContent = document.getElementById("assign-orders-tab-content") 
        
    //     UOTab.classList.remove("active");
    //     UOContent.classList.remove("active");
    //     AOTab.classList.add("active");
    //     AOContent.classList.add("active");
    // }


</script>