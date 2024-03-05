<?php 
    include '../app/pages/includes/header.php';
?>
    <main>
        <!-- start-slider -->
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/my-slider.css" />
        <script src="<?= ROOT ?>/assets/js/ism-2.2.min.js"></script>
        <div class="ism-slider" data-transition_type="fade" data-play_type="loop" data-buttons="false" id="my-slider">
            <ol>
                <li>
                    <img src="<?= ROOT ?>/assets/images/1.jpg">
                    <div class="ism-caption ism-caption-0">My slide caption text</div>
                </li>
                <li>
                    <img src="<?= ROOT ?>/assets/images/2.jpg">
                    <div class="ism-caption ism-caption-0">My slide caption text</div>
                </li>
                <li>
                    <img src="<?= ROOT ?>/assets/images/3.jpg">
                    <div class="ism-caption ism-caption-0">My slide caption text</div>
                </li>
                <li>
                    <img src="<?= ROOT ?>/assets/images/4.jpg">
                    <div class="ism-caption ism-caption-0">My slide caption text</div>
                </li>
            </ol>
        </div>
        <!-- end-slider -->
        <div class="row mb-2 p-4">
            
            <?php 
                $query = "select posts.*, categories.category from posts inner join categories on posts.category_id = categories.id order by id desc";
                $rows = query($query);
                if($rows){
                    foreach($rows as $row){
                        include '../app/pages/includes/post_card.php';
                    }
                }else{
                    echo "Nothing Here!";
                }
            ?>

        </div>
        <?php 
    include '../app/pages/includes/footer.php';
?>