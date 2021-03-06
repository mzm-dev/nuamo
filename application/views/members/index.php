<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Senarai Ahli Aktif</h4>
                <div class="pull-right box-tools">
                    <a href="<?= base_url("members/add/"); ?>"
                       class="btn btn-primary btn-sm btn-flat btn-fill"><i class="fa fa-plus"></i> Daftar Ahli</a>
                </div>
                <?php echo form_open('members/index', array('class' => 'form-inline', 'novalidate' => true)); // ?>
                <div class="form-group">
                    <label class="sr-only" for="inputSearch">Search</label>
                    <input type="text" name="query" class="form-control" id="inputSearch" placeholder="Carian">
                </div>
                <button type="submit" class="btn btn-sm btn-warning btn-fill btn-flat btn-magnify">
                    <span class="btn-label"><i class="ti-search"></i></span> Carian
                </button>
                <?php echo form_close(); ?>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>No K/P</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(empty($members->result_array())){
                        echo '<div class="alert alert-warning"><span>Data Not Found</span></div>';
                    }
                 
                    $i = ($this->pagination->cur_page - 1) * $this->pagination->per_page;
                    foreach ($members->result_array() as $member): ?>
                        <tr>
                            <td class="col-md-1"><?= $i +1 ?></td>
                            <td class="col-md-1"><?= $member['nric'] ?></td>
                            <td><?= $member['name'] ?></td>
                            <td class="col-md-1 text-center">
                                <?= '<i class="fa ' . ($member['is_active'] ? 'fa-check-circle' : 'fa-times-circle-o') . ' fa-lg text-success"></i>'; ?>
                            </td>
                            <td class="col-md-2">
                                <a href="<?= base_url("members/view/" . $member['id']); ?>"
                                   class="btn btn-info btn-sm btn-flat btn-fill"><i class="fa fa-info-circle"></i></a>
                                <a href="<?= base_url("members/edit/" . $member['id']); ?>"
                                   class="btn btn-warning btn-sm btn-flat btn-fill"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url("members/delete/" . $member['id']); ?>"
                                   onclick="return confirm('Are you sure you want to delete this item? <?= $member['name'] ?>');"
                                   class="btn btn-danger btn-sm btn-flat btn-fill"><i class="fa fa-remove"></i></a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    endforeach; ?>
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