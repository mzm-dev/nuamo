<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Edit Profile</h4>
        </div>
        <div class="content">
            <?php echo form_open('params/add', array('novalidate' => true)); // ?>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="ParamCode" class="control-label">Code :</label>
                        <input type="number" class="form-control border-input" name="code" id="ParamCode"
                               placeholder="cth: 1010">
                        <?php echo form_error('code', '<div class="error">', '</div>'); ?>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ParamName" class="control-label">Parameter Name :</label>
                        <input type="text" class="form-control border-input" name="name" id="ParamName"
                               placeholder="Param Name">
                        <?php echo form_error('code', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ParamStatus" class="control-label">Status :</label>
                        <?php
                        $options = array(''=>'--Pilih--','0'=>'Tidak Aktif','1'=>'Aktif');
                        $attr = array('class'=> 'form-control border-input','id' => 'ParamStatus');
                        echo form_dropdown('status', $options, null,$attr);
                        ?>
                        <?php echo form_error('status', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="text-left">
                <button type="submit" class="btn btn-info btn-fill btn-wd">Save</button>
            </div>
            <div class="clearfix"></div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>