var Menu = {
  get_menu : function(){
    RestClient.get("menu",  function(data){
      Utils.datatable("menu_table",
        [
        {'data':'id', 'title': 'ID', "defaultContent": ""},
        {'data':'name','title': 'Name', "defaultContent": ""},
        {'data':'price', 'title': 'Price', "defaultContent": ""},
        {'data':'description', 'title': 'Description', "defaultContent": ""},
        {'data':'status', 'title': 'Status', "defaultContent": ""},
        {'data':'delete_menu', 'title': 'Delete', "defaultContent": ""}
      ], data);
    }, function(data){
      toastr.error(data.responseText);
    });
  },

   delete_menu : function(id){
     RestClient.delete('menu/'+id, function(data){
       toastr.success(data);
       Menu.get_menu();
     }, function(data){console.log(data);
       toastr.error('Mwnu was not deleted');
     })
   }
}
