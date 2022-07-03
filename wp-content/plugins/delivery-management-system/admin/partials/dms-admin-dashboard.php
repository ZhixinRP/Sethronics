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
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="dashboard">
    <p class="db-title">Delivery Management System<br />
        <?php $user = wp_get_current_user();
        echo "Welcome, " . $user->display_name ?></p>
    <div class="item-container">
        <a href="admin.php?page=dms_admin_dp">
            <div class="item">
                <img class="icon" src="<?php echo esc_url(PLUGIN_URL . "assets/images/delivery-icon.png"); ?>" alt="">
                <p class="icon-text">Delivery Personnel Manager</p>
            </div>
        </a>
        <a href="admin.php?page=dms_admin_orders">
            <div class="item">
                <img class="icon" src="<?php echo esc_url(PLUGIN_URL . "assets/images/order-icon.png"); ?>" alt="">
                <p class="icon-text">Orders Manager</p>
            </div>
        </a>
    </div>
</div>