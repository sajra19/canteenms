var Cart = {
  get_customer_cart: function () {
    user_id = Utils.parseJwt(localStorage.getItem("user_token")).data.id;
    RestClient.get(
      "cart?id=" + user_id,
      function (data) {
        Utils.datatable(
          "cart_table",
          [
            { data: "dish_name", title: "Name", defaultContent: "" },
            { data: "price", title: "Price", defaultContent: "" },
            { data: "amount", title: "Quantity", defaultContent: "" },
            { data: "plus", title: "Add", defaultContent: "" },
            { data: "minus", title: "Remove", defaultContent: "" },
            { data: "status", title: "Status", defaultContent: "" },
          ],
          data.cart
        );
        $("#total_amount").html(data.total);
      },
      function (data) {
        toastr.error(data.responseText);
      }
    );
  },

  update_amount: function (id, type) {
    RestClient.patch(
      "cart/" + id + "/amount?type=" + type,
      null,
      function (data) {
        toastr.success("Cart was updated successfully");
        Cart.get_customer_cart();
      },
      function (data) {
        toastr.error("Cart was not updated");
      }
    );
  },

  //Customer - buttons outside table onclick="Cart.update_cart_status('CONFIRMED') or onclick="Cart.update_cart_status('CANCELED')"
  update_cart_status: function (status) {
    user_id = Utils.parseJwt(localStorage.getItem("user_token")).data.id;
    RestClient.patch(
      "cart/" + user_id + "/status?status=" + status,
      null,
      function (data) {
        toastr.success(data);
        Cart.get_customer_cart();
      },
      function (data) {
        console.log(data);
        toastr.error("Cart was not updated");
      }
    );
  },

  //Admin, employee - buttons inside table onclick="Cart.update_cart_dish_status('REJECT') or onclick="Cart.update_cart_status('READY')"
  update_cart_dish_status: function (id, status) {
    RestClient.patch(
      "cart/admin/" + id + "/status?status=" + status,
      null,
      function (data) {
        toastr.success(data);
        Orders.get_orders();
      },
      function (data) {
        console.log(data);
        toastr.error("Cart was not updated");
      }
    );
  },
};
