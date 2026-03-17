$(document).ready(function () {
  /**Update Request */
  $("#form_edit_request").submit(function (event) {
    let notif = (val, msg) => {
      if (val) {
        PNotify.success({
          title: "Success!",
          text: msg,
        });
      } else {
        PNotify.error({
          title: "Error!",
          text: msg,
        });
      }
    };

    $.ajax({
      type: "POST",
      url: "update_item_request",
      data: new FormData(this),
      dataType: "json",
      contentType: false,
      cache: false,
      processData: false,
      //beforeSend: function(){
      //$('.submitBtn').attr("disabled","disabled");
      // $('#form_add_employee').css("opacity",".5");
      //},
      success: function (result) {
        if (result.status == "success") {
          notif(true, result.msg);
          $("#edit_inventory").modal("hide");
          $("#form_edit_request")[0].reset();
          $("#mcontents").load(document.URL + " #mcontents");
          setTimeout(function () {
            window.location.reload(1);
          }, 3000);
        } else {
          notif(false, result.msg);
        }
      },
    });

    event.preventDefault();
  });
});
