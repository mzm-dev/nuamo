<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Kemaskini Pengguna</h4>
        </div>

        <div class="content">
            <?php echo form_open('users/change_password/', null, array('id' => $user['id'])); // ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="UserPassword" class="control-label">Current Password :</label>
                        <input type="password" class="form-control border-input" name="current_password" id="UserPassword" placeholder="password" value="<?php echo set_value('current_password'); ?>">
                        <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="UserNewPassword" class="control-label">New Password :</label>
                        <input type="password" class="form-control" name="new_password" id="UserNewPassword" placeholder="password" value="<?php echo set_value('new_password'); ?>">
                        <?php echo form_error('new_password', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="UserNewPassword2" class="control-label">Verify New Password :</label>
                        <input type="password" class="form-control" name="new_password2" id="UserNewPassword2" placeholder="password" value="<?php echo set_value('new_password'); ?>">
                        <?php echo form_error('new_password2', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>

            <div class="text-left">
                <div class="text-left">
                    <button type="submit" class="btn btn-info btn-fill btn-wd">Update</button>
                </div>
                <div class="clearfix"></div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>