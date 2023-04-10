<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chu</title>
</head>

<body>
    <!-- <pre><?php print_r($data) ?></pre>
    <br>
    <pre><?php print_r($data1) ?></pre> -->
    <?php
        foreach($data as $key){
            echo $key.'<br>';
        }
    ?>
</body>

</html>