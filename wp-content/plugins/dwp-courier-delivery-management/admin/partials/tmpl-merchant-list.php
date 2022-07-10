<div>
    <div class="col-md-12">
        <br>
        <?php
        $date_time = date(get_option('date_format'));
        ?>
        <span class="d-flex flex-row-reverse"><?php esc_html_e("Today is ", "dwp-courier-delivery-management") . esc_html_e($date_time); ?></span>
    </div>
    <br>
    <div class="container-fluid py-5 bg-light text-center">
        <h1><?php esc_html_e("MERCHANT LIST", "dwp-courier-delivery-management") ?></h1>
    </div>

    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <table id="merchant-list-table" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th><?php esc_html_e("ID", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Name", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Email", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Phone", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Address", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Web Address", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Product Type", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Product Weight", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Monthly Delivery", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Verification", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Shop Image", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Action", "dwp-courier-delivery-management") ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if ($merchant_list > 0) {
                            foreach ($merchant_list as $index => $data) {

                                $m1_id = isset($data->id) ? $data->id : '';
                                $m1_name = isset($data->mrcnt_name) ? $data->mrcnt_name : '';
                                $m1_email = isset($data->mrcnt_email) ? $data->mrcnt_email : '';
                                $m1_phn = isset($data->mrcnt_phone) ? $data->mrcnt_phone : '';
                                $m1_b_addr = isset($data->business_address) ? $data->business_address : '';
                                $m1_w_addr = isset($data->business_address) ? $data->web_address : '';
                                $p_type = isset($data->product_type) ? $data->product_type : '';
                                $p_weight = isset($data->product_weight) ? $data->product_weight : '';
                                $p_e_delivery = isset($data->expected_deliveery) ? $data->expected_deliveery : '';
                                $m_document = isset($data->mrcnt_document) ? $data->mrcnt_document : '';
                                $m_shop_image = isset($data->shop_image) ? $data->shop_image : '';
                        ?>

                                <!-- Display Merchant List -->

                                <tr>
                                    <td><?php esc_html_e($m1_id); ?></td>
                                    <td><?php esc_html_e($m1_name); ?></td>
                                    <td><?php esc_html_e($m1_email); ?></td>
                                    <td><?php esc_html_e($m1_phn); ?></td>
                                    <td><?php esc_html_e($m1_b_addr); ?></td>
                                    <td>
                                        <?php
                                        if (!empty($m1_w_addr)) {
                                        ?>
                                            <a href="<?php echo esc_url($m1_w_addr) ?>"><?php esc_html_e("Merchant Website", "dwp-courier-delivery-management"); ?></a>
                                        <?php
                                        } else {
                                            esc_html_e("No Link", "dwp-courier-delivery-management");
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($p_type == 1) {
                                            esc_html_e("Clothing", "dwp-courier-delivery-management");
                                        } elseif ($p_type == 2) {
                                            esc_html_e("Electronics", "dwp-courier-delivery-management");
                                        } elseif ($p_type == 3) {
                                            esc_html_e("Digital", "dwp-courier-delivery-management");
                                        } elseif ($p_type == 4) {
                                            esc_html_e("Liquid", "dwp-courier-delivery-management");
                                        } elseif ($p_type == 5) {
                                            esc_html_e("Fashion", "dwp-courier-delivery-management");
                                        }
                                        ?>
                                    </td>
                                    <td><?php esc_html_e($p_weight) . esc_html_e(" Kg", "dwp-courier-delivery-management"); ?></td>
                                    <td><?php esc_html_e($p_e_delivery) . esc_html_e(" Unit", "dwp-courier-delivery-management"); ?></td>
                                    <td><?php if (!empty($m_document)) {
                                        ?>
                                            <img src="<?php echo esc_url($m_document); ?>" height="100%" width="100px">
                                        <?php
                                        } else {
                                            esc_html_e("No Image", "dwp-courier-delivery-management");
                                        }
                                        ?>
                                    </td>
                                    <td><?php if (!empty($m_shop_image)) {
                                        ?>
                                            <img src="<?php echo esc_url($m_shop_image) ?>" height="100%" width="100px">
                                        <?php
                                        } else {
                                            esc_html_e("No Image", "dwp-courier-delivery-management");
                                        }
                                        ?>
                                    </td>
                                    <td><button class="btn btn-danger" id="merchant-delete-btn" data-id="<?php echo esc_attr($m1_id); ?>"><?php esc_html_e("Delete", "dwp-courier-delivery-management") ?></button></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><?php esc_html_e("ID", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Name", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Email", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Phone", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Address", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Web Address", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Product Type", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Product Weight", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Monthly Delivery", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Verification", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Shop Image", "dwp-courier-delivery-management") ?></th>
                            <th><?php esc_html_e("Action", "dwp-courier-delivery-management") ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>