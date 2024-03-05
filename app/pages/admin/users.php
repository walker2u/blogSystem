<?php if ($action == 'add'): ?>
    <div class="col-md-6 mx-auto">
        <form method="post" enctype='multipart/form-data'>
            <h1 class="h3 mb-3 fw-normal">Create User</h1>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">Please fix the Errors Below!</div>
            <?php endif; ?>
            <div class="my-2">
                <label>
                    <img class="mx-auto image-preview-add" src="<?= get_image(''); ?>"
                        style="cursor:pointer;width:150px; height:150px;object-fit:cover;">
                    <input onchange="display_image_edit(this.files[0])" class="d-none" type="file" name="image_add">
                </label>
            </div>
            <script>
                function display_image_edit(file) {
                    document.querySelector('.image-preview-add').src = URL.createObjectURL(file);
                }
            </script>
            <div class="form-floating">
                <input value="<?= old_value('username'); ?>" name="username" type="text" class="form-control"
                    id="floatingInput" placeholder="username">
                <label for="floatingInput">Username</label>
            </div>
            <?php if (!empty($errors['username'])): ?>
                <div class="text-danger">
                    <?= $errors['username'] ?>
                </div>
            <?php endif; ?>
            <div class="form-floating">
                <input value="<?= old_value('email'); ?>" type="email" name="email" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <?php if (!empty($errors['email'])): ?>
                <div class="text-danger">
                    <?= $errors['email'] ?>
                </div>
            <?php endif; ?>
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <?php if (!empty($errors['password'])): ?>
                <div class="text-danger">
                    <?= $errors['password'] ?>
                </div>
            <?php endif; ?>

            <div class="form-floating">
                <input name="retype_password" type="password" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <?php if (!empty($errors['terms'])): ?>
                <div class="text-danger">
                    <?= $errors['terms'] ?>
                </div>
            <?php endif; ?>
            <a href="<?= ROOT . '/admin/users' ?>">
                <button name="back" class="btn btn-primary mt-5 mb-3 float-end" type="button">Back</button>
            </a>
            <button name="add" class="btn btn-primary mt-5 mb-3" type="submit">Add</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy;
                <?= date("Y"); ?>
            </p>
        </form>
    </div>
<?php elseif ($action == 'edit'): ?>
    <?php if ($row): ?>
        <div class="col-md-6 mx-auto">
            <form method="post" enctype='multipart/form-data'>
                <h1 class="h3 mb-3 fw-normal">Edit Account</h1>
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
                    <input value="<?= old_value('username', $row['username']); ?>" name="username" type="text"
                        class="form-control" id="floatingInput" placeholder="username">
                    <label for="floatingInput">Username</label>
                </div>
                <?php if (!empty($errors['username'])): ?>
                    <div class="text-danger">
                        <?= $errors['username'] ?>
                    </div>
                <?php endif; ?>
                <div class="form-floating">
                    <input value="<?= old_value('email', $row['email']); ?>" type="email" name="email" class="form-control"
                        id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <select name="role" class="form-select py-0">
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <?php if (!empty($errors['email'])): ?>
                    <div class="text-danger">
                        <?= $errors['email'] ?>
                    </div>
                <?php endif; ?>
                <div class="form-floating">
                    <input name="password" type="password" class="form-control" id="floatingPassword"
                        placeholder="Password(leave it empty for old one)">
                    <label for="floatingPassword">Password(leave it for old password)</label>
                </div>
                <?php if (!empty($errors['password'])): ?>
                    <div class="text-danger">
                        <?= $errors['password'] ?>
                    </div>
                <?php endif; ?>

                <div class="form-floating">
                    <input placeholder="Password(leave it empty for old one)" name="retype_password" type="password"
                        class="form-control" id="floatingPassword">
                    <label for="floatingPassword">Password(leave it for old password)</label>
                </div>
                <?php if (!empty($errors['terms'])): ?>
                    <div class="text-danger">
                        <?= $errors['terms'] ?>
                    </div>
                <?php endif; ?>
                <button class="btn btn-primary" type="submit">Save</button>
                <a href="<?= ROOT . '/admin/users' ?>">
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
                <h1 class="h3 mb-3 fw-normal">Delete Account</h1>
                <div class="form-floating">
                    <div class="form-control">
                        <?= $row['username'] ?>
                    </div>
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating">
                    <div class="form-control">
                        <?= $row['email'] ?>
                    </div>
                    <label for="floatingInput">Email address</label>
                </div>
                <button class="btn btn-primary my-2" type="submit">Delete</button>
                <a href="<?= ROOT . '/admin/users' ?>">
                    <button class="btn btn-primary float-end my-2" type="submit">Back</button>
                </a>
                <p class="mt-5 mb-3 text-body-secondary">&copy;
                    <?= date("Y"); ?>
                </p>
            </form>
        </div>
    <?php endif; ?>
<?php else: ?>
    <h1>Users<a href="<?= ROOT ?>/admin/users/add"><button class="mx-2 btn btn-primary">Add Users</button></a></h1>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Image</th>
                <th>Date</th>
                <th>Action</th>
            </tr>

            <?php
            $limit = 10;
            $offset = ($PAGE['page_number'] - 1) * $limit;
            $query = 'select * from users order by id limit ' . $limit . ' offset ' . $offset;
            $rows = query($query);
            ?>

            <?php if (!empty($rows)): ?>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td>
                            <?= $row['id']; ?>
                        </td>
                        <td>
                            <?= $row['username']; ?>
                        </td>
                        <td>
                            <?= $row['email']; ?>
                        </td>
                        <td>
                            <?= $row['role']; ?>
                        </td>
                        <td><img src="<?= get_image($row['image']); ?>" style="width:100px; height:100px;object-fit:cover;"></td>
                        <td>
                            <?= date("jS M,Y", strtotime($row['date'])); ?>
                        </td>
                        <td>
                            <a href="<?= ROOT ?>/admin/users/edit/<?= $row['id'] ?>"><button
                                    class="btn btn-warning btn-sm text-white"><i class="textbi bi-pencil-fill"></i></button></a>
                            <a href="<?= ROOT ?>/admin/users/delete/<?= $row['id'] ?>"><button
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