<div class="col-lg-12 col-md-12">
    <div class="guest semak">
        <div class="header">
            <h4 class="title">Semak Status Keahlian / Status Pendaftaran Keahlian</h4>
        </div>
        <div class="content">
            <?php echo form_open('guests/ahli_semak', array('class' => 'form-inline', 'novalidate' => true)); // ?>
            <div class="form-group">
                <label for="MemberNric">No Kad Pengenalan</label>
<!--                onpaste="return false;"-->
                <input  autocomplete="off" onfocus="" type="text"
                       class="form-control border-input" name="nric" id="MemberNric"
                       placeholder="cth: 829101018376" value="<?php echo set_value('nric'); ?>">
            </div>
            <button type="submit" class="btn btn-sm btn-warning btn-fill btn-flat btn-magnify btn-wd">
                <span class="btn-label"><i class="ti-search"></i></span> Semak
            </button>
            <?php echo form_close(); ?>
            <?php echo form_error('nric', '<div class="error">', '</div>'); ?>

        </div>
    </div>
</div>
