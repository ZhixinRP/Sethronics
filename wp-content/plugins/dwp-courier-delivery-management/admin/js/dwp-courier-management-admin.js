jQuery(function () {
  var ajaxurl = dwp_delivery_ajax.ajax_admin_url;

  if (jQuery('#merchant-list-table').length > 0) {
    jQuery('#merchant-list-table').DataTable();
  }

  if (jQuery('#tbl-delivery-list').length > 0) {
    jQuery('#tbl-delivery-list').DataTable();
  }

  // Upload Image for Merchant Verification Document

  jQuery(document).on('click', '#verification_document', function () {
    var verifactionImage = wp
      .media({
        title: dwp_delivery_ajax.v_msg,
        multiple: false,
      })
      .open()
      .on('select', function (e) {
        var uploaded_verification_image = verifactionImage
          .state()
          .get('selection')
          .first();

        var verification_image_data = uploaded_verification_image.toJSON();

        jQuery('#merchant-verification-document').attr(
          'src',
          verification_image_data.url
        );
        jQuery('#merchant-verify-doc-hide').val(verification_image_data.url);
      });
  });

  // Upload Image for Merchant Shop Icon

  jQuery(document).on('click', '#merchant_shop_icon', function () {
    var shopicon = wp
      .media({
        title: dwp_delivery_ajax.u_s_image,
        multiple: false,
      })
      .open()
      .on('select', function (e) {
        var merchant_shop_image = shopicon.state().get('selection').first();

        var merchant_shop_image_data = merchant_shop_image.toJSON();

        jQuery('#merchant-shop-image').attr(
          'src',
          merchant_shop_image_data.url
        );

        jQuery('#merchant-shop-hidden-image').val(merchant_shop_image_data.url);
      });
  });

  // Create Delivery Request

  jQuery('#submit-delivery-form').validate({
    submitHandler: function () {
      var postdata = jQuery('#submit-delivery-form').serialize();

      postdata += '&action=dwp_form_action&param=submit_delivery_request';

      jQuery.post(ajaxurl, postdata, function (response) {
        var data = jQuery.parseJSON(response);

        if (data.status == 1) {
          alert(data.message);

          setTimeout(function () {
            location.reload();
          }, 1000);
        }
      });
    },
  });

  // Register Merchant Account Via Ajax

  jQuery('#merchant-registration-form').validate({
    submitHandler: function () {
      var postdata = jQuery('#merchant-registration-form').serialize();

      postdata += '&action=dwp_form_action&param=create_merchant_account';

      jQuery.post(ajaxurl, postdata, function (response) {
        //console.log(response);

        var data = jQuery.parseJSON(response);

        if (data.status == 1) {
          alert(data.message);

          setTimeout(function () {
            location.reload();
          }, 1000);
        }
      });
    },
  });

  // Delete Merchant Record

  jQuery(document).on('click', '#merchant-delete-btn', function () {
    var merchant_id = jQuery(this).attr('data-id');

    var conf = confirm(dwp_delivery_ajax.c_delete);

    if (conf) {
      var postdata =
        'action=dwp_form_action&param=delete_merchant_record&merchant_id=' +
        merchant_id;

      jQuery.post(ajaxurl, postdata, function (response) {
        var data = jQuery.parseJSON(response);

        if (data.status == 1) {
          alert(data.message);
          setTimeout(function () {
            location.reload();
          }, 1000);
        }
      });
    }
  });

  // Delete Delivery Request Record

  jQuery(document).on('click', '.btn-delete-delivery-request', function () {
    var delivery_request_id = jQuery(this).attr('data-id');

    var conf = confirm(dwp_delivery_ajax.c_delete);

    if (conf) {
      var postdata =
        'action=dwp_form_action&param=delete_delivery_record&delivery_request_id=' +
        delivery_request_id;

      jQuery.post(ajaxurl, postdata, function (response) {
        var data = jQuery.parseJSON(response);

        if (data.status == 1) {
          alert(data.message);
          setTimeout(function () {
            location.reload();
          }, 1000);
        }
      });
    }
  });
});
