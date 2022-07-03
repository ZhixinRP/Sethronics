<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br>
            <?php
                $date_time = date(get_option('date_format'));
            ?>
            <span class="d-flex flex-row-reverse"><?php esc_html_e("Today is ","dwp-courier-delivery-management").esc_html_e($date_time); ?></span>
            <br>            
            <br>            
        </div>
        <div class="col-md-12">
            <div class="container-fluid py-5 bg-light text-center">
                <div class="container">
                    <h1 class="display-4 font-style"><?php esc_html_e("Courier & Delivery Management System","dwp-courier-delivery-management")?></h1>
                    <p class="lead font-style"><?php esc_html_e("Best Courier Management System for Transport & Logistic Company.","dwp-courier-delivery-management")?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="dashboard-main-options d-flex justify-content-center row">
        
    <div class="col-md-3">
            <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <a href="<?php echo esc_url(admin_url( 'admin.php?page=dwp-merchant-registration')); ?>">    
                        <span><i class="bi bi-person-plus-fill dashboard-icon-style"></i></span>
                    </a>
                </div>
            </div>
            <div class="panel-heading font-style">
                    <h3><?php esc_html_e("Register Merchant","dwp-courier-delivery-management")?></h3>
                </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <a href="<?php echo esc_url(admin_url( 'admin.php?page=dwp-merchant-list')); ?>">
                        <span><i class="bi bi-ui-radios dashboard-icon-style"></i></span>
                    </a>
                </div>
            </div>
            <div class="panel-heading font-style">
                    <h3><?php esc_html_e("Approved Merchant List","dwp-courier-delivery-management")?></h3>
                </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <a href="<?php echo esc_url(admin_url( 'admin.php?page=dwp-submit-delivery-request')); ?>">    
                        <span><i class="bi bi-truck dashboard-icon-style"></i></span>
                    </a>
                </div>
            </div>
            <div class="panel-heading font-style">
                    <h3><?php esc_html_e("Submit Delivery Request","dwp-courier-delivery-management")?></h3>
                </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <a href="<?php echo esc_url(admin_url( 'admin.php?page=dwp-delivery-list')); ?>">    
                        <span><i class="bi bi-ui-checks dashboard-icon-style"></i></span>
                    </a>
                </div>
            </div>
            <div class="panel-heading font-style">
                    <h3><?php esc_html_e("All Delivery Requests","dwp-courier-delivery-management")?></h3>
                </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php                
                printf(
                    '<span class="copyright">%2$s</span> <a href="%1$s ">%3$s</a>',
                    esc_url( 'https://dragwp.com' ),
                    esc_html__( 'Built with', 'dwp-courier-delivery-management' ),
                    esc_html__( 'Drag WP Courier & Delivery Management Plugin', 'dwp-courier-delivery-management' ),
                );                            
            ?>
        </div>
    </div>
</div>
