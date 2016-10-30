<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Daftar Ahli</h4>
        </div>
        <div class="content">
            <?php echo form_open('members/add', array('novalidate' => true)); // ?>

            <div class="row">
                <div class="col-md-2 col-xs-6">
                    <div class="form-group">
                        <label for="MemberDate" class="control-label">Tarikh Mohon :</label>
                        <input type="text" class="form-control border-input" name="date" id="MemberDate"
                               value="<?php echo set_value('date'); ?>">
                        <?php echo form_error('date', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="MemberName" class="control-label">Nama Penuh :</label>
                        <input type="text" class="form-control border-input" name="name" id="MemberName"
                               placeholder="Nama Penuh" value="<?php echo set_value('name'); ?>">
                        <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="MemberEmail" class="control-label">Alamat E-mel :</label>
                        <input type="email" class="form-control border-input" name="email" id="MemberEmail"
                               placeholder="example@ggmail.com" value="<?php echo set_value('email'); ?>">
                        <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="MemberNric" class="control-label">No Kad Pengenalan :</label>
                        <input onpaste="return false;" autocomplete="off" onfocus="" type="text"
                               class="form-control border-input" name="nric" id="MemberNric"
                               placeholder="cth: 829101018376" value="<?php echo set_value('nric'); ?>">
                        <?php echo form_error('nric', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-offset-3 col-md-3">
                    <div class="form-group">
                        <label for="MemberPhone" class="control-label">No Telefon :</label>
                        <input type="text" class="form-control border-input" name="phone" id="MemberPhone"
                               placeholder="039876543" value="<?php echo set_value('phone'); ?>">
                        <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="MemberTelephone" class="control-label">No Telefon Bimbit:</label>
                        <input type="text" class="form-control border-input" name="telephone" id="MemberTelephone"
                               placeholder="0129876543" value="<?php echo set_value('telephone'); ?>">
                        <?php echo form_error('telephone', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-2 col-xs-6">
                    <div class="form-group">
                        <label for="MemberAge" class="control-label">Umur :</label>
                        <input type="text" readonly="readonly" class="form-control border-input" name="age"
                               id="MemberAge" placeholder="18" value="<?php echo set_value('age'); ?>">
                        <?php echo form_error('age', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-2 col-xs-6">
                    <div class="form-group">
                        <label for="MemberYear" class="control-label">Tahun :</label>
                        <input type="text" readonly="readonly" class="form-control border-input" name="year"
                               id="MemberYear"
                               placeholder="2011" value="<?php echo set_value('year'); ?>">
                        <?php echo form_error('year', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-2 col-xs-6">
                    <div class="form-group">
                        <label for="MemberDob" class="control-label">Tarikh Lahir :</label>
                        <input type="text" readonly="readonly" class="form-control border-input" name="dob"
                               id="MemberDob" placeholder="dd-mm-yyyy" value="<?php echo set_value('dob'); ?>">
                        <?php echo form_error('dob', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-2 col-xs-6">
                    <div class="form-group">
                        <label for="MemberDop" class="control-label">Tarikh Lantikan :</label>
                        <input type="text" class="form-control border-input" name="dop" id="MemberDop"
                               placeholder="dd-mm-yyyy" value="<?php echo set_value('dop'); ?>">
                        <?php echo form_error('dop', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="MemberAddOffice" class="control-label">Alamat Tempat Bertugas :</label>
                        <textarea rows="3" class="form-control border-input" name="add_office" id="MemberAddOffice"
                                  placeholder="Alamat Tempat Bertugas"><?php echo set_value('add_office'); ?></textarea>
                        <?php echo form_error('add_office', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="MemberAddress" class="control-label">Alamat Rumah :</label>
                        <textarea rows="3" class="form-control border-input" name="address" id="MemberAddress"
                                  placeholder="Alamat Rumah"><?php echo set_value('address'); ?></textarea>
                        <?php echo form_error('address', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ParamStatus" class="control-label">Status Permohonan:</label>
                                <?php
                                //$status = array(''=>'--Pilih--');
                                $attr = array('class' => 'form-control border-input', 'id' => 'ParamStatus');
                                echo form_dropdown('status', $status, set_value('status'), $attr);
                                ?>
                                <?php echo form_error('status', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ParamActive" class="control-label">Status Keahlian:</label>
                                <?php
                                $options = array('' => '--Pilih--', '0' => 'Tidak Aktif', '1' => 'Aktif');
                                $attr = array('class' => 'form-control border-input', 'id' => 'ParamActive');
                                echo form_dropdown('is_active', $options,set_value('is_active'), $attr);
                                ?>
                                <?php echo form_error('is_active', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="MemberComment" class="control-label">Komen & Catatan :</label>
                        <textarea rows="5" class="form-control border-input" name="comment" id="MemberComment"
                                  placeholder="Komen & Catatan"><?php echo set_value('comment'); ?></textarea>
                                <?php echo form_error('comment', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success btn-fill btn-wd">Simpan</button>
            </div>
            <div class="clearfix"></div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>