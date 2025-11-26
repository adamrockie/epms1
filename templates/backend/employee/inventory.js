$(document).ready(function () {
  /**Add Inventory */

  /**Ajax Upload */

  // Submit form data via Ajax
  $("#form_add_inventory").on("submit", function (e) {
    e.preventDefault();
    function notif(val, msg) {
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
    }

    $.ajax({
      type: "POST",
      url: "add_inventory",
      data: new FormData(this),
      dataType: "json",
      contentType: false,
      cache: false,
      processData: false,
      success: function (result) {
        if (result.status == "success") {
          notif(true, result.msg);
          $("#add_inventory").modal("hide");
          $("#form_add_inventory")[0].reset();
          $("#mcontents").load(document.URL + " #mcontents");
          setTimeout(function () {
            window.location.reload(1);
          }, 3000);
        } else {
          notif(false, result.msg);
        }
      },
    });
  });

  // File type validation
  $("#upload").change(function () {
    var file = this.files[0];
    var fileType = file.type;
    var match = ["image/jpeg", "image/png", "image/jpg"];
    if (
      !(fileType == match[0] || fileType == match[1] || fileType == match[2])
    ) {
      alert("Sorry, JPG, JPEG, & PNG files are allowed to upload.");
      $("#upload").val("");
      return false;
    }
  });

  /**Get Inventory details */
  edit_inventory = function (id) {
    $.ajax({
      url: "edit_inventory/" + id,
      type: "get",
      dataType: "json",
      data: { id: id },
      success: function (data) {
        $("#edit_inventory").modal("show");

        $("#img_preview").attr("src", "uploads/inventory/" + data.upload);
        $(".preview img").show();

        $("#einventory").val(data.inventory);
        $("#eid").val(data.id);
        $("#cstatus").val(data.status).attr("selected", "selected").change();

        $("#ewarranty")
          .val(data.warranty)
          .attr("selected", "selected")
          .change();
        $("#edate").val(data.date);
        $("#equantity").val(data.quantity).toString();
        $("#eupload").val(data.upload);
      },
    });
  };

  /**Update Inventory */
  $("#form_edit_inventory").submit(function (event) {
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
      url: "update_inventory",
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
          $("#form_edit_inventory")[0].reset();
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

  /**Delete Office */
  delete_warning = function (id) {
    $("#delete_inventory").modal("show");
    let ippis = id;
    delete_office = function (id) {
      if (id == "true") {
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
          url: "delete_inventory",
          type: "POST",
          data: { ippis: ippis },
          dataType: "json",
          success: function (result) {
            if (result.status == "success") {
              notif(true, result.msg);
              $("#delete_inventory").modal("hide");
              $("#mcontents").load(document.URL + " #mcontents");
            } else {
              notif(false, result.msg);
            }
          },
        });
      }
    };
  };

  $(".select").select2({
    dropdownParent: $("#add_inventory"),
    allowClear: false,
    width: "100%",
    theme: "classic",
  });

  $(".select").select2({
    dropdownParent: $("#gen_report_form"),
    allowClear: false,
    width: "100%",
    theme: "classic",
  });

  $(".select_edit").select2({
    dropdownParent: $("#edit_inventory"),
    allowClear: false,
    width: "100%",
    theme: "classic",
  });
});
