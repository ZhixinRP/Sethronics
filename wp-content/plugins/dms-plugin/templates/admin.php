<div class="dashboard">
    <p class="db-title">Delivery Management System<br />
        <?php $user = wp_get_current_user();
        echo "Welcome, " . $user->display_name ?></p>
    <div class="item-container">
        <a href="admin.php?page=dms_dp">
            <div class="item">
                <img class="icon" src="<?php echo esc_url(PLUGIN_URL . "assets/images/delivery-icon.png"); ?>" alt="">
                <p class="icon-text">Delivery Personnel Manager</p>
            </div>
        </a>
        <a href="admin.php?page=dms_orders">
            <div class="item">
                <img class="icon" src="<?php echo esc_url(PLUGIN_URL . "assets/images/order-icon.png"); ?>" alt="">
                <p class="icon-text">Orders Manager</p>
            </div>
        </a>
    </div>
</div>