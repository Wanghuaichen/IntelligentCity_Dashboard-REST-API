$(document).ready(function(){
 
    $(document).on('click', '.delete-product-button', function(){
        // get the product id
		var product_id = $(this).attr('data-id');
		
		// bootbox
bootbox.confirm({
 
    message: "<h4>Are you sure?</h4>",
    buttons: {
        confirm: {
            label: '<span class="glyphicon glyphicon-ok"></span> Yes',
            className: 'btn-danger'
        },
        cancel: {
            label: '<span class="glyphicon glyphicon-remove"></span> No',
            className: 'btn-primary'
        }
    },
    callback: function (result) {
        
		if(result==true){
 
    // send delete request to api
    $.ajax({
        url: "http://fatihwebapp.azurewebsites.net/api/product/delete.php",
        type : "POST",
        dataType : 'json',
        data : JSON.stringify({ id: product_id }),
        success : function(result) {
 
            // reload list of products
            showProducts();
        },
        error: function(xhr, resp, text) {
            console.log(xhr, resp, text);
        }
    });
 
}
		
    }
});
		
		
    });
});