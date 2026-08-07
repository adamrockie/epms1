$(document).ready(function () {
  // Multi-file type validation
  $("#update_documents").change(function () {
    var files = this.files;
    var allowed = ["image/jpeg", "image/png", "image/jpg", "application/pdf"];
    for (let i = 0; i < files.length; i++) {
      if (!allowed.includes(files[i].type)) {
        alert("Only JPG, JPEG, PNG, or PDF files are allowed.");
        $("#update_documents").val("");
        return false;
      }
    }
  });

  /** Open modal, load existing documents + current status */
  open_update_receivable = function (id) {
    $("#form_update_receivable")[0].reset();
    $("#existing_documents_list").html("");
    $("#update_receivable_id").val(id);

    $.ajax({
      url: "get_receivable_documents/" + id,
      type: "get",
      dataType: "json",
      success: function (data) {
        $("#update_receivable").modal("show");

        if (data.status) {
          $("#received_status").val(data.status).trigger("change");
        }

        if (data.documents && data.documents.length) {
          let html =
            '<label class="col-form-label">Existing Documents</label><ul class="list-unstyled">';
          data.documents.forEach(function (doc) {
            html += `<li><a href="uploads/receive/${doc.document}" target="_blank"><i class="fa fa-file m-r-5"></i>${doc.document}</a></li>`;
          });
          html += "</ul>";
          $("#existing_documents_list").html(html);
        }
      },
    });
  };

  /** Submit update */
  $("#form_update_receivable").submit(function (event) {
    event.preventDefault();
    let notif = (val, msg) => {
      if (val) {
        PNotify.success({ title: "Success!", text: msg });
      } else {
        PNotify.error({ title: "Error!", text: msg });
      }
    };

    $.ajax({
      type: "POST",
      url: "update_receivable_status",
      data: new FormData(this),
      dataType: "json",
      contentType: false,
      cache: false,
      processData: false,
      success: function (result) {
        if (result.status == "success") {
          notif(true, result.msg);
          $("#update_receivable").modal("hide");
          $("#form_update_receivable")[0].reset();
          setTimeout(function () {
            window.location.reload(1);
          }, 1500);
        } else {
          notif(false, result.msg);
        }
      },
    });
  });

  $(".select_update").select2({
    dropdownParent: $("#update_receivable"),
    allowClear: false,
    width: "100%",
    theme: "classic",
  });
});
