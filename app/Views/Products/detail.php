<h1>Trang detail</h1>

<table class="table">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
            <th scope="col">Age</th>
            <th scope="col">Image</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
                <th scope="row"><?php echo $row["id"] ?></th>
                <td><?php echo  $row["name"] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['password'] ?></td>
                <td><?php echo $row['age'] ?></td>
                <td><img src="<?php echo $value['image']  ?>" onerror="this.onerror=null;this.src='<?php echo _WEB_ROOT . '/public/images/errors/error.jpg' ?>';" width="100"></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="<?php echo _WEB_ROOT ?>/product/index">Thoat</a>