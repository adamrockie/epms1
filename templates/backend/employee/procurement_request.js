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

  function refresh_page() {
    $("#mcontents").load(document.URL + " #mcontents");
    setTimeout(function () {
      window.location.reload(1);
    }, 1500);
  }

  /** Submit a new procurement request */
  $("#form_add_request").on("submit", function (e) {
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
          $("#form_add_request")[0].reset();
          refresh_page();
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
  view_note = function (subject, status, note) {
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
  };

  /** Fetch a request's details and open the Edit modal - only reachable for pending requests */
  edit_item_request = function (id) {
    $.ajax({
      url: "get_item_request/" + id,
      type: "get",
      dataType: "json",
      success: function (data) {
        if (data.status !== "success") {
          notif(false, data.msg);
          return;
        }

        $("#eid").val(data.id);
        $("#esubject").val(data.subject);
        $("#edescription").val(data.description);

        $("#edit_request").modal("show");
      },
      error: function () {
        notif(false, "Could not load this request.");
      },
    });
  };

  /** Update a pending request */
  $("#form_edit_request").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      type: "POST",
      url: "update_request_item",
      data: new FormData(this),
      dataType: "json",
      contentType: false,
      cache: false,
      processData: false,
      success: function (result) {
        if (result.status == "success") {
          notif(true, result.msg);
          $("#edit_request").modal("hide");
          refresh_page();
        } else {
          notif(false, result.msg);
        }
      },
      error: function () {
        notif(false, "Something went wrong. Please try again.");
      },
    });
  });

  /** Delete confirmation - only reachable for pending requests */
  var pendingDeleteId = null;

  delete_warning = function (id) {
    pendingDeleteId = id;
    $("#delete_request").modal("show");
  };

  delete_request_confirm = function (confirmed) {
    if (confirmed === "true" && pendingDeleteId) {
      $.ajax({
        url: "delete_item_request",
        type: "POST",
        data: {
          id: pendingDeleteId,
          token: $('input[name="token"]').first().val(),
        },
        dataType: "json",
        success: function (result) {
          if (result.status == "success") {
            notif(true, result.msg);
            $("#delete_request").modal("hide");
            refresh_page();
          } else {
            notif(false, result.msg);
            $("#delete_request").modal("hide");
          }
        },
        error: function () {
          notif(false, "Something went wrong. Please try again.");
        },
      });
    } else {
      $("#delete_request").modal("hide");
    }
  };

  /** Fetch and show the remarks thread for a request, any status */
  view_remarks = function (id) {
    $.ajax({
      url: "get_item_request/" + id,
      type: "get",
      dataType: "json",
      success: function (data) {
        if (data.status !== "success") {
          notif(false, data.msg);
          return;
        }

        $("#remark_request_id").val(data.id);
        $("#remarks_history").text(
          data.remarks && data.remarks.length
            ? data.remarks
            : "No remarks yet.",
        );

        $("#remarks_modal").modal("show");
      },
      error: function () {
        notif(false, "Could not load remarks.");
      },
    });
  };

  /** Add a remark - allowed at any status */
  $("#form_add_remark").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      type: "POST",
      url: "add_item_remark",
      data: new FormData(this),
      dataType: "json",
      contentType: false,
      cache: false,
      processData: false,
      success: function (result) {
        if (result.status == "success") {
          notif(true, result.msg);
          $("#remarks_history").text(result.remarks);
          $("#remark_text").val("");
        } else {
          notif(false, result.msg);
        }
      },
      error: function () {
        notif(false, "Something went wrong. Please try again.");
      },
    });
  });
});
