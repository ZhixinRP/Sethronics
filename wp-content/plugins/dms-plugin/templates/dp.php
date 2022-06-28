<div class="wrap">
    <?php settings_errors(); ?>
    <div class="title">Delivery Personnel Manager</div>
    <div class="tabs">
        <div class="tab-header">
            <div class="tab active">Manage Delivery Personnel</div>
            <div class="tab">Add Delivery Personnel</div>
            <div class="tab">Export</div>
        </div>
        <div class="tab-body">
            <div class="tab-content active">
                <h3>This is Manage Order section</h3>
                <form method="post" action="options.php">
                    <?php
                    settings_fields('dms_plugin_settings');
                    do_settings_sections('dms_plugin');
                    submit_button();
                    ?>
                </form>
            </div>
            <div class="tab-content">
                <h3>This is Assign Order section</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi architecto illo facere voluptate unde blanditiis temporibus incidunt. Aperiam error eius culpa, debitis eum beatae minima, molestiae, ipsum animi nulla excepturi.</p>
            </div>
            <div class="tab-content">
                <h3>This is Manage Order section</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi architecto illo facere voluptate unde blanditiis temporibus incidunt. Aperiam error eius culpa, debitis eum beatae minima, molestiae, ipsum animi nulla excepturi.</p>
            </div>
        </div>
    </div>
</div>