<style>
    .form-control-feedback {
        display: none;
        right: 0px !important;
        margin-top: -4px !important;
        color: #43a047;
    }
</style>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Kemaskini Permohonan</h4>
        </div>
        <div class="content">
            <?= form_open('claims/edit/', null, array('id' => $claim['id'])); //    ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="ClaimNric" class="control-label">No Kad Pengenalan :</label>
                        <input type="text" class="form-control border-input" name="nric" id="ClaimNric"
                               placeholder="cth: 780911052381" value="<?= $claim['nric'] ?>">
                        <div class="form-control-feedback" id="nirc-success">
                            <i class="fa fa-check-square-o"></i>
                        </div>
                        <?php echo form_error('nric', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ClaimName" class="control-label">Nama Pemohon :</label>
                        <input type="text" class="form-control border-input" name="name" id="ClaimName"
                               readonly="readonly" placeholder="Nama Penuh Pemohon"
                               value="<?= $claim['member_name'] ?>">
                        <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="ClaimBranch" class="control-label">Cawangan :</label>
                        <input type="text" class="form-control border-input" name="branch" id="ClaimBranch"
                               placeholder="Cawangan" value="<?= $claim['branch'] ?>">
                        <?php echo form_error('branch', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ClaimBranch" class="control-label">Nama Bank :</label>
                        <?php
                        $attr = array('class' => 'form-control border-input', 'id' => 'ClaimBranch');
                        echo form_dropdown('bank_account', $bank, $claim['bank_account'], $attr);
                        ?>
                        <?php echo form_error('bank_account', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="ClaimAccount" class="control-label">No Akaun :</label>
                        <input type="text" class="form-control border-input" name="num_account" id="ClaimAccount"
                               placeholder="xxxxx" value="<?= $claim['num_account'] ?>">
                        <?php echo form_error('num_account', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <style>
                        .tuntutan > li > span {
                            position: absolute;
                            right: 32%
                        }

                        .qty, .sum {
                            position: absolute;
                            right: 20%;
                            width: 100px;
                            text-align: center;
                            padding-right: 4px
                        }

                        ;
                        .sum {
                            font-weight: 700
                        }
                    </style>

                    <ul class="tuntutan" type="i">
                        <?php

                        //var_dump('<pre>');
                        //var_dump($funds);

                        echo '<input name="count" value="' . count($funds) . '" type="hidden">';
                        foreach ($funds as $key => $fund) {
                            echo "<li style='margin: 10px'>";
                            echo $fund['name'] . " <span>- RM " . $fund['amount'] . " x </span>";
                            echo '<input name="fund-' . $key . '" hidden="hidden" value="' . $fund['id'] . '" type="text">';
                            echo '<input name="amount-' . $key . '" hidden="hidden" value="' . $fund['amount'] . '" type="text">';
                            echo '<input name="qty-' . $key . '" min="1" max="5" data-amount="' . $fund['amount'] . '" class="qty" value="' . ($fund['qty'] ? $fund['qty'] : 0) . '" type="text">';
                            echo "</li>";

                        } ?>
                        <li style="font-weight: 700">Jumlah Sumbangan :
                            <input name="sum" class="sum" value="<?= $claim['sum'] ?>" type="text"/>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="MemberComment" class="control-label">Catatan :</label>
                        <textarea rows="7" class="form-control border-input"
                                  name="catatan" id="MemberComment"
                                  placeholder="Catatan"><?= $claim['catatan']; ?></textarea>
                        <?= form_error('catatan', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ParamStatus" class="control-label">Status Permohonan:</label>
                        <?php
                        //$status = array(''=>'--Pilih--');
                        $attr = array('class' => 'form-control border-input', 'id' => 'ParamStatus');
                        echo form_dropdown('status', $status, $claim['status'], $attr);
                        ?>
                        <?= form_error('status', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="text-left">
                <input value="<?= $this->uri->segment(3); ?>" name="redirect" hidden="hidden"/>
                <button type="submit" class="btn btn-info btn-fill btn-wd">Save</button>
            </div>
            <div class="clearfix"></div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>