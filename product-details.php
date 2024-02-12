<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<h1>Product Details</h1>
<div id="productDetails">
</div>
<script>
$(document).ready(function(){
    function handleProductDetails(token,productId) {
        $.ajax({
            url:`https://dummyjson.com/products/${productId}`,
            method:'GET',
            headers:{'Authorization': token,
            },
            success:function(product){
                console.log(product);
                const productDetailsContainer=$('#productDetails');
                const thumbnailImg=$('<img>').attr('src',product.thumbnail);
                const title=$('<h2>').text(product.title);
                const description=$('<p>').text(product.description);
                const price=$('<p>').text(`Price after discount:${product.price}`);
                productDetailsContainer.append(thumbnailImg,title,description,price);
            },
            error:function(error) {
                console.error('Error:',error);
            }
        });
    }
    const urll= new URLSearchParams(window.location.search);
    const token=urll.get('token');
    const productId=urll.get('productId');
    if(token && productId){
        handleProductDetails(token,productId);
    }else{
       console.error('error');
       window.location.href='login.php';
    }
});
</script>
</body>
</html>
