<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Senarai Pengguna</h4>
                <div class="pull-right box-tools">
                    <a href="<?= base_url("users/add/"); ?>"
                       class="btn btn-primary btn-sm btn-flat btn-fill"><i class="fa fa-plus"></i>&nbsp;Daftar Tuntutan</a>
                </div>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Peranan</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($users->result_array() as $user): ?>
                        <tr>
                            <td><?= $role[$user['role']] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td class="col-md-1 text-center">
                                <?= '<i class="fa ' . ($user['is_active'] ? 'fa-check-circle' : 'fa-times-circle-o') . ' fa-lg text-success"></i>';?>
                            </td>
                            <td class="col-md-2">
                                <a href="<?= base_url("users/edit/" . $user['id']); ?>"
                                   class="btn btn-warning btn-sm btn-flat btn-fill"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url("users/reset/" . $user['id']); ?>"
                                   class="btn btn-primary btn-sm btn-flat btn-fill"><i class="fa fa-unlock"></i></a>
                                <a href="<?= base_url("users/delete/" . $user['id']); ?>"
                                   onclick="return confirm('Are you sure you want to delete this item? <?= $user['name'] ?>');"
                                   class="btn btn-danger btn-sm btn-flat btn-fill"><i class="fa fa-remove"></i></a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                    </tbody>
                </table>
                    <?php
                    if (strlen($pagination)) {
                        echo $pagination;
                    }
                    ?>
                <div class="clearfix"></div>
            </div>
        </div><!-- /.box -->
    </div>
</div>