var Dishes = {
  get_dishes : function(){
    RestClient.get("dishes",  function(data){
      Utils.datatable("dishes_table",
        [
        {'data':'id', 'title': 'ID', "defaultContent": ""},
        {'data':'name','title': 'Name', "defaultContent": ""},
        {'data':'description', 'title': 'Description', "defaultContent": ""},
        {'data':'price', 'title': 'Price', "defaultContent": ""},
        {'data':'add', 'title': 'Add', "defaultContent": ""}
      ], data);
    }, function(data){
      toastr.error(data.responseText);
    });
  },

   delete_dish : function(id){
     RestClient.delete('dishes/'+id, function(data){
       toastr.success(data);
       Dishes.get_dishes();
     }, function(data){console.log(data);
       toastr.error('Item was not deleted');
     })
   },


   post_dish : function(id){
     RestClient.post('dishes/'+id, function(data){
       toastr.success(data);
       Dishes.get_dishes();
     }, function(data){console.log(data);
       toastr.error('Item was not added');
     })
   },


   finish_dish : function(id){
     RestClient.put('dishes/',{id:id}, function(data){
       toastr.success(data);
       Dishes.get_dishes();
     }, function(data){console.log(data);
       toastr.error('Dish was not updated');
     })
   }
}
