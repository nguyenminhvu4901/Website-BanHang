<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    echo (!empty($msg)) ? $msg : false;
    ?>
    <form action="<?php echo _WEB_ROOT ?>/product/store" method="post">
        <div>
            Name<input type="text" name="name" value='<?php echo (!empty($old['name'])) ? $old['name'] : false  ?>'>
            <br>
            <?php
            echo (!empty($errors) && array_key_exists('name', $errors)) ? '<span style="color:red">' . $errors['name'] . '</span>' : false;
            ?>
        </div>
        <div>
            Email<input type="email" name="email" value='<?php echo (!empty($old['email'])) ? $old['email'] : false  ?>'>
            <br>
            <?php
            echo (!empty($errors) && array_key_exists('email', $errors)) ? '<span style="color:red">' . $errors['email'] . '</span>' : false;
            ?>
        </div>
        <div>
            Password <input type="password" name="password">
            <br>
            <?php
            echo (!empty($errors) && array_key_exists('password', $errors)) ? '<span style="color:red">' . $errors['password'] . '</span>' : false;
            ?>
        </div>
        <div>
            RePassword <input type="password" name="repassword">
            <br>
            <?php
            echo (!empty($errors) && array_key_exists('repassword', $errors)) ? '<span style="color:red">' . $errors['repassword'] . '</span>' : false;
            ?>
        </div>
        <div>
            Phone <input type="number" name='phone'>
            <br>
        </div>
        <div>
            Gender
            <br>
            Male<input type="radio" name="gender" value="male">
            Female<input type="radio" name="gender" value="female">
            Others<input type="radio" name="gender" value="others">
            <br>
        </div>
        <button type="submit">Thêm </button>
    </form>
</body>

</html>