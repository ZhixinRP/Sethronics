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
                <h2><?php esc_html_e("Submit Delivery Request","dwpcmd");?></h2>
            </div>
                <form action="javascript:void(0)" method="post"  id="submit-delivery-form"  >                    
                <div class="select-area"> 
                    <h4><?php esc_html_e("Pick Up Details","dwpcmd");?></h4>
                </div>    
                    <div class="form-group row">
                        <label for="select_mrchnt" class="col-sm-2 col-form-label"><?php esc_html_e("Select Merchant:","dwpcmd");?></label>
                        <div class="col-sm-5">
                            <select name="select_mrchnt" id="select_mrchnt"> 
                                <option value=""><?php esc_html_e("Select Merchant","dwpcmd");?></option>
                                <?php 
                                    if(count($select_merchant) > 0){

                                    foreach($select_merchant as $key => $value){

                                        echo "<option value=".esc_attr($value->id).">".esc_html__($value->mrcnt_name)."</option>"; 
                                    }
    
                                }
                                ?>  
                            </select>
                            <i><p style='text-align: justify; margin-top:10px; font-size: 12px;'><b><?php esc_html_e("Note:", 'dwp-courier-delivery-management')?> </b>
                            <?php esc_html_e("Fill out below information in case pick up address is different.","dwp-courier-delivery-management"); ?></i></p>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="merchant_name_optional" class="col-sm-2 col-form-label"><?php esc_html_e("Merchant Name:","dwpcmd");?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="merchant_name_optional" id="merchant_name_optional" placeholder="Enter Merchant Name">
                        </div>
                        <div class="col-sm-2">
                            <?php esc_html_e("(Optional)","dwp-courier-delivery-management");?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="merchant_phone_optional" class="col-sm-2 col-form-label"><?php esc_html_e("Merchant Phone:","dwpcmd");?></label>
                        <div class="col-sm-4">
                        <input type="number" class="form-control" name="merchant_phone_optional" id="merchant_phone_optional" placeholder="Enter Merchant Phone Number">
                        </div>
                        <div class="col-sm-2">
                            <?php esc_html_e("(Optional)","dwp-courier-delivery-management");?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="merchant_address_optional" required class="col-sm-2 col-form-label"><?php esc_html_e("Merchant Address:","dwpcmd");?></label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" name="merchant_address_optional" id="merchant_address_optional" placeholder="3374 Whitetail Lane">
                        </div>
                        <div class="col-sm-2">
                            <?php esc_html_e("(Optional)","dwp-courier-delivery-management");?>
                        </div>
                    </div>
                                        
                <div class="select-area">
                    <h4><?php esc_html_e("Delivery Details","dwpcmd");?></h4>
                </div> 
                    <div class="form-group row">
                        <label for="customer_name" class="col-sm-2 col-form-label"><?php esc_html_e("Customer Name:","dwpcmd");?></label>
                        <div class="col-sm-4">
                        <input type="text" required class="form-control" name="customer_name" id="customer_name" placeholder="Enter Customer Name"> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customer_phone" class="col-sm-2 col-form-label"><?php esc_html_e("Customer Phone:","dwpcmd");?></label>
                        <div class="col-sm-4">
                        <input type="number" required class="form-control" name="customer_phone" id="customer_phone" placeholder="Enter Customer Phone Number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customer_address" required class="col-sm-2 col-form-label"><?php esc_html_e("Customer Address:","dwpcmd");?></label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" name="customer_address" id="customer_address" placeholder="3374 Whitetail Lane">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="payment_status" class="col-sm-2 col-form-label"><?php esc_html_e("Payment Status:","dwpcmd");?></label>
                        <div class="col-sm-2">
                        <select name="payment_status" id="payment_status">
                            <option value="1"><?php esc_html_e("Paid","dwpcmd");?></option>
                            <option value="2"><?php esc_html_e("Unpaid","dwpcmd");?></option>
                        </select>
                        </div>
                        <label for="amount_collect" class="col-sm-2 col-form-label"><?php esc_html_e("Amount to Collect:","dwpcmd");?></label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="amount_collect" id="amount_collect" placeholder="$100">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="edd" class="col-sm-2 col-form-label"><?php esc_html_e("Expected Delivery Date:","dwpcmd");?></label>
                        <div class="col-sm-2">
                            <input type="date" id="edd" name="edd">
                        </div>
                        <label for="edt" class="col-sm-2 col-form-label"><?php esc_html_e("Expected Delivery Time:","dwpcmd");?></label>
                        <div class="col-sm-2">
                            <input type="time" id="edt" name="edt">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <br>
                            <?php wp_nonce_field("submit_delivery_action_nonce","submit_delivery_name_nonce");?>
                            <button type="submit" class="btn btn-primary"><?php esc_html_e("Submit Delivery Request","dwp-courier-delivery-management") ?></button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>