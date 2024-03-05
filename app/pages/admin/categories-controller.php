<?php
$folder = '../public/uploads/';
$img_name = '';
if ($action == 'add') {
    if (!empty($_POST)) {

        $errors = [];

        if (empty($_POST['category'])) {
            $errors['category'] = "Please enter a Category!";
        } else if (!preg_match("/^[a-zA-Z0-9 \-\_\&]+$/", $_POST['category'])) {
            $errors['category'] = "Category can only have letters!";
        }

        $slug = str_to_url($_POST['category']);

        $query = "select id from categories where slug = :slug limit 1";
        $result = query($query, ['slug' => $slug]);
        if ($result) {
            $slug .= rand(1000, 9999);
        }
        if (empty($errors)) {

            $data = [];
            $data['category'] = $_POST['category'];
            $data['slug'] = $slug;
            $data['disabled'] = $_POST['disabled'];
            ;

            $query = "insert into categories(category,slug,disabled) values(:category,:slug,:disabled)";
            query($query, $data);

            redirect('admin/categories');
        }
    }
} elseif ($action == 'edit') {

    $query = 'select * from categories where id = :id';
    $row = query_row($query, ['id' => $id]);
    if (!empty($_POST)) {

        if ($row) {

            $errors = [];

            if (empty($_POST['category'])) {
                $errors['category'] = "Please enter a Category!";
            } else if (!preg_match("/^[a-zA-Z0-9 \-\_\&]+$/", $_POST['category'])) {
                $errors['category'] = "Category can only have letters!";
            }

            if (empty($errors)) {
                $data = [];
                $data['id'] = $id;
                $data['category'] = $_POST['category'];
                $data['disabled'] = $_POST['disabled'];

                $query = "update categories set category=:category,disabled=:disabled where id = :id limit 1";

                query($query, $data);

                redirect('admin/categories');
            }
        }
    }
} else if ($action == 'delete') {
    $query = 'select * from categories where id = :id';
    $row = query_row($query, ['id' => $id]);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if ($row) {
            $data = [];
            $data['id'] = $id;

            $query = "delete from categories where id = :id limit 1";
            query($query, $data);
            redirect('admin/categories');
        }
    }
} ?>