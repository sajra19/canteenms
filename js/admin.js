var Admin = {
  get_admin : function(){
    RestClient.get("admin",  function(data){
      Utils.datatable("admin_table",
        [
        {'data':'id', 'title': 'ID'},
        {'data':'name','title': 'Name'},
        {'data':'surname', 'title': 'Surname'},
        {'data':'email', 'title': 'Email'},
        {'data':'phone_number', 'title': 'Phone'},
        {'data':'status', 'title': 'Status'},
        {'data':'delete_admin', 'title': 'Delete'}
      ], data);
    }, function(data){
      toastr.error(data.responseText);
    });
  },

   delete_admin : function(id){
     RestClient.delete('admin/'+id, function(data){
       toastr.success(data);
       Admin.get_students();
     }, function(data){console.log(data);
       toastr.error('Admin was not deleted');
     })
   }
}
