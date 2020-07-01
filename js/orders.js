var Orders = {
  get_orders : function(){
    RestClient.get("orders",  function(data){
      Utils.datatable("orders_table",
        [
        {'data':'id', 'title': 'ID'},
        {'data':'name','title': 'Name'},
        {'data':'amount', 'title': 'Amount'},
        {'data':'price', 'title': 'Price'},
        {'data':'status', 'title': 'Status'},
        {'data':'delete_order', 'title': 'Delete'}
      ], data);
    }, function(data){
      toastr.error(data.responseText);
    });
  },

   delete_order : function(id){
     RestClient.delete('orders/'+id, function(data){
       toastr.success(data);
       Orders.get_orders();
     }, function(data){console.log(data);
       toastr.error('Order was not deleted');
     })
   },

   finish_order : function(id){
     RestClient.PUT('orders/',{id:id} function(data){
       toastr.success(data);
       Orders.get_orders();
     }, function(data){console.log(data);
       toastr.error('Order was not updated');
     })
   }
}
