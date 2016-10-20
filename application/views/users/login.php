<div class="row">
    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
        <?php echo form_open('auths/login', array('novalidate' => true)); // ?>
            <div class="card">
                <div class="header">
                    <h3 class="title">Login</h3>
                </div>
                <div class="content">
                    <?php
                    $message = $this->session->flashdata('item');
                    echo (!empty($message) ? '<div class="alert alert-' . $message['class'] . '" role="alert" id="infoMessage"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><span>' . $message['message'] . '</span></div>' : '');
                    ?>
                    <div class="form-group">
                        <label for="LoginEmail" class="control-label">Email address</label>
                        <input type="email" class="form-control border-input" name="email" id="LoginEmail"
                               placeholder="Enter email" value="<?php echo set_value('email'); ?>">
                        <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="LoginPassword" class="control-label">Password</label>
                        <input type="password" class="form-control border-input" name="password" id="LoginPassword"
                               placeholder="Password" value="<?php echo set_value('password'); ?>">
                        <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="footer text-center">
                    <button type="submit" class="btn btn-fill btn-wd ">Login</button>
                    <div class="forgot">
                        <a href="<?= base_url("auths/forgot"); ?>">Forgot your password?</a>
                    </div>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>