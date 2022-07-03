<div class="wrap">
    <div class="title">Orders</div>
    <div class="tabs">
        <div class="tab-header">
            <div class="tab active">Manage Orders</div>
            <div class="tab">Assign Orders</div>
            <div class="tab">Export</div>
        </div>
        <div class="tab-body">
            <div class="tab-content active">
                <form method="post" action="options.php">
                    <!-- // //Outputs nonce, action, and option_page fields for a settings page.
                    // settings_fields('dms_plugin_dp_settings');
                    // //Prints out all settings sections added to a particular settings page
                    // do_settings_sections('dms_dp');
                    // submit_button('Add Delivery Personnel', 'button-primary', 'submit', false); -->
                    <?php settings_fields('dms_plugin_dp_settings'); ?>
                    <table class="form-table">
                        <tbody>
                            <tr>
                                <th><label for="dms_plugin_dp">Username (required)</label></th>
                                <td><input name="dms_plugin_dp[username]" id="dms_plugin_dp" class="regular-text" type="text" value="<?php echo get_option(''); ?>" required></td>
                            </tr>
                            <tr>
                                <th><label for="dms_plugin_dp">Password (required)</label></th>
                                <td><input name="dms_plugin_dp[password]" id="dms_plugin_dp" class="regular-text" type="text" value="<?php echo get_option(''); ?>" required></td>
                            </tr>
                            <tr>
                                <th><label for="">Confirm Password (required)</label></th>
                                <td><input name="" id="" class="regular-text" type="text" value="" required></td>
                            </tr>
                            <tr>
                                <th><label for="dms_plugin_dp">Phone Number (required)</label></th>
                                <td><input name="dms_plugin_dp[phone_number]" id="dms_plugin_dp" class="regular-text" type="text" value="<?php echo get_option(''); ?>" required></td>
                            </tr>
                            <tr>
                                <th><label for="dms_plugin_dp">Email Address (required)</label></th>
                                <td><input name="dms_plugin_dp[email]" id="dms_plugin_dp" class="regular-text" type="text" value="<?php echo get_option(''); ?>" required></td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="submit" class="button" name="add" value="Add Delivery Personnel">
                    <?php submit_button('Add Delivery Personnel', 'button-primary', 'submit', false); ?>
                </form>
            </div>
            <div class="tab-content">
                <h3>This is Assign Order section</h3>
                <form method="post" action="<?php echo get_the_permalink(); ?>">
                    <table class="form-table">
                        <tbody>
                            <tr>
                                <th><label>Assign Order (required)</label></th>
                                <td><?php wp_dropdown_users(array('who' => 'delivery_personnel')); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="submit" class="button" name="add" value="Add Delivery Personnel">
                </form>
            </div>
            <div class="tab-content">
                <?php
                $votes = get_post_meta($post->ID, "votes", true);
                $votes = ($votes == "") ? 0 : $votes;
                ?>
                This post has <div id='vote_counter'><?php echo $votes ?></div> votes<br>

                <?php
                $nonce = wp_create_nonce("my_user_vote_nonce");
                $link = admin_url('admin-ajax.php?action=my_user_vote&post_id=' . $post->ID . '&nonce=' . $nonce);
                echo '<a class="user_vote" data-nonce="' . $nonce . '" data-post_id="' . $post->ID . '" href="' . $link . '">vote for this article</a>';
                ?>
            </div>
        </div>
    </div>
</div>