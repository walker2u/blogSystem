<?php if ($action == 'add'): ?>
    <div class="col-md-6 mx-auto">
        <form method="post" enctype='multipart/form-data'>
            <h1 class="h3 mb-3 fw-normal">Create Post</h1>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">Please fix the Errors Below!</div>
            <?php endif; ?>
            <div class="my-2">
                <label>
                    Featured Image : <br>
                    <img class="mx-auto image-preview-add" src="<?= get_image(''); ?>"
                        style="cursor:pointer;width:150px; height:150px;object-fit:cover;">
                    <input onchange="display_image_edit(this.files[0])" class="d-none" type="file" name="image_add">
                </label>
            </div>
            <?php if (!empty($errors['image'])): ?>
                <div class="text-danger">
                    <?= $errors['image'] ?>
                </div>
            <?php endif; ?>
            <script>
                function display_image_edit(file) {
                    document.querySelector('.image-preview-add').src = URL.createObjectURL(file);
                }
            </script>
            <div class="form-floating">
                <input value="<?= old_value('title'); ?>" name="title" type="text" class="form-control" id="floatingInput"
                    placeholder="title">
                <label for="floatingInput">Title</label>
            </div>
            <?php if (!empty($errors['title'])): ?>
                <div class="text-danger">
                    <?= $errors['title'] ?>
                </div>
            <?php endif; ?>
            <div class="">
                <textarea rows="8" type="text" name="content" class="form-control" id="floatingInput"
                    placeholder="post content"><?= old_value('content'); ?></textarea>
            </div>
            <?php if (!empty($errors['content'])): ?>
                <div class="text-danger">
                    <?= $errors['content'] ?>
                </div>
            <?php endif; ?>

            <div class="form-floating my-3">
                <select name="category_id" class="form-select">
                    <option value="">--select--</option>
                    <?php
                    $query = "select * from categories order by id desc";
                    $categories = query($query);
                    ?>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= $cat['category'] ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <label for="category" class="floatingInput">Category</label>
            </div>
            <?php if (!empty($errors['category'])): ?>
                <div class="text-danger">
                    <?= $errors['category'] ?>
                </div>
            <?php endif; ?>
            <a href="<?= ROOT . '/admin/posts' ?>">
                <button name="back" class="btn btn-primary mt-5 mb-3 float-end" type="button">Back</button>
            </a>
            <button name="add" class="btn btn-primary mt-5 mb-3" type="submit">Post</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy;
                <?= date("Y"); ?>
            </p>
        </form>
    </div>
<?php elseif ($action == 'edit'): ?>
    <?php if ($row): ?>
        <div class="col-md-6 mx-auto">
            <form method="post" enctype='multipart/form-data'>
                <h1 class="h3 mb-3 fw-normal">Edit Post</h1>
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">Please fix the Errors Below!</div>
                <?php endif; ?>
                <div class="my-2">
                    <label>
                        <img class="mx-auto image-preview-edit" src="<?= get_image($row['image']); ?>"
                            style="cursor:pointer;width:150px; height:150px;object-fit:cover;">
                        <input onchange="display_image_edit(this.files[0])" class="d-none" type="file" name="image">
                    </label>
                </div>
                <script>
                    function display_image_edit(file) {
                        document.querySelector('.image-preview-edit').src = URL.createObjectURL(file);
                    }
                </script>
                <div class="form-floating">
                    <input value="<?= old_value('title', $row['title']); ?>" name="title" type="text" class="form-control"
                        id="floatingInput" placeholder="title">
                    <label for="floatingInput">Title</label>
                </div>
                <?php if (!empty($errors['title'])): ?>
                    <div class="text-danger">
                        <?= $errors['title'] ?>
                    </div>
                <?php endif; ?>
                <div class="">
                    <textarea rows="8" type="text" name="content" class="form-control" id="floatingInput"
                        placeholder="post content"><?= old_value('content', $row['content']); ?></textarea>
                </div>
                <div class="form-floating my-3">
                    <select name="category_id" class="form-select">
                        <option value="">--select--</option>
                        <?php
                        $query = "select * from categories order by id desc";
                        $categories = query($query);
                        ?>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                                <?php if ($cat['id'] == $row['category_id']): ?>
                                    <option selected value="<?= $cat['id'] ?>"><?= $cat['category'] ?></option>
                                <?php else: ?>
                                    <option value="<?= $cat['id'] ?>"><?= $cat['category'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <label for="category" class="floatingInput">Category</label>
                </div>
                <button class="btn btn-primary" type="submit">Save</button>
                <a href="<?= ROOT . '/admin/posts' ?>">
                    <button class="btn btn-primary float-end" type="button">Back</button>
                </a>
                <p class="mt-5 mb-3 text-body-secondary">&copy;
                    <?= date("Y"); ?>
                </p>
            </form>
        </div>
    <?php endif; ?>
<?php elseif ($action == 'delete'): ?>
    <?php if ($row): ?>
        <div class="col-md-6 mx-auto">
            <form method="post">
                <h1 class="h3 mb-3 fw-normal">Delete Post</h1>
                <div class="form-floating">
                    <div class="form-control">
                        <?= $row['title'] ?>
                    </div>
                    <label for="floatingInput">Title</label>
                </div>
                <div class="form-floating">
                    <div class="form-control">
                        <?= $row['slug'] ?>
                    </div>
                    <label for="floatingInput">Slug</label>
                </div>
                <button class="btn btn-primary my-2" type="submit">Delete</button>
                <a href="<?= ROOT . '/admin/posts' ?>">
                    <button class="btn btn-primary float-end my-2" type="button">Back</button>
                </a>
                <p class="mt-5 mb-3 text-body-secondary">&copy;
                    <?= date("Y"); ?>
                </p>
            </form>
        </div>
    <?php endif; ?>
<?php else: ?>
    <h1>posts<a href="<?= ROOT ?>/admin/posts/add"><button class="mx-2 btn btn-primary">Add posts</button></a></h1>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Date</th>
                <th>Action</th>
            </tr>

            <?php
            $limit = 10;
            $offset = ($PAGE['page_number'] - 1) * $limit;
            $query = 'select * from posts order by id limit ' . $limit . ' offset ' . $offset;
            $rows = query($query);
            ?>

            <?php if (!empty($rows)): ?>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td>
                            <?= $row['id']; ?>
                        </td>
                        <td>
                            <?= $row['title']; ?>
                        </td>
                        <td>
                            <?= $row['slug']; ?>
                        </td>
                        <td><img src="<?= get_image($row['image']); ?>" style="width:100px; height:100px;object-fit:cover;"></td>
                        <td>
                            <?= date("jS M,Y", strtotime($row['date'])); ?>
                        </td>
                        <td>
                            <a href="<?= ROOT ?>/admin/posts/edit/<?= $row['id'] ?>"><button
                                    class="btn btn-warning btn-sm text-white"><i class="textbi bi-pencil-fill"></i></button></a>
                            <a href="<?= ROOT ?>/admin/posts/delete/<?= $row['id'] ?>"><button
                                    class="btn btn-danger btn-sm text-white"><i class="bi bi-trash"></i></button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <div class="col-md-12 mb-4">
            <a href="<?= $PAGE['first_link'] ?>"><button class="btn btn-primary">First Page</button></a>
            <a href="<?= $PAGE['prev_link'] ?>"><button class="btn btn-primary">Previous Page</button></a>
            <a href="<?= $PAGE['next_link'] ?>"><button class="btn btn-primary float-end">Next Page</button></a>
        </div>
    </div>
<?php endif; ?>