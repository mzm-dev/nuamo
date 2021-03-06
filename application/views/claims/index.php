<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Rekod Permohonan</h4>
                <div class="pull-right box-tools">
                    <a href="<?= base_url("claims/add"); ?>"
                       class="btn btn-primary btn-sm btn-flat btn-fill"><i class="fa fa-plus"></i>&nbsp;Daftar Permohonan</a>
                </div>
                <?php echo form_open('claims/index', array('class' => 'form-inline', 'novalidate' => true)); // ?>
                <div class="form-group">
                    <label class="sr-only" for="inputSearch">Search</label>
                    <input type="text" name="query" class="form-control" id="inputSearch" placeholder="Carian">
                </div>
                <button type="submit" class="btn btn-warning btn-fill btn-flat btn-magnify btn-sm">
                    <span class="btn-label"><i class="ti-search"></i></span> Carian
                </button>
                <?php echo form_close(); ?>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>No K/P</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (empty($claims->result_array())) {
                        echo '<div class="alert alert-warning"><span>Data Not Found</span></div>';
                    }
                    $i = 1;
                    foreach ($claims->result_array() as $claim): ?>
                        <tr>
                            <td class="col-md-1"><?= $i ?></td>
                            <td class="col-md-3"><a
                                    href='<?= base_url("members/view/" . $claim['member_id']); ?>'><?= $claim['member_name'] ?></a>
                            </td>
                            <td><?= $claim['nric'] ?></td>
                            <td class="col-md-2"><?= "RM ".$claim['sum']; ?></td>
                            <td class="col-md-2"><?= $claim['status_name']; ?></td>
                            <td class="col-md-2">
                                <a href="<?= base_url("claims/view/index/" . $claim['id']); ?>"
                                   class="btn btn-info btn-sm btn-flat btn-fill"><i class="fa fa-info-circle"></i></a>
                                <a href="<?= base_url("claims/delete/index/" . $claim['id']); ?>"
                                   onclick="return confirm('Are you sure you want to delete this item? <?= $claim['nric'] ?>');"
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