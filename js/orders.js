var Orders = {
  get_orders: function () {
    RestClient.get(
      "orders",
      function (data) {
        Utils.datatable(
          "orders_table",
          [
            { data: "dish_name", title: "Name", defaultContent: "" },
            { data: "price", title: "Price", defaultContent: "" },
            { data: "amount", title: "Quantity", defaultContent: "" },
            { data: "status", title: "Status", defaultContent: "" },
            { data: "ready", title: "Ready", defaultContent: "" },
            { data: "finish", title: "Finish", defaultContent: "" },
            { data: "reject", title: "Reject", defaultContent: "" },
          ],
          data
        );
      },
      function (data) {
        toastr.error(data.responseText);
      }
    );
  },

  delete_orders: function (id) {
    RestClient.delete(
      "orders/" + id,
      function (data) {
        toastr.success(data);
        Orders.get_orders();
      },
      function (data) {
        console.log(data);
        toastr.error("Order was not deleted");
      }
    );
  },

  finish_orders: function (id) {
    RestClient.PUT(
      "orders/",
      { id: id },
      function (data) {
        toastr.success(data);
        Orders.get_orders();
      },
      function (data) {
        console.log(data);
        toastr.error("Order was not updated");
      }
    );
  },
};
