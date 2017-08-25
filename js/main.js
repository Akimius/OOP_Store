function appendProduct(obj) {
    $('.product-list > .row').append("<div class='col-md-4' data-id='" + obj.id + "'><h2>" + obj.title + "</h2><p>" + obj.price + "</p><p>" + obj.description + "</p><button class='btn btn-success editProduct' data-toggle='modal' data-target='#myModal'>Edit</button>&nbsp; &nbsp;<button class='btn btn-danger removeProduct'>Delete</button></div></div>" );
}

function getProducts() {
    $('.product-list > .row > div').remove();
    $.get('/getproducts.php', function(res) {
        $.each(res, function (i,obj){
            appendProduct(obj);
        });
    });
}

$('.newproduct').click(function () {
    
    var product = {
        id: $('.productID').val(),
        title: $('#title').val(),
        price: $('#price').val(),
        description: $('#description').val()
    };
    
    $.post('/addnewproduct.php', product, function (res) {
        console.log(res);
        
        if(res.status == "ok" && product.id == "") {
            appendProduct(product);
        }
        getProducts();
    });
    
    $('#title').val('');
    $('#price').val('');
    $('#description').val('');
    
    $('#myModal').modal('hide');
});

$('.addProduct').click(function () {
    
    $('#title').val('');
    $('#price').val('');
    $('#description').val('');
    
    $('.newproduct').removeAttr('data-id');
});


$(document).on('click', '.removeProduct', function () {
    
    var itemId = $(this).parent().attr('data-id');
    $('.productID').val(itemId);
    
    if(confirm("Вы действительно хотите удалить?")) {
        
        $.post('/removeproducts.php', {id:itemId}, function(res) {
            
        });
        
        $(this).parent().remove();
    }
});

$(document).on('click', '.editProduct', function () {
    var itemId = $(this).parent().attr('data-id');
    $('.productID').val(itemId);
    
    $.get('/getproducts.php?id='+itemId, function (res) {
		var item = res[0];
		$('#title').val(item.title);
    	$('#price').val(item.price);
    	$('#description').val(item.description);
	});
    
    $('.newproduct').attr('data-id', itemId);
});

getProducts();