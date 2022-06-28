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
                <?php
                // $options = get_option('dms_plugin_dp') ?: array();

                // echo '<table class="cpt-table"><tr><th>Full Name</th><th>Phone Number</th><th class="text-center">Actions</th></tr>';

                // foreach ($options as $option) {

                //     echo "<tr><td>{$option['dp']}</td><td>{$option['singular_name']}</td><td class=\"text-center\">{$hierarchical}</td><td class=\"text-center\">";

                //     echo '<form method="post" action="" class="inline-block">';
                //     echo '<input type="hidden" name="edit_taxonomy" value="' . $option['taxonomy'] . '">';
                //     submit_button('Edit', 'primary small', 'submit', false);
                //     echo '</form> ';

                //     echo '<form method="post" action="options.php" class="inline-block">';
                //     settings_fields('alecaddd_plugin_tax_settings');
                //     echo '<input type="hidden" name="remove" value="' . $option['taxonomy'] . '">';
                //     submit_button('Delete', 'delete small', 'submit', false, array(
                //         'onclick' => 'return confirm("Are you sure you want to delete this Custom Taxonomy? The data associated with it will not be deleted.");'
                //     ));
                //     echo '</form></td></tr>';
                // }

                // echo '</table>';
                ?>
            </div>
            <div class="tab-content">
                <form method="post" action="options.php">
                    <?php
                    settings_fields('dms_plugin_dp_settings');
                    do_settings_sections('dms_dp');
                    submit_button();
                    ?>
                </form>
            </div>
            <div class="tab-content">
                <h3>This is Manage Order section</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi architecto illo facere voluptate unde blanditiis temporibus incidunt. Aperiam error eius culpa, debitis eum beatae minima, molestiae, ipsum animi nulla excepturi.</p>
            </div>
        </div>
    </div>
</div>