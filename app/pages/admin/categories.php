<?php if ($action == 'add'): ?>
    <div class="col-md-6 mx-auto">
        <form method="post">
            <h1 class="h3 mb-3 fw-normal">Create Category</h1>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">Please fix the Errors Below!</div>
            <?php endif; ?>
            <div class="form-floating">
                <input value="<?= old_value('category'); ?>" name="category" type="text" class="form-control"
                    id="floatingInput" placeholder="category">
                <label for="floatingInput">Category</label>
            </div>
            <?php if (!empty($errors['category'])): ?>
                <div class="text-danger">
                    <?= $errors['category'] ?>
                </div>
            <?php endif; ?>
            <div class="form-floating my-3">
                <select name="disabled" class="form-select">
                    <option value="0">Yes</option>
                    <option value="1">No</option>
                </select>
                <label for="floatingInput">Active</label>
            </div>
            <a href="<?= ROOT . '/admin/categories' ?>">
                <button name="back" class="btn btn-primary mb-3 float-end" type="button">Back</button>
            </a>
            <button name="add" class="btn btn-primary mb-3" type="submit">Add</button>
            <p class="mb-3 text-body-secondary">&copy;
                <?= date("Y"); ?>
            </p>
        </form>
    </div>
<?php elseif ($action == 'edit'): ?>
    <?php if ($row): ?>
        <div class="col-md-6 mx-auto">
            <form method="post">
                <h1 class="h3 mb-3 fw-normal">Edit Category</h1>
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">Please fix the Errors Below!</div>
                <?php endif; ?>
                <div class="form-floating">
                    <input value="<?= old_value('category', $row['category']); ?>" name="category" type="text"
                        class="form-control" id="floatingInput" placeholder="category">
                    <label for="floatingInput">Category</label>
                </div>
                <?php if (!empty($errors['category'])): ?>
                    <div class="text-danger">
                        <?= $errors['category'] ?>
                    </div>
                <?php endif; ?>
                <div class="form-floating my-3">
                    <select name="disabled" class="form-select">
                        <option selected value="0">Yes</option>
                        <option value="1">No</option>
                    </select>
                    <label for="floatingInput">Active</label>
                </div>
                <button class="btn btn-primary" type="submit">Save</button>
                <a href="<?= ROOT . '/admin/categories' ?>">
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
                <h1 class="h3 mb-3 fw-normal">Delete Category</h1>
                <div class="form-floating">
                    <div class="form-control">
                        <?= $row['category'] ?>
                    </div>
                    <label for="floatingInput">Category</label>
                </div>
                <div class="form-floating">
                    <div class="form-control">
                        <?= $row['slug'] ?>
                    </div>
                    <label for="floatingInput">Slug</label>
                </div>
                <button class="btn btn-primary my-2" type="submit">Delete</button>
                <a href="<?= ROOT . '/admin/categories' ?>">
                    <button class="btn btn-primary float-end my-2" type="button">Back</button>
                </a>
                <p class="mt-5 mb-3 text-body-secondary">&copy;
                    <?= date("Y"); ?>
                </p>
            </form>
        </div>
    <?php endif; ?>
<?php else: ?>
    <h1>Category<a href="<?= ROOT ?>/admin/categories/add"><button class="mx-2 btn btn-primary">Add Category</button></a>
    </h1>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Categoryy</th>
                <th>Slug</th>
                <th>Disabled</th>
                <th>Action</th>
            </tr>

            <?php
            $limit = 10;
            $offset = ($PAGE['page_number'] - 1) * $limit;
            $query = 'select * from categories order by id limit ' . $limit . ' offset ' . $offset;
            $rows = query($query);
            ?>

            <?php if (!empty($rows)): ?>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td>
                            <?= $row['id']; ?>
                        </td>
                        <td>
                            <?= $row['category']; ?>
                        </td>
                        <td>
                            <?= $row['slug']; ?>
                        </td>
                        <td>
                            <?= $row['disabled']; ?>
                        </td>
                        <td>
                            <a href="<?= ROOT ?>/admin/categories/edit/<?= $row['id'] ?>"><button
                                    class="btn btn-warning btn-sm text-white"><i class="textbi bi-pencil-fill"></i></button></a>
                            <a href="<?= ROOT ?>/admin/categories/delete/<?= $row['id'] ?>"><button
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