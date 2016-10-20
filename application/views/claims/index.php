<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Parameter</h4>
                <p class="category">Senarai tuntutan</p>
                <div class="pull-right box-tools">
                    <a href="<?= base_url("claims/add/"); ?>"
                       class="btn btn-primary btn-sm btn-flat btn-fill"><i class="fa fa-plus"></i>&nbsp;Daftar Parameter</a>
                </div>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kod</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($claims->result_array() as $claim): ?>
                        <tr>
                            <td class="col-md-1"><?= $i ?></td>
                            <td class="col-md-1"><?= $claim['code'] ?></td>
                            <td><?= $claim['name'] ?></td>
                            <td class="col-md-1 text-center">
                                <?= '<i class="fa ' . ($claim['status'] ? 'fa-check-circle' : 'fa-times-circle-o') . ' fa-lg text-success"></i>';?>
                            </td>
                            <td class="col-md-2">
                                <a href="<?= base_url("claims/edit/" . $claim['id']); ?>"
                                   class="btn btn-warning btn-sm btn-flat btn-fill"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url("claims/delete/" . $claim['id']); ?>"
                                   onclick="return confirm('Are you sure you want to delete this item? <?= $claim['name'] ?>');"
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