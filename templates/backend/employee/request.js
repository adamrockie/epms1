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

let serialCount = 0;
let maxQty = 0;
let currentItemName = "";

// OPEN MODAL + SET VALUES
function edit_request(id, qty, item_name, item_id, ippis) {
  document.getElementById("eid").value = id;
  document.getElementById("request_display").value = qty + " " + item_name;
  document.getElementById("eeippis").value = ippis;
  document.getElementById("eitem_id").value = item_id;
  // SET LIMIT
  maxQty = parseInt(qty);
  serialCount = 0;
  currentItemName = item_name;

  // CLEAR OLD INPUTS
  $("#serial_container").html("");

  // RESET COMMENT ONLY (avoid errors)
  document.getElementById("comment").value = "";
}

// ADD SERIAL INPUT (WITH LIMIT)
$("#add_serial").click(function () {
  if (serialCount >= maxQty) {
    PNotify.error({
      title: "Error!",
      text: "You can only add " + maxQty + " serial numbers",
    });
    return;
  }

  serialCount++;

  $("#serial_container").append(`
        <div class="input-group mb-2 serial-item">
            <input type="text" name="serial_numbers[]" class="form-control" placeholder="Enter ${currentItemName} ${serialCount} Serial Number ">
            <button type="button" class="btn btn-danger remove-serial">X</button>
        </div>
    `);
});

// REMOVE SERIAL INPUT
$(document).on("click", ".remove-serial", function () {
  $(this).closest(".serial-item").remove();
  serialCount--;
});

// OPTIONAL: AUTO GENERATE BASED ON QTY (ONLY USE IF NEEDED)
function generateSerialInputs(qty) {
  $("#serial_container").html("");
  serialCount = qty;

  for (let i = 1; i <= qty; i++) {
    $("#serial_container").append(`
            <div class="input-group mb-2 serial-item">
                <input type="text" name="serial_numbers[]" class="form-control" placeholder="Serial Number ${i}">
            </div>
        `);
  }
}
