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
            <tr>
                <th scope="row"><?php echo $rows["id"] ?></th>
                <td><?php echo  $rows["firstname"] ?></td>
                <td><?php echo $rows['lastname'] ?></td>
                <td><?php echo $rows['email'] ?></td>
            </tr>
    </tbody>
</table>
<form action="home/index" method="get">
Thoat<input type="submit">
</form>