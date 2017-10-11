$(document).ready(function(){
 
    $(document).on('click', '.read-one-product-button', function(){
        // get product id
		var id = $(this).attr('data-id');
				
		// read sensor data
$.getJSON("http://fatihwebapp.azurewebsites.net/api/product/read_one.php?id=" + id, function(data){
    // start html
var read_one_product_html="";
 
// when clicked it will show the sensor list
read_one_product_html+="<div id='read-products' style='margin-bottom:10px' class='btn btn-primary pull-right read-products-button'>";
    read_one_product_html+="<span class='glyphicon glyphicon-list'></span> Tüm Sensörler";
read_one_product_html+="</div>";
read_one_product_html+="<table class='table table-bordered table-hover'>";
 
    read_one_product_html+="<tr>";
        read_one_product_html+="<td class='w-30-pct'>İsim</td>";
        read_one_product_html+="<td class='w-70-pct'>" + data.name + "</td>";
    read_one_product_html+="</tr>";
 
    // sensor_value
    read_one_product_html+="<tr>";
        read_one_product_html+="<td>Değer</td>";
        read_one_product_html+="<td>" + data.sensor_value + "</td>";
    read_one_product_html+="</tr>";
 
    //  description
    read_one_product_html+="<tr>";
        read_one_product_html+="<td>Açıklama</td>";
        read_one_product_html+="<td>" + data.description + "</td>";
    read_one_product_html+="</tr>";
 
    // category name
    read_one_product_html+="<tr>";
        read_one_product_html+="<td>Kategori</td>";
        read_one_product_html+="<td>" + data.category_name + "</td>";
    read_one_product_html+="</tr>";
 
read_one_product_html+="</table>";







// inject html
$("#page-content").html(read_one_product_html);
 
// chage page title
changePageTitle("Veri Detayları");
	
	
	
	});
		
		
		
		
		
		
    });
 
});