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
            echo "<p id='alert' class='alert alert-danger'>" . $user_id->get_error_message() . "</p>";
        }
    } else {
        echo "<p id='alert' class='alert alert-danger'>Password does not match! Please Retry</p>";
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

if (isset($_POST['delete_dp'])) {
    $delete_dp = get_user_by('ID', $_POST['delete_dp']);
    $delete_id =  esc_html($delete_dp->ID);
    wp_delete_user($delete_id);
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
            echo "<p id='alert' class='alert alert-danger'>" . $user_id->get_error_message() . "</p>";
        }
    } else {
        echo "<p id='alert' class='alert alert-danger'>Password does not match! Please Retry</p>";
    }
}

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
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
                <div class="sub-title">Delivery Personnel List</div>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>User Login</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dp_users = get_users('role=delivery_personnel');
                        foreach ($dp_users as $dp_user) {
                            echo '<tr>
                            <td>' . esc_html($dp_user->user_login) . '</td>
                            <td>' . esc_html($dp_user->user_nicename) . '</td>
                            <td>' . esc_html($dp_user->user_email) . '</td>
                            <td class="flex">';

                            echo '<form method="post" action="' . get_the_permalink() . '" class="inline-block">';
                            echo '<button type="submit" name="edit_dp" class="edit btn btn-primary" value="' . esc_html($dp_user->ID) . '">Edit</button>';
                            echo '</form>';

                            echo '<form method="post" action="' . get_the_permalink() . '" class="inline-block">';
                            echo '<button type="submit" name="delete_dp" class="delete btn btn-danger" value="' . esc_html($dp_user->ID) . '");">Delete</button>';
                            echo '</form></td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-content <?php echo isset($_POST['edit_dp']) ? 'active' : '' ?>">
                <div class="sub-title"><?php echo isset($_POST['edit_dp']) ? 'Edit' : 'Add' ?> Delivery Personnel</div>
                <form method="post" action="<?php echo get_the_permalink(); ?>">
                    <table class="form-table">
                        <tbody>
                            <tr>
                                <th><label><?php echo isset($_POST['edit_dp']) ? 'Username (required)' : 'User Login (required) <i class="fa-solid fa-circle-info" data-toggle="tooltip" title="User Login cannot be changed after user is created"></i>' ?></label></th>
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
                            <tr>
                                <td>
                                    <button type="submit" class="btn btn-success" name="<?php echo isset($_POST['edit_dp']) ? 'edit' : 'add' ?>"><?php echo isset($_POST['edit_dp']) ? 'Edit' : 'Add' ?></button>
                                    <?php echo isset($_POST['edit_dp']) ? '<button onClick="window.location.reload();" class="btn btn-danger">Cancel</button>' : '' ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="tab-content">
                <div class="sub-title">This is Manage Order section</div>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi architecto illo facere voluptate unde blanditiis temporibus incidunt. Aperiam error eius culpa, debitis eum beatae minima, molestiae, ipsum animi nulla excepturi.</p>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>