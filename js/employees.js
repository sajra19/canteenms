var Employee = {
  get_employees : function(){
    RestClient.get("employees",  function(data){
      Utils.datatable("employee_table",
      [
        { data :'name',title: 'Name', defaultContent: ""},
        { data :'surname', title: 'Surname', defaultContent: ""},
        { data :'email', title: 'Email', defaultContent: ""},
        { data :'phone_number', title: 'Phone', defaultContent: ""},
        { data :'delete_employee', title: 'Delete', defaultContent: ""},
        { data :"edit_employee", title: "Edit", defaultContent: "" },
      ], data);
    }, function(data){
      toastr.error(data.responseText);
    });
  },

  delete_employee: function (id) {
    RestClient.patch(
      "employees/" + id + "/status",
      null,
      function (data) {
        toastr.success("Employee was deleted successfully");
        Employee.get_employees();
      },
      function (data) {
        toastr.error("Employee was not deleted");
      }
    );
  },

  open_edit_modal: function (id) {
    //  $("#editModal").modal("show");
    $.get("rest/employees/id?id=" + id, function (data) {
      $("#edit_form input[name=id]").val(data.id);
      $("#edit_form input[name=fname]").val(data.name);
      $("#edit_form input[name=lname]").val(data.name);
      $("#edit_form input[name=user_email]").val(data.price);
      $("#edit_form input[name=psword]").val(data.description);
      $("#edit_form input[name=phone]").val(data.description);
    });
  },
};
