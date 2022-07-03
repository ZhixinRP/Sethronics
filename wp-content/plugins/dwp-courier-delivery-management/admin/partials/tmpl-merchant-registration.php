<?php
    // Include Necessary Javascripts for Uploading Media.
    wp_enqueue_media();
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br>
            <?php
                $date_time = date(get_option('date_format'));
            ?>
            <span class="d-flex flex-row-reverse"><?php esc_html_e("Today is ","dwp-courier-delivery-management").esc_html_e($date_time); ?></span>           
        </div>
        <div class="col-md-12">
            <div class="merchant-register-heading font-style">
                <h2><?php esc_html_e("Register Your Merchant Account","dwpcmd");?></h2>
            </div>
                <form action="javascript:void(0)" method="post"  id="merchant-registration-form" >                    
                    <div class="form-group row">
                        <label for="mrchnt_name" class="col-sm-2 col-form-label"><?php esc_html_e("Merchant Name:","dwpcmd");?></label>
                        <div class="col-sm-4">
                        <input type="text" required class="form-control" name="mrchnt_name" id="mrchnt_name" placeholder="Enter Your Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mrchnt_email" class="col-sm-2 col-form-label"><?php esc_html_e("Business Email:","dwpcmd");?></label>
                        <div class="col-sm-4">
                        <input type="email" required class="form-control" name="mrchnt_email" id="mrchnt_email" placeholder="Enter Your Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mrchnt_phone" class="col-sm-2 col-form-label"><?php esc_html_e("Business Phone:","dwpcmd");?></label>
                        <div class="col-sm-4">
                        <input type="number" required class="form-control" name="mrchnt_phone" id="mrchnt_phone" placeholder="Enter Your Phone Number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mrchnt_address" required class="col-sm-2 col-form-label"><?php esc_html_e("Business Address:","dwpcmd");?></label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" name="mrchnt_address" id="mrchnt_address" placeholder="3374 Whitetail Lane">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mrchnt_webpage" class="col-sm-2 col-form-label"><?php esc_html_e("Web Address:","dwpcmd");?></label>
                        <div class="col-sm-6">
                        <input type="url" class="form-control" name="mrchnt_webpage" id="mrchnt_webpage" placeholder="http://facebook.com/business-page">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product_type" class="col-sm-2 col-form-label"><?php esc_html_e("Product Type:","dwpcmd");?></label>
                        <div class="col-sm-2">
                        <select name="product_type" id="product_type">
                            <option value="1"><?php esc_html_e("Clothing","dwpcmd");?></option>
                            <option value="2"><?php esc_html_e("Electronics","dwpcmd");?></option>
                            <option value="3"><?php esc_html_e("Digital","dwpcmd");?></option>
                            <option value="4"><?php esc_html_e("Liquid","dwpcmd");?></option>
                            <option value="5"><?php esc_html_e("Fashion","dwpcmd");?></option>
                        </select>
                        </div>
                        <label for="product_weight" class="col-sm-2 col-form-label"><?php esc_html_e("Product Weight:","dwpcmd");?></label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="product_weight" id="product_weight" placeholder="Product Weight">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expected_delivery" class="col-sm-2 col-form-label"><?php esc_html_e("Expected Delivery:","dwpcmd");?></label>
                        <div class="col-sm-6">
                        <input type="number" class="form-control" name="expected_delivery" id="expected_delivery" placeholder="Example: 10kg / 10 Unit / 100 Unit / 500 Unit">
                        <br>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="verification_document" class="col-sm-2 col-form-label" style="padding-top:20px"><?php esc_html_e("Verification Document:","dwpcmd");?></label>
                        <div class="col-sm-4">
                            <br>
                        <input type="button" class="form-control btn btn-info" name="verification_document" id="verification_document" value="Upload Verification Document">
                        <span class="dwp-notice"><?php esc_html_e("Note: Upload NID/ Business Trade License in .jpg or .png format.","dwp-courier-delivery-management")?></span>
                        </div>

                        <div class="col-sm-2">
                            <img src="<?php echo esc_url(DWP_COURIER_MANAGEMENT_PLUGIN_URL."assets/images/placeholder.png"); ?>" id="merchant-verification-document" class="merchant-verification-document" alt="">
                            <input type="hidden" name="merchant-verify-doc-hide" id="merchant-verify-doc-hide">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="merchant_shop_icon" class="col-sm-2 col-form-label" style="padding-top:20px"><?php esc_html_e("Upload Shop Image :","dwpcmd");?></label>
                        <div class="col-sm-4">
                            <br>
                        <input type="button" class="form-control btn btn-info" name="merchant_shop_icon" id="merchant_shop_icon" value="Upload Shop Image">
                        <span class="dwp-notice"><?php esc_html_e("Note: Shop Logo / Business Gravatar / Business Logo in .jpg .png format.","dwp-courier-delivery-management")?></span>
                        </div>
                        
                        <div class="col-sm-2">
                            <img src="<?php echo esc_url( DWP_COURIER_MANAGEMENT_PLUGIN_URL."assets/images/placeholder.png");?>" id="merchant-shop-image" class="merchant-verification-document" alt="">
                            <input type="hidden" name="merchant_shop_hidden_image" id="merchant-shop-hidden-image">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <br> 
                            <?php wp_nonce_field("merchant_delete_action_nonce","merchant_delete_name_nonce");?>
                            <button type="submit" class="btn btn-primary"><?php esc_html_e("Register Merchant","dwp-courier-delivery-management")?></button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>