<div class="col-lg-12 col-md-12">
    <div class="guest semak">
        <div class="header">
            <p class="title text-danger">Masih dalam pembangunan</p>
            <h4 class="title">Semak Status Permohonan Tabung Kebajikan</h4>
        </div>
        <div class="content">
            <?php echo form_open('guests/bantuan_semak', array('class' => 'form-inline', 'novalidate' => true)); // ?>
            <div class="form-group">
                <label for="MemberNric">No Kad Pengenalan</label>
                <input onpaste="return false;" autocomplete="off" onfocus="" type="text"
                       class="form-control border-input" name="nric" id="MemberNric"
                       placeholder="cth: 829101018376" value="<?php echo set_value('nric'); ?>">
                <?php echo form_error('nric', '<div class="error">', '</div>'); ?>
            </div>
            <button type="submit" class="btn btn-sm btn-warning btn-fill btn-flat btn-magnify btn-wd disabled">
                <span class="btn-label"><i class="ti-search"></i></span> Semak
            </button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
