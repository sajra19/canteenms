var Employee = {
  get_employees: function (status) {
    RestClient.get(
      "employees?status=" + status,
      function (data) {
        Utils.datatable(
          "employee_table",
          [
            { data: "name", title: "Name", defaultContent: "" },
            { data: "surname", title: "Surname", defaultContent: "" },
            { data: "email", title: "Email", defaultContent: "" },
            { data: "phone", title: "Phone", defaultContent: "" },
            { data: "update_status", title: "Status", defaultContent: "" },
            { data: "edit_employee", title: "Edit", defaultContent: "" },
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
      "employee/" + user_id + "/status?status=" + status,
      null,
      function (data) {
        toastr.success("Employee status updated successfully");
        Employee.get_employees("active");
      },
      function (data) {
        toastr.error("Employee status was not updated");
      }
    );
  },

  open_edit_modal: function (id) {
    //  $("#editModal").modal("show");
    $.get("rest/employees/id?id=" + id, function (data) {
      $("#edit_form input[name=id]").val(data.id);
      $("#edit_form input[name=fname]").val(data.name);
      $("#edit_form input[name=lname]").val(data.name);
      $("#edit_form input[name=user_email]").val(data.email);
      $("#edit_form input[name=phone]").val(data.phone);
    });
  },
};
