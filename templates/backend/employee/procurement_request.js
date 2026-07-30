$(document).ready(function () {
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

  /** Submit a new procurement request */
  $("#form_request_item").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      type: "POST",
      url: "add_request_item",
      data: new FormData(this),
      dataType: "json",
      contentType: false,
      cache: false,
      processData: false,
      success: function (result) {
        if (result.status == "success") {
          notif(true, result.msg);
          $("#add_request").modal("hide");
          $("#form_request_item")[0].reset();
          $("#mcontents").load(document.URL + " #mcontents");
          setTimeout(function () {
            window.location.reload(1);
          }, 3000);
        } else {
          notif(false, result.msg);
        }
      },
      error: function () {
        notif(false, "Something went wrong. Please try again.");
      },
    });
  });

  /** View the reviewer's note for an approved/rejected request */
  $(document).on("click", ".view-note-btn", function () {
    var subject = $(this).data("subject");
    var status = $(this).data("status");
    var note = $(this).data("note");

    var statusLabel = "Pending";
    if (status === "approve") statusLabel = "Approved";
    if (status === "reject") statusLabel = "Rejected";
    if (status === "disbursed") statusLabel = "Disbursed";

    $("#note_subject").text(subject);
    $("#note_status").text(statusLabel);
    $("#note_text").text(
      note && note.length ? note : "No note was left for this request.",
    );

    $("#view_note").modal("show");
  });
});
