var Menu = {
  get_menu : function(){
    RestClient.get("menu",  function(data){
      Utils.datatable("menu_table",
        [
        {'data':'id', 'title': 'ID'},
        {'data':'name','title': 'Name'},
        {'data':'description', 'title': 'Description'},
        {'data':'price', 'title': 'Price'},
        {'data':'status', 'title': 'Status'},
        {'data':'delete_order', 'title': 'Delete'}
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
       toastr.error('Menu item was not deleted');
     })
   },

   finish_order : function(id){
     RestClient.PUT('menu/',{id:id} function(data){
       toastr.success(data);
       Menu.get_menu();
     }, function(data){console.log(data);
       toastr.error('Menu was not updated');
     })
   }
}
