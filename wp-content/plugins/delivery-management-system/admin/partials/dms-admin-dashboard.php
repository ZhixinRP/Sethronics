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
$user = wp_get_current_user();
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<!-- BOOTSTRAP STYLES -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">

<div class="dashboard">
    <h1>Delivery Management System</h1>
    <h2><?php echo "Welcome, " . $user->user_login ?></h2>
    <div class="item-container pt-5 text-center">
        <a href="admin.php?page=dms_admin_dp" class="text-decoration-none text-dark">
            <div class="item">
                <img class="icon" src="<?php echo esc_url(DMS_PLUGIN_URL . "assets/images/delivery-icon.png"); ?>" alt="">
                <h4 class="pt-3">DP Manager</h4>
            </div>
        </a>
        <a href="admin.php?page=dms_admin_orders" class="text-decoration-none text-dark">
            <div class="item">
                <img class="icon" src="<?php echo esc_url(DMS_PLUGIN_URL . "assets/images/order-icon.png"); ?>" alt="">
                <h4 class="pt-3">Orders Manager</h4>
            </div>
        </a>
    </div>
</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>