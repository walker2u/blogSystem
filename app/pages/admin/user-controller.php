<?php
$folder = '../public/uploads/';
$img_name = '';
if ($action == 'add') {
    if (!empty($_POST)) {

        $errors = [];

        if (empty($_POST['username'])) {
            $errors['username'] = "Please enter an Username!";
        } else if (!preg_match("/^[a-zA-Z]+$/", $_POST['username'])) {
            $errors['username'] = "Username can only have letters!";
        }

        if (empty($_POST['password'])) {
            $errors['password'] = "Please provide a valid Password!";
        } else if (strlen($_POST['password']) < 8) {
            $errors['password'] = "Password must be larger than 8 or more letters!";
        } else if ($_POST['password'] != $_POST['retype_password']) {
            $errors['password'] = "Confirm passworrd does not match!";
        }

        $query = "select id from users where email = :email limit 1";
        $email = query($query, ['email' => $_POST['email']]);
        if (empty($_POST['email'])) {
            $errors['email'] = "Please provide an Email!";
        } else if ($email) {
            $errors['email'] = "Email is already in use!";
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email is not Valid!";
        }

        $types = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
        if (!empty($_FILES['image_add']['name'])) {
            $destination = '';
            if (!in_array($_FILES['image_add']['type'], $types)) {
                $errors['image'] = "file format not supported!";
            } else {
                $img_name = time() . $_FILES['image_add']['name'];
                $destination = $folder . $img_name;
                move_uploaded_file($_FILES['image_add']['tmp_name'], $destination);
            }
        }

        if (empty($errors)) {

            $data = [];
            $data['username'] = $_POST['username'];
            $data['email'] = $_POST['email'];
            $data['role'] = "user";
            $data['image'] = empty($_FILES['image_add']['name']) ? '' : $img_name;
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $query = "insert into users(username,email,role,image,password) values(:username,:email,:role,:image,:password)";
            query($query, $data);

            redirect('admin/users');
        }
    }
} elseif ($action == 'edit') {

    $query = 'select * from users where id = :id';
    $row = query_row($query, ['id' => $id]);
    if (!empty($_POST)) {

        if ($row) {

            $errors = [];

            if (empty($_POST['username'])) {
                $errors['username'] = "Please enter an Username!";
            } else if (!preg_match("/^[a-zA-Z]+$/", $_POST['username'])) {
                $errors['username'] = "Username can only have letters!";
            }

            if (empty($_POST['password'])) {

            } else if (strlen($_POST['password']) < 8) {
                $errors['password'] = "Password must be larger than 8 or more letters!";
            } else if ($_POST['password'] != $_POST['retype_password']) {
                $errors['password'] = "Confirm passworrd does not match!";
            }

            $query = "select id from users where email = :email && id != :id limit 1";
            $email = query($query, ['email' => $_POST['email'], 'id' => $id]);
            if (empty($_POST['email'])) {
                $errors['email'] = "Please provide an Email!";
            } else if ($email) {
                $errors['email'] = "Email is already in use!";
            } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email is not Valid!";
            }

            $types = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
            if (!empty($_FILES['image']['name'])) {
                $destination = '';
                if (!in_array($_FILES['image']['type'], $types)) {
                    $errors['image'] = "file format not supported!";
                } else {
                    $img_name = time() . $_FILES['image']['name'];
                    $destination = $folder . $img_name;
                    move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                }
            }

            if (empty($errors)) {
                $data = [];
                $data['username'] = $_POST['username'];
                $data['email'] = $_POST['email'];
                $data['image'] = empty($_FILES['image']['name']) ? $row['image'] : $img_name;
                $data['role'] = $_POST['role'];
                $data['id'] = $id;

                if (empty($_POST['password'])) {
                    $query = "update users set username=:username,email=:email,role=:role,image = :image where id = :id limit 1";
                } else {
                    $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $query = "update users set username=:username,email=:email,role=:role,image = :image ,password=:password where id = :id limit 1";
                }
                query($query, $data);

                redirect('admin/users');
            }
        }
    }
} else if ($action == 'delete') {
    $query = 'select * from users where id = :id';
    $row = query_row($query, ['id' => $id]);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if ($row) {
            $data = [];
            $data['id'] = $id;

            $query = "delete from users where id = :id limit 1";
            query($query, $data);
            if(file_exists($folder.'/'.$row['image'])){
                unlink($folder.'/'.$row['image']);
            }
            redirect('admin/users');
        }
    }
} ?>