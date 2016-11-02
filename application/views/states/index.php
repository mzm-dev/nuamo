<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Negeri</h4>
                <div class="pull-right box-tools">
                    <a href="<?= base_url("states/add/"); ?>"
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($states->result_array() as $state): ?>
                        <tr>
                            <td class="col-md-1"><?= $i ?></td>
                            <td class="col-md-1"><?= $state['code'] ?></td>
                            <td><?= $state['name'] ?></td>
                            <td class="col-md-1 text-center">
                                <?= '<i class="fa ' . ($state['is_active'] ? 'fa-check-circle' : 'fa-times-circle-o') . ' fa-lg text-success"></i>';?>
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