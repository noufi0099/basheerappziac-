<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<h1>Login</h1>
<form id="loginForm">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Login</button>
</form>
<script>
$(document).ready(function(){
    function handleLogin(){
        const username=$('#username').val();
        const password=$('#password').val();
        $.ajax({
            url:'https://dummyjson.com/auth/login',
            method:'POST',
            contentType:'application/json',
            data:JSON.stringify({
                username:username,
                password:password,
            }),
            success:function(data){
                console.log(data);
                window.location.href='products.php?token='+data.token;
            },
            error:function(error){
                console.error('Error:',error);
            }
        });
    }
    $('#loginForm').submit(function(event) {
        event.preventDefault();
        handleLogin();
    });
});
</script>
</body>
</html>
