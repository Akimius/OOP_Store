
function appendProduct (obj) {
    $('.product-list > .row').append("<div class='col-md-4' data-id='" +
        obj.id + "'><h2>" + obj.title + "</h2><p>" + obj.price + "</p><p>" +
        obj.description + "</p><button class='btn btn-success editProduct' " +
        "data-toggle='modal' data-target='#myModal'>Edit</button>&nbsp; &nbsp;<button class='btn btn-danger removeProduct'>Delete</button></div></div>" );
}

    $.get('/getproducts.php', function(res){
        console.log(res);
        $.each(res, function(i, obj){
            appendProduct(obj);
        });
    });


//function getProducts (){
//
//    $.get('/getproducts.php', function(res){
//        console.log(res);
//        $.each(res, function(i, obj){
//            appendProduct(obj);
//        });
//
//        // $('.product-list > .row > div').remove();
//
//    });
//
//}

$('.newproduct').click(function () {


    $.get('/addnewproduct.php?', function(res){
        var item = res[0];
        $('#title').val(item.title);
        $('#price').val(item.price);
        $('#description').val(item.description);
    });

    
    var product = {
        id: $('.product-id').val(),
        title: $('#title').val(),
        price: $('#price').val(),
        description: $('#description').val()
    };
    // console.log(product.id, typeof product.id);

    $.post('/addnewproduct.php', product, function (res) {
        console.log(res);
        if(res.status == "ok" && product.id == ""){
            appendProduct(product);
        }
        // getProducts();
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

    if(confirm("Вы действительно хотите удалить?")){
        // sessionStorage.removeItem(itemId);
        $.post('/removeproducts.php', {id:itemId}, function (result) {
            // console.log(itemId);
        });
        $(this).parent().remove();
    }
});

$(document).on('click', '.editProduct', function () {
    var itemId = $(this).parent().attr('data-id');
    $(".product-id").val(itemId);

    $.get('/getproducts.php?id='+itemId, function(res){
       var item = res[0];
        $('#title').val(item.title);
        $('#price').val(item.price);
        $('#description').val(item.description);
    });

    $('.newproduct').attr('data-id', itemId);
});