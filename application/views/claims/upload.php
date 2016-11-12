<style>
    .content-view label {
        color: #808080;
        font-size: 16px;
        font-weight: 400;
    }

    .content-view .form-group {
        font-weight: 600;
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid rgba(0, 0, 0, .075);
        border-radius: 1px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s
    }

    .tuntutan > li > span {
        position: absolute;
        right: 10%
    }

</style>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Upload</h4>
        </div>
        <div class="content content-view">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="MemberName" class="control-label">Nama Penuh :</label>
                        <span><?= $claim['member_name'] ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="MemberNric" class="control-label">No Kad Pengenalan :</label>
                        <?= $claim['nric'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="MemberPhone" class="control-label">Cawangan :</label>
                        <?= $claim['branch'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="MemberPhone" class="control-label">Bank :</label>
                        <?= $bank[$claim['bank_account']] ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="MemberPhone" class="control-label">No Akaun :</label>
                        <?= $claim['num_account'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <ul class="tuntutan" style="list-style: none;">
                <?php
                foreach ($items as $key => $item) {
                    echo "<li style='margin: 10px'>";
                    echo $item['funds_name'] . " <span>: " . $item['qty'] . " x RM " . $item['funds_amount'] . " = RM " . number_format($item['qty'] * $item['funds_amount'], 2, '.', '') . "</span>";
                    echo "</li>";

                } ?>
                <li style="margin: 10px; font-weight: 700">Jumlah Sumbangan :
                    <?= " <span class='sum_amount'>RM " . $claim['sum'] . "</span>"; ?>
                </li>
            </ul>
            <hr/>
            <?php echo  form_open_multipart('claims/upload/', null, array('id' => $claim['id'])); // ?>

            <h4>Muat Naik Dokumen Sokongan</h4>
            <div class="form-group">
                <label for="ClaimTitle" class="control-label">Tajuk Fail :</label>
                <input type="text" class="form-control border-input" name="title" id="ClaimTitle"
                       placeholder="Tajuk Fail" value="<?= set_value('title') ?>">
                <?php echo form_error('title', '<div class="error">', '</div>'); ?>
            </div>
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-info btn-fill btn-wd btn-flat">
                        Browse&hellip; <input type="file" name="document" style="display: none;" multiple>
                    </span>
                </label>
                <input type="text" class="form-control"  readonly>
            </div>
            <?php echo form_error('document', '<div class="error">', '</div>'); ?>
            <span class="help-block">
                Dokumen yang dibenarkan hanya *.jpg, *.jpeg, *.png, *.gif, *.pdf, *.zip, *.rar
            </span>

            <button type="submit" class="btn btn-info btn-fill btn-wd">Upload</button>
            <?php echo form_close(); ?>
            <hr/>
            <?php if (isset($attaches) && !empty($attaches)): ?>
                <h4>Dokumen Sokongan</h4>
                <ul class="tuntutan" type="i">
                    <?php
                    foreach ($attaches as $key => $attach): ?>
                        <li style='margin: 10px'>
                            <a href="<?= base_url("uploads/" . $attach['file_name']) ?>"><?= $attach['title'] ?></a>
                            <?= "[" . $attach['file_size'] . " MB]" ?>
                            <span><a href="<?= base_url("claims/del_file/" . $attach['id']); ?>"
                                     onclick="return confirm('Are you sure you want to delete this item? <?= $attach['title'] ?>');"
                                     class="btn btn-danger btn-xs btn-fill"><i class="fa fa-remove"></i></a></span>

                        </li>
                    <?php endforeach; ?>

                </ul>

            <?php endif; ?>
        </div>

    </div>
</div>