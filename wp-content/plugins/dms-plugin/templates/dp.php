<?php

if (isset($_POST['add'])) {
    //prevent SQL injection
    global $wpdb;
    $username = $wpdb->escape($_POST['username']);
    $email = $wpdb->escape($_POST['email']);
    $fname = $wpdb->escape($_POST['fname']);
    $lname = $wpdb->escape($_POST['lname']);
    $pass = $wpdb->escape($_POST['pass']);
    $con_pass = $wpdb->escape($_POST['con_pass']);

    if ($pass == $con_pass) {
        $user_data = array(
            'user_login' => $username,
            'user_email' => $email,
            'first_name' => $fname,
            'last_name' => $lname,
            'display_name' => $fname . ' ' . $lname,
            'user_pass' => $pass,
        );
        //insert user to db
        $user_id = wp_insert_user($user_data);
        //Initalise and assign the user to dp
        $user_id_role = new WP_User($user_id);
        $user_id_role->set_role('delivery_personnel');
        if (!is_wp_error($user_id)) {
            echo "<p id='alert' class='alert alert-success'>User Created Successfully!</p>";
        } else {
            echo "<p id='alert' class='alert alert-fail'>" . $user_id->get_error_message() . "</p>";
        }
    } else {
        echo "<p id='alert' class='alert alert-fail'>Password does not match! Please Retry</p>";
    }
}

if (isset($_POST['edit_dp'])) {
    $edit_dp = get_user_by('ID', $_POST['edit_dp']);
    $edit_id =  esc_html($edit_dp->ID);
    $edit_username =  esc_html($edit_dp->user_nicename);
    $edit_email =  esc_html($edit_dp->user_email);
    $edit_fname =  esc_html($edit_dp->first_name);
    $edit_lname =  esc_html($edit_dp->last_name);
    session_start();
    $_SESSION["ID"] = $edit_id;
}

if (isset($_POST['edit'])) {
    global $wpdb;
    $username = $wpdb->escape($_POST['username']);
    $email = $wpdb->escape($_POST['email']);
    $fname = $wpdb->escape($_POST['fname']);
    $lname = $wpdb->escape($_POST['lname']);
    $pass = $wpdb->escape($_POST['pass']);
    $con_pass = $wpdb->escape($_POST['con_pass']);
    session_start();
    $id = $_SESSION["ID"];
    // echo $username, $email, $fname, $lname, $pass;
    // echo $id;
    if ($pass == $con_pass) {
        $user_data = array(
            'ID' => $id,
            'user_nicename' => $username,
            'user_email' => $email,
            'first_name' => $fname,
            'last_name' => $lname,
            'display_name' => $fname . ' ' . $lname,
            'user_pass' => $pass,
        );
        //update user to db
        $user_id = wp_update_user($user_data);
        if (!is_wp_error($user_id)) {
            echo "<p id='alert' class='alert alert-success'>User Updated Successfully!</p>";
        } else {
            echo "<p id='alert' class='alert alert-fail'>" . $user_id->get_error_message() . "</p>";
        }
    } else {
        echo "<p id='alert' class='alert alert-fail'>Password does not match! Please Retry</p>";
    }
}
?>

<div class="wrap">
    <div class="title">Delivery Personnel Manager</div>
    <div class="tabs">
        <div class="tab-header">
            <div class="tab <?php echo !isset($_POST['edit_dp']) ? 'active' : '' ?>">Manage Delivery Personnel</div>
            <div class="tab <?php echo isset($_POST['edit_dp']) ? 'active' : '' ?>"><?php echo isset($_POST['edit_dp']) ? 'Edit' : 'Add' ?> Delivery Personnel</div>
            <div class="tab">Export</div>
        </div>
        <div class="tab-body">
            <div class="tab-content <?php echo !isset($_POST['edit_dp']) ? 'active' : '' ?>">
                <?php
                $dp_users = get_users('role=delivery_personnel');
                echo '<table class="dp-table"><tr><th>Username</th><th>Email</th><th class="text-center">Actions</th></tr>';
                foreach ($dp_users as $dp_user) {
                    echo '
                    <tr>
                    <td>' . esc_html($dp_user->user_nicename) . '</td>
                    <td>' . esc_html($dp_user->user_email) . '</td>
                    <td class="text-center">
                    ';

                    echo '<form method="post" action="' . get_the_permalink() . '" class="inline-block">';
                    echo '<input type="hidden" name="edit_dp" value="' . esc_html($dp_user->ID) . '">';
                    echo '<input type="submit" class="button" value="Edit" />';
                    echo '</form>';

                    echo '<form method="post" action="' . get_the_permalink() . '" class="inline-block">';
                    echo '<input type="hidden" name="delete_dp" value="' . esc_html($dp_user->ID) . '">';
                    echo '<input type="submit" class="button" value="Delete" />';
                    echo '</form></td></tr>';
                }
                echo '</table>';

                // $dp_users = get_users(['role__in' => ['delivery_personnel']]);

                // $options = get_option('dms_plugin_dp') ?: array();
                // echo '<table class="dp-table"><tr><th>Username</th><th>Email</th><th class="text-center">Actions</th></tr>';

                // foreach ($dp_users as $dp_user) {

                //     echo "<tr><td>{$dp_user['user_nicename']}</td><td>{$dp_user['user_email']}</td><td class=\"text-center\"></td><td class=\"text-center\">";

                // echo '<form method="post" action="" class="inline-block">';
                // echo '<input type="hidden" name="edit_taxonomy" value="' . $option['taxonomy'] . '">';
                // submit_button('Edit', 'primary small', 'submit', false);
                // echo '</form> ';

                // echo '<form method="post" action="options.php" class="inline-block">';
                // settings_fields('alecaddd_plugin_tax_settings');
                // echo '<input type="hidden" name="remove" value="' . $option['taxonomy'] . '">';
                // submit_button('Delete', 'delete small', 'submit', false, array(
                //     'onclick' => 'return confirm("Are you sure you want to delete this Custom Taxonomy? The data associated with it will not be deleted.");'
                // ));
                // echo '</form></td></tr>';
                // }

                // echo '</table>';
                ?>
            </div>
            <div class="tab-content <?php echo isset($_POST['edit_dp']) ? 'active' : '' ?>">
                <h3><?php echo isset($_POST['edit_dp']) ? 'Edit' : 'Add' ?> Delivery Personnel</h3>
                <form method="post" action="<?php echo get_the_permalink(); ?>">
                    <table class="form-table">
                        <tbody>
                            <tr>
                                <th><label>Username (required)</label></th>
                                <td><input name="username" id="username" class="regular-text" type="text" value="<?php echo isset($_POST['edit_dp']) ? $edit_username : '' ?>" required></td>
                            </tr>
                            <tr>
                                <th><label>Email Address (required)</label></th>
                                <td><input name="email" id="email" class="regular-text" type="text" value="<?php echo isset($_POST['edit_dp']) ? $edit_email : '' ?>" required></td>
                            </tr>
                            <tr>
                                <th><label>First Name (optional)</label></th>
                                <td><input name="fname" id="fname" class="regular-text" type="text" value="<?php echo isset($_POST['edit_dp']) ? $edit_fname : '' ?>"></td>
                            </tr>
                            <tr>
                                <th><label>Last Name (optional)</label></th>
                                <td><input name="lname" id="lname" class="regular-text" type="text" value="<?php echo isset($_POST['edit_dp']) ? $edit_lname : '' ?>"></td>
                            </tr>
                            <tr>
                                <th><label for="">Password (required)</label></th>
                                <td><input name="pass" id="pass" class="regular-text" type="password" required></td>
                            </tr>
                            <tr>
                                <th><label for="">Confirm Password (required)</label></th>
                                <td><input name="con_pass" id="con_pass" class="regular-text" type="password" required></td>
                            </tr>
                        </tbody>
                    </table>
                    <p><input type="submit" class="button" name="<?php echo isset($_POST['edit_dp']) ? 'edit' : 'add' ?>" value="<?php echo isset($_POST['edit_dp']) ? 'Edit' : 'Add' ?> Delivery Personnel"></p>
                </form>
            </div>
            <div class="tab-content">
                <h3>This is Manage Order section</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi architecto illo facere voluptate unde blanditiis temporibus incidunt. Aperiam error eius culpa, debitis eum beatae minima, molestiae, ipsum animi nulla excepturi.</p>
            </div>
        </div>
    </div>
</div>