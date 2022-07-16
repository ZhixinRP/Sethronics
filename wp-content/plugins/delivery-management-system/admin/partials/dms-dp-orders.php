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

if (isset($_POST['accept_order'])) {
    $order_id = $_POST['accept_order'];
    $sql = $wpdb->prepare("UPDATE $table_name SET is_accepted = 1 WHERE order_id = '$order_id'");
    $result = $wpdb->query($sql);
    if ($result) {
        echo "<p id='alert' class='alert alert-success'>Order Accepted</p>";
    } else {
        echo "<p id='alert' class='alert alert-danger'>" . $wpdb->last_error . "</p>";
    }
}
if (isset($_POST['reject_order'])) {
    $order_id = $_POST['reject_order'];
    $sql = $wpdb->prepare("UPDATE $table_name SET is_accepted = 0, delivery_personnel = '' WHERE order_id = '$order_id'");
    $result = $wpdb->query($sql);
    if ($result) {
        echo "<p id='alert' class='alert alert-success'>Order Rejected</p>";
    } else {
        echo "<p id='alert' class='alert alert-danger'>" . $wpdb->last_error . "</p>";
    }
}

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
<div class="wrap">
    <div class="title">Order Manager</div>
    <div class="tabs">
        <div class="tab-header">
            <div class="tab active">Incoming Orders</div>
            <div class="tab">Accepted Orders</div>
            <div class="tab">Export</div>
        </div>

        <div class="tab-body">
            <div class="tab-content active">
                <div class="sub-title">Incoming Orders</div>
                <table class="table table-bordered">
                    <thead class="table-dark table-bordered">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Weight</th>
                            <th>Delivery Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        global $wpdb;
                        $user = wp_get_current_user();
                        $order_list = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE delivery_personnel='" . $user->user_login . "' AND is_accepted = 0");
                        foreach ($order_list as $index => $data) {
                            $ol_id = isset($data->order_id) ? $data->order_id : '-';
                            $ol_customer_name = isset($data->customer_name) ? $data->customer_name : '-';
                            $ol_order_address = isset($data->order_address) ? $data->order_address : '-';
                            $ol_weight = isset($data->order_weight) ? $data->order_weight : '-';
                            $ol_status = isset($data->delivery_status) ? $data->delivery_status : '-';
                            $ol_datetime = isset($data->delivery_datetime) ? $data->delivery_datetime : '-';
                        ?>
                            <tr>
                                <td><?php esc_html_e($ol_id); ?></td>
                                <td><?php esc_html_e($ol_customer_name); ?></td>
                                <td><?php esc_html_e($ol_order_address); ?></td>
                                <td><?php esc_html_e($ol_weight); ?></td>
                                <td><?php esc_html_e($ol_status); ?></td>
                                <td class="flex">
                                    <form method="post" action="<?php get_the_permalink() ?>" class="inline-block">
                                        <button type="submit" name="accept_order" class="btn btn-success" value="<?php esc_html_e($ol_id) ?>">Accept</button>
                                    </form>
                                    <form method="post" action="<?php get_the_permalink() ?>" class="inline-block">
                                        <button type="submit" name="reject_order" class="btn btn-danger" value="<?php esc_html_e($ol_id) ?>" );">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-content">
                <div class="sub-title">Accepted Orders</div>
                <table class="table table-bordered">
                    <thead class="table-dark table-bordered">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Weight</th>
                            <th>Delivery Status</th>
                            <th>Delivered Datetime</th>
                            <th>Delivered Photo Evidence</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        global $wpdb;
                        $user = wp_get_current_user();
                        $order_list = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE delivery_personnel='" . $user->user_login . "' AND is_accepted = 1");
                        foreach ($order_list as $index => $data) {
                            $ol_id = isset($data->order_id) ? $data->order_id : '-';
                            $ol_customer_name = isset($data->customer_name) ? $data->customer_name : '-';
                            $ol_order_address = isset($data->order_address) ? $data->order_address : '-';
                            $ol_weight = isset($data->order_weight) ? $data->order_weight : '-';
                            $ol_status = isset($data->delivery_status) ? $data->delivery_status : '-';
                            $ol_datetime = isset($data->delivery_datetime) ? $data->delivery_datetime : '-';
                            $ol_photo = isset($data->photo_evidence) ? $data->photo_evidence : '';
                        ?>
                            <tr>
                                <td><?php esc_html_e($ol_id); ?></td>
                                <td><?php esc_html_e($ol_customer_name); ?></td>
                                <td><?php esc_html_e($ol_order_address); ?></td>
                                <td><?php esc_html_e($ol_weight); ?></td>
                                <td><?php esc_html_e($ol_status); ?></td>
                                <td><?php esc_html_e($ol_datetime); ?></td>
                                <td>
                                    <?php if (!empty($ol_photo)) {
                                    ?>
                                        <img src="<?php echo esc_url($ol_photo); ?>" height="100%" width="200px">
                                    <?php
                                    } else {
                                        esc_html_e("No Image");
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-success updateBtn">Edit</button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-content">
            </div>
        </div>
    </div>
</div>
<!-- EDIT ORDER DETAILS POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="updatemodal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="updatecode.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="update_id" id="update_id">
                    <div class="row">
                        <div class="form-group col">
                            <label class="col-form-label">Delivery Status:</label>
                            <select id="status_type" class="form-control">
                                <option value="1">In Transit</option>
                                <option value="2">Delivered</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label">Delivered Date & Time:</label>
                            <input type="datetime-local" id="delivered-datetime" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Photo Evidence</label>
                        <img src="<?php echo esc_url(DMS_PLUGIN_URL . "assets/images/placeholder.png"); ?>" class="photo-evidence" id="photo_evidence">
                        <input type="button" class="btn btn-info" id="uploadBtn" value="Upload Photo Evidence">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="updatedata" class="btn btn-primary">Update Order</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>


<!-- <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script> -->