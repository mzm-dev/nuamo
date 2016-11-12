<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Kemaskini Jenis Tuntutan</h4>
        </div>

        <div class="content">
            <?php echo form_open('funds/edit/', null, array('id' => $fund['id'])); // ?>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="FundRank" class="control-label">Turutan :</label>
                        <input type="number" class="form-control border-input" name="rank" id="FundRank"
                               placeholder="cth: 1" value="<?= $fund['rank']; ?>">
                        <?php echo form_error('rank', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="FundName" class="control-label">Jenis Tuntutan :</label>
                        <input type="text" class="form-control border-input" name="name" id="FundName"
                               placeholder="Jenis Tuntutan"  value="<?= $fund['name']; ?>">
                        <?php echo form_error('code', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="FundAmount" class="control-label">Nilai (RM) :</label>
                        <div class="input-group">
                            <span class="input-group-addon">RM</span>
                            <input type="text" class="form-control border-input" name="amount" id="FundAmount"
                                   placeholder="cth: 100"  value="<?= $fund['amount']; ?>">
                        </div>
                        <?php echo form_error('amount', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="FundActive" class="control-label">Status :</label>
                        <?php
                        $options = array('' => '--Pilih--', '0' => 'Tidak Aktif', '1' => 'Aktif');
                        $attr = array('class' => 'form-control border-input', 'id' => 'FundActive');
                        echo form_dropdown('is_active', $options, $fund['is_active'], $attr);
                        ?>
                        <?php echo form_error('is_active', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="text-left">
            <div class="text-left">
                <button type="submit" class="btn btn-info btn-fill btn-wd">Kemaskini</button>
            </div>
            <div class="clearfix"></div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>