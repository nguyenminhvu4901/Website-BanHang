<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo _WEB_ROOT ?>/product/create" method="get">
        <button type="submit">Thêm sản phẩm</button>
    </form>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Age</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($result as $value): ?>
    <tr>
      <td><?php echo $value['id']?></td>
      <td><?php echo $value['name']?></td>
      <td><?php echo $value['email']?></td>
      <td><?php echo $value['password']?></td>
      <td><?php echo $value['age']?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</body>
</html>