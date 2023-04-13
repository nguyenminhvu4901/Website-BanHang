<h1>Trang show</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Fname</th>
            <th scope="col">LastName</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
                <th scope="row"><?php echo $row["id"] ?></th>
                <td><?php echo  $row["firstname"] ?></td>
                <td><?php echo $row['lastname'] ?></td>
                <td><?php echo $row['email'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="<?php echo _WEB_ROOT?>/home/index">Thoat</a>