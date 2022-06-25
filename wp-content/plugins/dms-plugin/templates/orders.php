<h1>Assign Orders</h1>
<form method="post" action="options.php">
    <?php
    settings_fields('dms_options_group');
    do_settings_sections('dms_plugin');
    submit_button();
    ?>
</form>