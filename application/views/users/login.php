<style>
    img.logo {
        width: 80px !important;
        border: 1px solid rgba(0, 0, 0, 0.3);
        box-shadow: 0 0 5px 1px rgba(0, 0, 0, 0.10);
    }
</style>
<div class="row">
    <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-2">

        <div class="card">
            <div class="content login">
                <?php
                $message = $this->session->flashdata('item');
                echo(!empty($message) ? '<div class="alert alert-' . $message['class'] . '" role="alert" id="infoMessage"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><span>' . $message['message'] . '</span></div>' : '');
                ?>
                <div class="row">
                    <div class="col-md-6 text-center">
                        <div style="padding: 20px 0; border-right: 1px solid rgba(0,0,0,0.1)">
                            <img src="<?= base_url() . 'assets/img/logo.jpg'; ?>" alt="Logo" class="logo img-circle"/>
                            <p>
                                <small>KESATUAN KEBANGSAAAN PENOLONG PEGAWAI PERUBATAN SEMENANJUNG MALAYSIA<br/>(NO
                                    PENDAFTARAN :
                                    248)
                                </small>
                            </p>
                            <a class="btn btn-fill btn-flat btn-success" href="<?= base_url("guests/"); ?>">Contoh Capaian Umum</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-center">Log Masuk</h5>
                        <?php echo form_open('auths/login', array('novalidate' => true)); // ?>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="ti-email"></i></span>
                                <input type="email" class="form-control border-input" name="email" id="LoginEmail"
                                       placeholder="E-mel" value="<?php echo set_value('email'); ?>">
                            </div>
                            <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="ti-key"></i></span>
                                <input type="password" class="form-control border-input" name="password"
                                       id="LoginPassword"
                                       placeholder="Kata Laluan" value="<?php echo set_value('password'); ?>">
                            </div>
                            <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                        </div>
                        <div class="footer text-center">
                            <button type="submit" class="btn btn-fill btn-wd ">Log Masuk</button>
                            <div class="forgot">
                                <a href="<?= base_url("auths/forgot"); ?>">Lupa Kata Laluan</a>
                            </div>
                            <?php echo form_close(); ?>
                        </div>

                    </div>


                </div>

            </div>
        </div>

    </div>
</div>