<?php
include '../app/pages/includes/header.php';
?>
<main>
    <div class="rows mb-2 p-4">

        <?php
        $slug = $url[1] ?? null;
        if ($slug) {
            $query = "select posts.*, categories.category from posts inner join categories on posts.category_id = categories.id where posts.slug=:slug limit 1";
            $rows = query_row($query, ['slug' => $slug]);
        }
        if (!empty($rows)) { ?>
            <div class="col-md-12">
                <div class="rows g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
                    <div class="col-12 d-lg-block">
                            <img src="<?= get_image($rows['image']); ?>" class="bd-placeholder-img w-100" width="100%"
                                style="object-fit: cover;" alt="Something">
                    </div>
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">
                            <?= $rows['category'] ?? 'Unknown'; ?>
                        </strong>
                            <h3 class="mb-0">
                                <?= $rows['title']; ?>
                            </h3>
                        <div class="mb-1 text-muted">
                            <?= date("jS M,Y", strtotime($rows['date'])); ?>
                        </div>
                        <p class="card-text mb-auto">
                            <?= nl2br($rows['content']) ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php
        } else {
            echo "Nothing Here!";
        }
        ?>

    </div>
    <?php
    include '../app/pages/includes/footer.php';
    ?>