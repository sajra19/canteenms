var Customers = {
  get_customers: function () {
    RestClient.get(
      "customers",
      function (data) {
        Utils.datatable(
          "customers_table",
          [
            { data :'name',title: 'Name', defaultContent: ""},
            { data :'surname', title: 'Surname', defaultContent: ""},
            { data :'email', title: 'Email', defaultContent: ""},
            { data :'phone_number', title: 'Phone', defaultContent: ""},
          ],
          data
        );
      },
      function (data) {
        toastr.error(data.responseText);
      }
    );
  }
};
