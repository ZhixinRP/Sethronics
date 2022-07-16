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
    var images = wp
      .media({
        title: 'Select an image to upload',
        button: {
          text: 'Use this Image',
        },
        multiple: false,
      })
      .open()
      .on('select', function (e) {
        var uploadedImages = images.state().get('selection').first();
        var image_data = uploadedImages.toJSON();
        $('#photo_evidence').attr('src', image_data.url);
      });
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
