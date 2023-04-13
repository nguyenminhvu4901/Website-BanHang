<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php echo _WEB_ROOT ?>/product/store" method="post">
        Name<input type="text" name="name">
        <br>
        Email<input type="email" name="email">
        <br>
        Password <input type="password" name="password">
        <br>
        RePassword <input type="password" name="repassword">
        <br>
        Phone <input type="number" name='phone'>
        <br>
        Gender 
        <br>
        Male<input type="radio" name="gender" value="male">
        Female<input type="radio" name="gender" value="female">
        Others<input type="radio" name="gender" value="others">
        <br>
        <input type="submit">
    </form>
</body>

</html>