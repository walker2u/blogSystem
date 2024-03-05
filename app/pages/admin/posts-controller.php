<?php
$folder = '../public/uploads/';
$img_name = '';
if ($action == 'add') {
    if (!empty($_POST)) {

        $errors = [];

        if (empty($_POST['title'])) {
            $errors['title'] = "Please enter a title!";
        }
        if (empty($_POST['content'])) {
            $errors['content'] = "Please enter your content!";
        }
        if (empty($_POST['category_id'])) {
            $errors['category'] = "Please provide a category!";
        }
        $slug = str_to_url($_POST['title']);

        $query = "select id from posts where slug = :slug limit 1";
        $result = query($query, ['slug' => $slug]);
        if ($result) {
            $slug .= rand(1000, 9999);
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
        } else {
            $errors['image'] = "A featured image is reuired!";
        }

        if (empty($errors)) {

            $data = [];
            $data['title'] = $_POST['title'];
            $data['category_id'] = $_POST['category_id'];
            $data['user_id'] = user('id');
            $data['content'] = $_POST['content'];
            $data['slug'] = $slug;
            $data['image'] = empty($_FILES['image_add']['name']) ? '' : $img_name;

            $query = "insert into posts(title,category_id,content,image,slug,user_id) values(:title,:category_id,:content,:image,:slug,:user_id)";
            query($query, $data);
            redirect('admin/posts');
        }
    }
} elseif ($action == 'edit') {

    $query = 'select * from posts where id = :id';
    $row = query_row($query, ['id' => $id]);
    if (!empty($_POST)) {

        if ($row) {

            $errors = [];

            if (empty($_POST['title'])) {
                $errors['title'] = "Please enter a title!";
            }
            if (empty($_POST['content'])) {
                $errors['content'] = "Please enter your content!";
            }
            if (empty($_POST['category_id'])) {
                $errors['category'] = "Please provide a category!";
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
                $data['id'] = $id;
                $data['title'] = $_POST['title'];
                $data['category_id'] = $_POST['category_id'];
                $data['image'] = empty($_FILES['image']['name']) ? $row['image'] : $img_name;
                $data['content'] = $_POST['content'];

                $query = "update posts set title=:title,category_id=:category_id,content=:content,image = :image where id = :id limit 1";
                query($query, $data);
                redirect('admin/posts');
            }
        }
    }
} else if ($action == 'delete') {
    $query = 'select * from posts where id = :id limit 1';
    $row = query_row($query, ['id' => $id]);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if ($row) {
            $data = [];
            $data['id'] = $id;

            $query = "delete from posts where id = :id limit 1";
            query($query, $data);
            if (file_exists($folder . '/' . $row['image'])) {
                unlink($folder . '/' . $row['image']);
            }
            redirect('admin/posts');
        }
    }
} ?>