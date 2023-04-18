<?php

class ProductModel extends Model
{
    private $_table = 'Product';
    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'Product';
    }

    function fieldFill()
    {
        return '*';
    }

    public function index()
    {
        $data = $this->db->query("SELECT * FROM Product")
            ->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function store($items = [])
    {
        $name = $items['name'];
        $email = $items['email'];
        $password = $items['password'];
        $age = $items['age'];
        $image = $items['image'];
        $imageName = trim($items['image']['name']);
        $extension = pathinfo($imageName, PATHINFO_EXTENSION);
        $imageName = time() . '.' . $extension;
        $imageSize = trim($items['image']['size']);
        $target_file_show = trim(_WEB_ROOT . '/public/images/products/' . $imageName);
        $target_file = trim(_DIR_ROOT . '/public/images/products/' . $imageName);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($imageName);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($items['image']['size'] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($items["image"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($imageName)) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        $data = $this->db->query("INSERT INTO Product (name, email, password, age, image) VALUES ('$name', '$email', '$password', '$age', '$target_file_show')")
            ->fetchAll(PDO::FETCH_ASSOC);
        try {
            SendMail($email, "Xin chào " . $name, "Mật khẩu của bạn là " . $password);
        } catch (Exception $e) {
            echo "Khong the gui mail";
        }
        return $data;
    }

    public function detail($id)
    {
        $data = $this->db->query("SELECT * FROM Product WHERE id = '$id'")
            ->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function edit($id)
    {
        $data = $this->db->query("SELECT * FROM Product WHERE id = '$id'")
            ->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function update($id, $items)
    {
        $name = $items['name'];
        $email = $items['email'];
        $age = $items['age'];
        $target_file_show = '';
        //Check neu co anh moi
        if (!empty($items['new_image']['name'])) {
            $imageName = trim($items['new_image']['name']);
            $extension = pathinfo($imageName, PATHINFO_EXTENSION);
            $imageName = time() . '.' . $extension;
            $imageSize = trim($items['new_image']['size']);
            $target_file_show = trim(_WEB_ROOT . '/public/images/products/' . $imageName);
            $target_file = trim(_DIR_ROOT . '/public/images/products/' . $imageName);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($imageName);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($items['new_image']['size'] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($items["new_image"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($imageName)) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            //Neu k truyen anh moi
        } else {
            $target_file_show = trim($items['old_image']);
        }
        $data = $this->db->query("UPDATE Product SET 
        name = '$name', 
        email = '$email',
        age = '$age', 
        image = '$target_file_show'
        WHERE id = '$id'")
            ->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function destroy($id)
    {
        $data = $this->db->query("DELETE FROM Product WHERE id=$id");
        return $data;
    }
}
