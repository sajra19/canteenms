var Menu = {
  get_menu: function () {
    RestClient.get(
      "menu",
      function (data) {
        Utils.datatable(
          "menu_table",
          [
            { data: "name", title: "Name", defaultContent: "" },
            { data: "price", title: "Price", defaultContent: "" },
            { data: "description", title: "Description", defaultContent: "" },
            { data: "delete_menu", title: "Delete", defaultContent: "" },
            { data: "edit_menu", title: "Edit", defaultContent: "" },
          ],
          data
        );
      },
      function (data) {
        toastr.error(data.responseText);
      }
    );
  },

  delete_menu: function (id) {
    RestClient.patch(
      "menu/" + id + "/status",
      null,
      function (data) {
        toastr.success("Menu item was deleted successfully");
        Menu.get_menu();
      },
      function (data) {
        toastr.error("Menu item was not deleted");
      }
    );
  },

  open_edit_modal: function (id) {
    //  $("#editModal").modal("show");
    $.get("rest/menu/id?id=" + id, function (data) {
      $("#edit_form input[name=id]").val(data.id);
      $("#edit_form input[name=name]").val(data.name);
      $("#edit_form input[name=price]").val(data.price);
      $("#edit_form input[name=description]").val(data.description);
    });
  },
};
