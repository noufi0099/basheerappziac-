<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        .product{
            border:1px solid #ddd;
            padding:10px;
            margin:10px;
            width:200px;
            text-align:center;
            cursor:pointer;
        }
        .product img{
            max-width:100%;
            height:auto;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<h1>Product List</h1>
<div id="productList">
</div>
<script>
$(document).ready(function(){
    function handleProductListing(token){
        $.ajax({
            url:'https://dummyjson.com/products',
            method:'GET',
            headers:{'Authorization':token,
            },
            success:function(data){
                console.log(data);
                const productListContainer=$('#productList');
                $.each(data.products,function(index, product){
                    const productContainer=$('<div>').addClass('product');
                    const thumbnailImg=$('<img>').attr('src', product.thumbnail);
                    const title=$('<h2>').text(product.title);
                    const description=$('<p>').text(product.description);
                    const price=$('<p>').text(`Price after discount: ${product.price}`);
                    productContainer.on('click',function(){
                        window.location.href=`product-details.php?productId=${product.id}&token=${token}`;
                    });
                    productContainer.append(thumbnailImg,title,description,price);
                    productListContainer.append(productContainer);
                });
            },
            error:function(error){
                console.error('Error:',error);
            }
        });
    }
    const urll=new URLSearchParams(window.location.search);
    const token=urll.get('token');
    if(token){
        handleProductListing(token);
    }else{
        console.error('Token not found');
        window.location.href='login.php';
    }
});
</script>
</body>
</html>
