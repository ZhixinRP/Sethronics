(function ($) {
  'use strict';

  /**
   * All of the code for your admin-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */
})(jQuery);

jQuery(document).ready(function ($) {
  $('.delete').click(function (e) {
    if (!confirm('Are you sure you want to delete this user?')) {
      e.preventDefault();
      return false;
    }
    return true;
  });
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
  $('.updateBtn').on('click', function () {
    $('#updatemodal').modal('show');
  });

  // Upload Image for Merchant Verification Document
  $('#uploadBtn').click(function (e) {
    // var photoEvidence = wp
    //   .media({
    //     title: 'Choose Image',
    //     multiple: false,
    //   })
    //   .open()
    //   .on('select', function (e) {
    //     var uploaded_photo_evidence = photoEvidence
    //       .state()
    //       .get('selection')
    //       .first();
    //     var photo_evidence_data = uploaded_photo_evidence.toJSON();
    //   });
    wp.media({
      title: 'Choose Image',
      multiple: false,
    }).open();
  });
});

const tabs = document.querySelectorAll('.tab');
const contents = document.querySelectorAll('.tab-content');

tabs.forEach((tab, index) => {
  tab.addEventListener('click', () => {
    contents.forEach((content) => {
      content.classList.remove('active');
    });
    tabs.forEach((tab) => {
      tab.classList.remove('active');
    });
    contents[index].classList.add('active');
    tabs[index].classList.add('active');
  });
});

function hideAlert() {
  document.getElementById('alert').style.display = 'none';
}
setTimeout(hideAlert, 3000);
