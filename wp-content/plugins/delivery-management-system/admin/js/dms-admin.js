jQuery(document).ready(function ($) {
  //Delete User button
  $(".delete").click(function (e) {
    if (!confirm("Are you sure you want to delete this user?")) {
      e.preventDefault();
      return false;
    }
    return true;
  });
  //Intisialise tooltip
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });

  $("#updatemodal")
    .on("show", function () {
      $("body").addClass("modal-open");
    })
    .on("hidden", function () {
      $("body").removeClass("modal-open");
    });

  //Update Details Button
  $(".updateBtn").on("click", function () {
    $("#updatemodal").prependTo("body");
    $("#updatemodal").modal("show");
    //Get closest row
    var tr = $(this).closest("tr");
    //Store closest row into data array
    var data = tr
      .children("td")
      .map(function () {
        return $(this).text();
      })
      .get();
    //Store the ID of the selected update details row
    $("#update-id").val(data[0]);
    $("#update-id-text").text(data[0]);
  });

  // Upload Image Button
  $("#uploadBtn").click(function (e) {
    var images = wp
      .media({
        title: "Select an image to upload",
        button: {
          text: "Use this Image",
        },
        multiple: false,
      })
      .open()
      .on("select", function (e) {
        var uploadedImages = images.state().get("selection").first();
        var image_data = uploadedImages.toJSON();
        $("#photo-evidence").attr("src", image_data.url);
        $("#photo-evidence-hidden").val(image_data.url);
      });
  });
});

const tabs = document.querySelectorAll(".tab");
const contents = document.querySelectorAll(".tab-content");

tabs.forEach((tab, index) => {
  tab.addEventListener("click", () => {
    contents.forEach((content) => {
      content.classList.remove("active");
    });
    tabs.forEach((tab) => {
      tab.classList.remove("active");
    });
    contents[index].classList.add("active");
    tabs[index].classList.add("active");
  });
});

function hideAlert() {
  document.getElementById("alert").style.display = "none";
}
setTimeout(hideAlert, 3000);

// Assign DP Get order ID from table row
// $(".assignBtn").on("click", function () {
//   var tr = $(this).closest("tr");
//   var data = tr
//     .children("td")
//     .map(function () {
//       return $(this).text();
//     })
//     .get();

//   $("#assign-id").val(data[0]);
//   $("#assign-id-text").text(data[0]);
//   $('#burger') = 'burger';
// });
