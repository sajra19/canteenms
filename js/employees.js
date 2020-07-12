var Employee = {
  get_employees : function(){
    RestClient.get("employees",  function(data){
      Utils.datatable("employee_table",
      [
        {'data':'id', 'title': 'ID',"defaultContent": ""},
        {'data':'name','title': 'Name', "defaultContent": ""},
        {'data':'surname', 'title': 'Surname', "defaultContent": ""},
        {'data':'email', 'title': 'Email', "defaultContent": ""},
        {'data':'phone_number', 'title': 'Phone', "defaultContent": ""},
        {'data':'delete_employee', 'title': 'Delete', "defaultContent": ""}
      ], data);
    }, function(data){
      toastr.error(data.responseText);
    });
  },

   delete_employee : function(id){
     RestClient.delete('employees/'+id, function(data){
       toastr.success(data);
       Employee.get_employees();
     }, function(data){console.log(data);
       toastr.error('Employee was not deleted');
     })
   }
}
