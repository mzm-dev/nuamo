<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Jenis Tuntutan</h4>
                <p class="category">Senarai tuntutan yang disediakan untuk Tabung Kebajikan</p>
                <div class="pull-right box-tools">
                    <a href="<?= base_url("funds/add/"); ?>"
                       class="btn btn-primary btn-sm btn-flat btn-fill"><i class="fa fa-plus"></i>&nbsp;Daftar Tuntutan</a>
                </div>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jenis</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($funds->result_array() as $fund): ?>
                        <tr>
                            <td class="col-md-1"><?= $fund['rank'] ?></td>
                            <td><?= $fund['name'] ?></td>
                            <td class="col-md-1"><?= $fund['amount'] ?></td>
                            <td class="col-md-1 text-center">
                                <?= '<i class="fa ' . ($fund['is_active'] ? 'fa-check-circle' : 'fa-times-circle-o') . ' fa-lg text-success"></i>';?>
                            </td>
                            <td class="col-md-2">
                                <a href="<?= base_url("funds/edit/" . $fund['id']); ?>"
                                   class="btn btn-warning btn-sm btn-flat btn-fill"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url("funds/delete/" . $fund['id']); ?>"
                                   onclick="return confirm('Are you sure you want to delete this item? <?= $fund['name'] ?>');"
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