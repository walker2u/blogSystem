<div class="col-md-6">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary-emphasis">
                <?= $row['category'] ?? 'Unknown'; ?>
            </strong>
            <a href="<?= ROOT ?>/post/<?= $row['slug']; ?>">
                <h3 class="mb-0">
                    <?= $row['title']; ?>
                </h3>
            </a>
            <div class="mb-1 text-body-secondary">
                <?= date("jS M,Y", strtotime($row['date'])); ?>
            </div>
            <p class="card-text mb-auto">
                <?= substr($row['content'], 0, 200) ?>...
            </p>
            <a href="<?=ROOT?>/post/<?=$row['slug'];?>" class="icon-link gap-1 icon-link-hover stretched-link">
                Continue reading
                <svg class="bi">
                    <use xlink:href="#chevron-right" />
                </svg>
            </a>
        </div>
        <div class="col-lg-auto col-12 d-lg-block">
            <a href="<?= ROOT ?>/post/<?= $row['slug']; ?>">
                <img src="<?= get_image($row['image']); ?>" class="bd-placeholder-img w-100" width="200" height="262"
                    aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"
                    alt="Something">
            </a>
        </div>
    </div>
</div>