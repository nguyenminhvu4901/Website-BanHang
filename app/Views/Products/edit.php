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
    echo (!empty($msg1)) ? $msg1 : false;
    foreach ($result as $item) : ?>
        <form action="<?php echo _WEB_ROOT ?>/product/update/<?php echo $item['id'] ?>" method="post" enctype="multipart/form-data">
            <div>
                Name<input type="text" name="name" value='<?php echo $item['name'] //echo (!empty($old['name'])) ? $old['name'] : false  
                                                            ?>'>
                <br>
                <?php
                echo form_error('name', '<span style="color:red">', '</span>')
                //echo (!empty($errors) && array_key_exists('name', $errors)) ? '<span style="color:red">' . $errors['name'] . '</span>' : false;
                ?>
            </div>
            <div>
                Email<input type="email" name="email" value='<?php echo $item['email'] //echo (!empty($old['email'])) ? $old['email'] : false  
                                                                ?>'>
                <br>
                <?php
                echo form_error('email', '<span style="color:red">', '</span>')
                //echo (!empty($errors) && array_key_exists('email', $errors)) ? '<span style="color:red">' . $errors['email'] . '</span>' : false;
                ?>
            </div>
            <div>
                Age <input type="number" name="age" value='<?php echo $item['age'] ?>'>
                <br>
                <?php
                echo form_error('age', '<span style="color:red">', '</span>')
                // echo (!empty($errors) && array_key_exists('age', $errors)) ? '<span style="color:red">' . $errors['age'] . '</span>' : false;
                ?>
            </div>
            <div>
                Phone <input type="number" name='phone'>
                <br>
            </div>
            <div>
                Old Image<input type="hidden" name="old_image" value='<?php echo $item['image'] ?>'>
                <img src="<?php echo $item['image'] ?>" onerror="this.onerror=null;this.src='<?php echo _WEB_ROOT . '/public/images/errors/error.jpg' ?>';" width="100">
                <br>
                New Image <input type="file" name="new_image">
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
    <?php endforeach; ?>
</body>

</html>