<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helo</title>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Fname</th>
                <th scope="col">LastName</th>
                <th scope="col">Email</th>
                <th scope="col">Chi tiet</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) { ?>
                <tr>
                    <th scope="row"><?php echo $row["id"] ?></th>
                    <td><?php echo  $row["firstname"] ?></td>
                    <td><?php echo $row['lastname'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td>
                        <form method='GET' action="home/show/<?php echo $row["id"] ?>">
                            <input type="submit">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>