var Employee = {
  get_employees : function(){
    RestClient.get("employees",  function(data){
      Utils.datatable("employee_table",
        [
        {'data':'id', 'title': 'ID'},
        {'data':'name','title': 'Name'},
        {'data':'surname', 'title': 'Surname'},
        {'data':'email', 'title': 'Email'},
        {'data':'phone_number', 'title': 'Phone'},
        {'data':'status', 'title': 'Status'},
        {'data':'delete_employee', 'title': 'Delete'}
      ], data);
    }, function(data){
      toastr.error(data.responseText);
    });
  },

   delete_employee : function(id){
     RestClient.delete('employee/'+id, function(data){
       toastr.success(data);
       Employee.get_students();
     }, function(data){console.log(data);
       toastr.error('Employee was not deleted');
     })
   }
}
