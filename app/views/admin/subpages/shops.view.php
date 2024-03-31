<main role="main" class="col-9 ml-sm-auto col-lg-10 px-md-5">
    <div class="dashboard-header">
        <h1 class="h2">Registerd shops</h1>
        <p>Manage the Registered shops</p>
    </div>

    <?php

    include_once "app/models/Shop.model.php";

    $shops = Shop::get_all();

    ?>



    <div class="table-responsive">
        <table id="dataTable" class="table table-striped table-bordered">
            <thead>
            <tr>
            <th>ID</th>
            <th>Shop Name</th>
            <th>Tel</th>
            <th>Email</th>
            <th>Register No</th>
            <th>Approved</th>
            <th>Suspended</th>
            <th>Actions</th>
        </tr>
            </thead>


            <tbody>

                
            <?php foreach ($shops as $shop) : ?>
            <tr>
                <td><?= $shop['id'] ?></td>
                <td><?= $shop['name'] ?></td>
                <td><?= $shop['tel'] ?></td>
                <td><?= $shop['address'] ?></td>
                <td><?= $shop['registration_no'] ?></td>
                <td style="background-color: <?= $shop['approved'] == 0 ? 'yellow' : 'transparent' ?>">
                    <?= $shop['approved'] == 0 ? 'No' : 'Yes' ?>
                </td>
                <td style="background-color: <?= $shop['suspended'] == 1 ? 'red' : 'transparent' ?>">
                    <?= $shop['suspended'] == 1 ? 'Yes' : 'No' ?>
                </td>
                <td>
                    <a class="btn btn-primary" href="<?= BASE_URL ?>/admin-dashboard?page=view_shop&id=<?= $shop['id'] ?>">View</a> |
                    <!-- <a class="btn btn-warning" href="edit_shop.php?id=<?= $shop['id'] ?>">Edit</a> | -->
                    <?php if ($shop['suspended'] == 1) : ?>
                        <a class="btn btn-success" href="<?= BASE_URL ?>/admin-dashboard?page=unsuspend_shop&id=<?= $shop['id'] ?>">Unsuspend</a>
                    <?php else : ?>
                        <a class="btn btn-danger" href="<?= BASE_URL ?>/admin-dashboard?page=suspend_shop&id=<?= $shop['id'] ?>">Suspend</a>
                    <?php endif; ?>
                    <?php if ($shop['approved'] == 0) : ?>
                        | <a class="btn btn-success" href="<?= BASE_URL ?>/admin-dashboard?page=approve_shop&id=<?= $shop['id'] ?>">Approve</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
                
            </tbody>
        </table>
    </div>









</main>