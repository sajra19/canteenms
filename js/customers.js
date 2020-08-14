var Customers = {
  get_customers: function (status) {
    RestClient.get(
      "customers?status=" + status,
      function (data) {
        Utils.datatable(
          "customers_table",
          [
            { data: "name", title: "Name", defaultContent: "" },
            { data: "surname", title: "Surname", defaultContent: "" },
            { data: "email", title: "Email", defaultContent: "" },
            { data: "phone", title: "Phone", defaultContent: "" },
            { data: "update_status", title: "Status", defaultContent: "" },
            {
              data: "reset_password",
              title: "Reset Password",
              defaultContent: "",
            },
          ],
          data
        );
      },
      function (data) {
        toastr.error(data.responseText);
      }
    );
  },

  update_status: function (user_id, status) {
    RestClient.patch(
      "customer/" + user_id + "/status?status=" + status,
      null,
      function (data) {
        toastr.success("Customer status updated successfully");
        Customers.get_customers("active");
      },
      function (data) {
        toastr.error("Customer status was not deleted");
      }
    );
  },

  reset_password: function (user_id) {},
};
