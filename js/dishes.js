var Dishes = {
  get_dishes : function(){
    RestClient.get("dishes",  function(data){
      Utils.datatable("dishes_table",
        [
        {'data':'id', 'title': 'ID'},
        {'data':'name','title': 'Name'},
        {'data':'description', 'title': 'Description'},
        {'data':'price', 'title': 'Price'},
        {'data':'status', 'title': 'Status'},
        {'data':'delete_dishes', 'title': 'Delete'}
      ], data);
    }, function(data){
      toastr.error(data.responseText);
    });
  },

   delete_dishes : function(id){
     RestClient.delete('dishes/'+id, function(data){
       toastr.success(data);
       Dishes.get_dishes();
     }, function(data){console.log(data);
       toastr.error('Item was not deleted');
     })
   },

   finish_order : function(id){
     RestClient.PUT('dishes/',{id:id} function(data){
       toastr.success(data);
       Dishes.get_dishes();
     }, function(data){console.log(data);
       toastr.error('Dish was not updated');
     })
   }
}
