<div>
    <div class="col-md-12">
        <br>
        <?php
            $date_time = date(get_option('date_format'));
        ?>
        <span class="d-flex flex-row-reverse"><?php esc_html_e("Today is ","dwp-courier-delivery-management").esc_html_e($date_time); ?></span>           
    </div>
    <br>
    <div class="container-fluid py-5 bg-light text-center">
    <h1><?php esc_html_e("DELIVERY LIST","dwp-courier-delivery-management")?></h1>
    </div> 
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <table id="tbl-delivery-list" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th><?php esc_html_e("ID","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Merchant Name","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Merchant Phone","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Merchant Address","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Customer Name","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Customer Phone","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Customer Address","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Payment Status","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Amount To Collect","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Expected Delivery Time","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Action","dwp-courier-delivery-management");?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        if($delivery_list > 0){
                            foreach($delivery_list as $index => $data){

                                $m_id = isset($data->id) ? $data->id : '';
                                $m_name1 = isset($data->mrchnt_name) ? $data->mrchnt_name : '';
                                $m_name2 = isset($data->mrcnt_name) ? $data->mrcnt_name : '';
                                $m_ph1 = isset($data->mrcnt_phn) ? $data->mrcnt_phn : '';
                                $m_ph2 = isset($data->mrcnt_phone) ? $data->mrcnt_phone : '';
                                $m_addr1 = isset($data->mrcnt_addr) ? $data->mrcnt_addr : '';
                                $m_addr2 = isset($data->business_address) ? $data->business_address : '';
                                $c_name = isset($data->cstmr_name) ? $data->cstmr_name : '';
                                $c_phn = isset($data->cstmr_phone) ? $data->cstmr_phone : '';
                                $c_addr = isset($data->cstmr_addr) ? $data->cstmr_addr : '';
                                $amount_clt = isset($data->amnt_collect) ? $data->amnt_collect : '';
                                $pay_sts = isset($data->pmnt_stus) ? $data->pmnt_stus : '';
                            ?>

                            <!-- Display Delivery List -->

                                <tr>
                                        <td><?php esc_html_e($m_id); ?></td>
                                        <td> 
                                            <?php esc_html_e(!empty($m_name1) ? $m_name1 : $m_name2); ?>
                                        </td> 
                                        <td><?php esc_html_e(!empty($m_ph1) ? $m_ph1 : $m_ph2); ?></td>
                                        <td><?php esc_html_e(!empty($m_addr1) ? $m_addr1 : $m_addr2); ?></td>
                                        <td><?php esc_html_e($c_name); ?></td>
                                        <td><?php esc_html_e($c_phn); ?></td>
                                        <td><?php esc_html_e($c_addr); ?></td>
                                        <td>
                                            <?php
                                                if($pay_sts == 1){
                                                    ?>
                                                    <button class="btn btn-info"><?php esc_html_e("&nbsp; Paid &nbsp;","dwp-courier-delivery-management");?></button>
                                                <?php
                                                }else{
                                                    ?>
                                                    <button class="btn btn-secondary"><?php esc_html_e("Unpaid","dwp-courier-delivery-management");?></button>
                                                <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?php esc_html_e( $amount_clt );?></td>
                                        <td><?php

                                        $originalDate = isset($data->edd) ? $data->edd : '';
                                        $newDate = date("d-m-Y", strtotime($originalDate));
                                        
                                        $expectedtime = date("g:i A", strtotime($data->edt));
                                        esc_html_e($newDate); 
                                        echo "<br>";
                                        esc_html_e($expectedtime); ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-delete-delivery-request" data-id="<?php esc_html_e($m_id);?>"><?php esc_html_e("Delete","dwp-courier-delivery-management"); ?></button>    
                                        </td>
                                </tr>
                            <?php 
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><?php esc_html_e("ID","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Merchant Name","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Merchant Phone","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Merchant Address","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Customer Name","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Customer Phone","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Customer Address","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Payment Status","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Amount To Collect","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Expected Delivery Time","dwp-courier-delivery-management");?></th>
                        <th><?php esc_html_e("Action","dwp-courier-delivery-management");?></th> 
                    </tr>
                </tfoot>
            </table>        
            </div>
        </div>
    </div>
</div>