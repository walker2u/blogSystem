<?php
include '../app/pages/includes/header.php';
?>
<main>
    <div class="row mb-2 p-4">

        <?php
        $find = $_GET['find'] ?? null;
        if ($find) {
            $find = "%$find%";
            $query = "select posts.*, categories.category from posts inner join categories on posts.category_id = categories.id where title like :find order by id desc";
            $rows = query($query, ['find' => $find]);
        }
        if (!empty($rows)) {
            foreach ($rows as $row) {
                include '../app/pages/includes/post_card.php';
            }
        } else {
            echo "Nothing Here!";
        }
        ?>

    </div>
    <?php
    include '../app/pages/includes/footer.php';
    ?>