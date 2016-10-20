<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Kemaskini Pengguna</h4>
        </div>

        <div class="content">
            <?php echo form_open('admins/edit/', null, array('id' => $admin['id'])); // ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="AdminUsername" class="control-label">Username :</label>
                        <input type="text" class="form-control border-input" name="username" id="AdminUsername"
                               placeholder="salim" value="<?= $admin['username']; ?>">
                        <?php echo form_error('username', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="AdminFullName" class="control-label">Full Name :</label>
                        <input type="text" class="form-control border-input" name="name" id="AdminFullName"
                               placeholder="Mohamad Salim" value="<?= $admin['name']; ?>">
                        <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="AdminEmail" class="control-label">Email :</label>
                        <input type="email" class="form-control border-input" name="email" id="AdminEmail"
                               placeholder="salim@example.com" value="<?= $admin['email']; ?>">
                        <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="AdminRole" class="control-label">Peranan :</label>
                        <?php
                        $attr = array('class' => 'form-control border-input', 'id' => 'AdminRole');
                        echo form_dropdown('role', $role, $admin['role'], $attr);
                        ?>
                        <?php echo form_error('role', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="AdminActive" class="control-label">Status:</label>
                        <?php
                        $attr = array('class' => 'form-control border-input', 'id' => 'AdminActive');
                        echo form_dropdown('is_active', $active, $admin['is_active'], $attr);
                        ?>
                        <?php echo form_error('is_active', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>


            <div class="text-left">
                <div class="text-left">
                    <button type="submit" class="btn btn-info btn-fill btn-wd">Update</button>
                </div>
                <div class="clearfix"></div>
                <?php echo form_close(); ?>
                </form>
            </div>
        </div>
    </div>