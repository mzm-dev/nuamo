<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Edit Profile</h4>
        </div>
        <div class="content">
            <?= form_open('members/edit/', null, array('id' => $member['id'])); //  ?>
            <div class="row">
                <div class="col-md-2 col-xs-6">
                    <div class="form-group">
                        <label for="MemberDate" class="control-label">Tarikh Mohon :</label>
                        <input type="text" class="form-control border-input" name="date" id="MemberDate"
                               value="<?= date("d-m-Y", strtotime($member['date_register'])) ?>">
                        <?= form_error('date_register', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="MemberName" class="control-label">Nama Penuh :</label>
                        <input type="text" class="form-control border-input" name="name" id="MemberName"
                               placeholder="Nama Penuh" value="<?= $member['name']; ?>">
                        <?= form_error('name', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="MemberEmail" class="control-label">Alamat E-mel :</label>
                        <input type="email" class="form-control border-input" name="email" id="MemberEmail"
                               placeholder="example@ggmail.com" value="<?= $member['email']; ?>">
                        <?= form_error('email', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="MemberNric" class="control-label">No Kad Pengenalan :</label>
                        <input onpaste="return false;" autocomplete="off" onfocus="" type="text"
                               class="form-control border-input" name="nric" id="MemberNric"
                               placeholder="cth: 829101018376" value="<?= $member['nric']; ?>">
                        <?= form_error('nric', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-offset-3 col-md-3">
                    <div class="form-group">
                        <label for="MemberPhone" class="control-label">No Telefon :</label>
                        <input type="text" class="form-control border-input" name="phone" id="MemberPhone"
                               placeholder="039876543" value="<?= $member['phone']; ?>">
                        <?= form_error('phone', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="MemberTelephone" class="control-label">No Telefon Bimbit:</label>
                        <input type="text" class="form-control border-input" name="telephone" id="MemberTelephone"
                               placeholder="0129876543" value="<?= $member['telephone']; ?>">
                        <?= form_error('telephone', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-xs-6">
                    <div class="form-group">
                        <label for="MemberAge" class="control-label">Umur :</label>
                        <input type="text" readonly="readonly" class="form-control border-input" name="age"
                               id="MemberAge" placeholder="18" value="<?= $member['age']; ?>">
                        <?= form_error('age', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-2 col-xs-6">
                    <div class="form-group">
                        <label for="MemberYear" class="control-label">Tahun :</label>
                        <input type="text" readonly="readonly" class="form-control border-input" name="year"
                               id="MemberYear"
                               placeholder="2011" value="<?= $member['year']; ?>">
                        <?= form_error('year', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-2 col-xs-6">
                    <div class="form-group">
                        <label for="MemberDob" class="control-label">Tarikh Lahir :</label>
                        <input type="text" readonly="readonly" class="form-control border-input" name="dob"
                               id="MemberDob" placeholder="dd-mm-yyyy"
                               value="<?= date("d-m-Y", strtotime($member['dob'])) ?>">
                        <?= form_error('dob', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-2 col-xs-6">
                    <div class="form-group">
                        <label for="MemberDop" class="control-label">Tarikh Lantikan :</label>
                        <input type="text" class="form-control border-input" name="dop" id="MemberDop"
                               placeholder="dd-mm-yyyy" value="<?= date("d-m-Y", strtotime($member['dop'])) ?>">
                        <?= form_error('dop', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ParamState" class="control-label">Negeri Bertugas:</label>
                        <?php
                        $attr = array('class' => 'form-control border-input', 'id' => 'ParamState');
                        echo form_dropdown('state_id', $states, $member['state_id'], $attr);
                        ?>
                        <?= form_error('state_id', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="MemberAddOffice" class="control-label">Alamat Tempat Bertugas :</label>
                        <textarea rows="3" class="form-control border-input" name="add_office" id="MemberAddOffice"
                                  placeholder="Alamat Tempat Bertugas"><?= $member['add_office']; ?></textarea>
                        <?= form_error('add_office', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="MemberAddress" class="control-label">Alamat Rumah :</label>
                        <textarea rows="3" class="form-control border-input" name="address" id="MemberAddress"
                                  placeholder="Alamat Rumah"><?= $member['address']; ?></textarea>
                        <?= form_error('address', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <hr/>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label for="MemberReceived" class="control-label">Tarikh Borang Permohonan Diterima :</label>
                                <input type="text" class="form-control border-input" name="date_register" id="MemberReceived"
                                       placeholder="dd-mm-yyyy" value="<?= $member['date_received']; ?>">
                                <?= form_error('date_received', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label for="MemberApproved" class="control-label">Tarikh Permohonan Diluluskan :</label>
                                <input type="text" class="form-control border-input" name="dop" id="MemberApproved"
                                       placeholder="dd-mm-yyyy" value="<?= $member['date_approved']; ?>">
                                <?= form_error('date_approved', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <div class="form-group">
                                <label for="MemberNotified" class="control-label">Permohonan Diberitahu Pada :</label>
                                <input type="text" class="form-control border-input" name="dop" id="MemberNotified"
                                       placeholder="dd-mm-yyyy" value="<?= $member['date_notified']; ?>">
                                <?= form_error('date_notified', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="MemberComment" class="control-label">Komen & Catatan :</label>
                        <textarea rows="7" class="form-control border-input"
                                  name="comment" id="MemberComment"
                                  placeholder="Komen & Catatan"><?= $member['comment']; ?>
                        </textarea>
                                <?= form_error('comment', '<div class="error">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label for="MemberReceipt" class="control-label">No. Resit :</label>
                        <input type="text" class="form-control border-input" name="nom_receipt" id="MemberReceipt"
                               placeholder="123409" value="<?= $member['nom_receipt']; ?>">
                        <?= form_error('nom_receipt', '<div class="error">', '</div>'); ?>
                    </div>
                </div>

                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label for="MemberDop" class="control-label">Tarikh Dikelurkan  :</label>
                        <input type="text" class="form-control border-input" name="date_receipt" id="MemberDop"
                               placeholder="dd-mm-yyyy" value="<?= $member['date_receipt']; ?>">
                        <?= form_error('date_receipt', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ParamStatus" class="control-label">Status Permohonan:</label>
                        <?php
                        //$status = array(''=>'--Pilih--');
                        $attr = array('class' => 'form-control border-input', 'id' => 'ParamStatus');
                        echo form_dropdown('status', $status, $member['status'], $attr);
                        ?>
                        <?= form_error('status', '<div class="error">', '</div>'); ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ParamActive" class="control-label">Status Keahlian:</label>
                        <?php
                        $options = array('' => '--Pilih--', '0' => 'Tidak Aktif', '1' => 'Aktif');
                        $attr = array('class' => 'form-control border-input', 'id' => 'ParamActive');
                        echo form_dropdown('is_active', $options, $member['is_active'], $attr);
                        ?>
                        <?= form_error('is_active', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-info btn-fill btn-wd">Update</button>
            </div>
            <div class="clearfix"></div>
            <?= form_close(); ?>
        </div>
    </div>
</div>