<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Parameter</h4>
                <div class="pull-right box-tools">
                    <a href="<?= base_url("params/add/"); ?>"
                       class="btn btn-primary btn-sm btn-flat btn-fill"><i class="fa fa-plus"></i>&nbsp;Daftar Parameter</a>
                </div>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover">
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
                    $i = ($this->pagination->cur_page - 1) * $this->pagination->per_page;
                    foreach ($params->result_array() as $param): ?>
                        <tr>
                            <td class="col-md-1"><?= $i + 1 ?></td>
                            <td class="col-md-1"><?= $param['code'] ?></td>
                            <td><?= $param['name'] ?></td>
                            <td class="col-md-1 text-center">
                                <?= '<i class="fa ' . ($param['status'] ? 'fa-check-circle' : 'fa-times-circle-o') . ' fa-lg text-success"></i>'; ?>
                            </td>
                            <td class="col-md-2">
                                <a href="<?= base_url("params/edit/" . $param['id']); ?>"
                                   class="btn btn-warning btn-sm btn-flat btn-fill"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url("params/delete/" . $param['id']); ?>"
                                   onclick="return confirm('Are you sure you want to delete this item? <?= $param['name'] ?>');"
                                   class="btn btn-danger btn-sm btn-flat btn-fill"><i class="fa fa-remove"></i></a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <hr>
                <?php
                if (strlen($pagination)) {
                    echo '<div class="text-center">';
                    echo $pagination;
                    echo '</div>';
                }
                ?>
            </div>
        </div><!-- /.box -->
    </div>
</div>