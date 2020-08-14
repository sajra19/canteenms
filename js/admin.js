var Admin = {
  get_admins: function (status) {
    RestClient.get(
      "admin?status=" + status,
      function (data) {
        Utils.datatable(
          "admin_table",
          [
            { data: "name", title: "Name", defaultContent: "" },
            { data: "surname", title: "Surname", defaultContent: "" },
            { data: "email", title: "Email", defaultContent: "" },
            { data: "phone", title: "Phone", defaultContent: "" },
            { data: "update_status", title: "Status", defaultContent: "" },
          ],
          data
        );
      },
      function (data) {
        toastr.error(data.responseText);
      }
    );
  },

  update_status: function (id, status) {
    RestClient.patch(
      "admin/" + id + "/status?status=" + status,
      null,
      function (data) {
        toastr.success("Admin status updated successfully");
        Admin.get_admins("active");
      },
      function (data) {
        toastr.error("Admin status was not updated");
      }
    );
  },
};
