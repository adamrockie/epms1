function useItem(id) {
  let notif = (success, msg) => {
    if (success) {
      PNotify.success({ title: "Success", text: msg });
    } else {
      PNotify.error({ title: "Error", text: msg });
    }
  };

  $.ajax({
    type: "POST",
    url: "reduce_qty",
    data: JSON.stringify({ id: id }),
    contentType: "application/json",
    success: function (res) {
      if (res.status === "success") {
        notif(true, res.msg);

        setTimeout(() => {
          location.reload();
        }, 1500);
      } else {
        notif(false, res.msg);
      }
    },
  });
}
