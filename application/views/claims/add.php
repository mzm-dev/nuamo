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
            <h4 class="title">Daftar Tuntutan</h4>
        </div>
        <div class="content">
            <?php echo form_open('claims/add', array('novalidate' => true)); // ?>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="ClaimNric" class="control-label">No Kad Pengenalan :</label>
                        <input type="text" class="form-control border-input" name="nric" id="ClaimNric"
                               placeholder="cth: 780911052381">
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
                               readonly="readonly" placeholder="Nama Penuh Pemohon">
                        <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="ClaimBranch" class="control-label">Cawangan :</label>
                        <input type="text" class="form-control border-input" name="branch" id="ClaimBranch"
                               placeholder="Cawangan">
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
                        echo form_dropdown('branch', $bank, set_value('bank_account'), $attr);
                        ?>
                        <?php echo form_error('bank_account', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="ClaimAccount" class="control-label">No Akaun :</label>
                        <input type="text" class="form-control border-input" name="num_account" id="ClaimAccount"
                               placeholder="xxxxx">
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

                        .amount, .sum {
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
                        echo '<input name="count" value="' . count($funds). '" type="text">';
                        foreach ($funds as $key => $fund) {
                            echo "<li style='margin: 10px'>";
                            echo $fund['name'] . " <span>- RM " . $fund['amount'] . " x </span>";
                            echo '<input name="id-' . $key . '" hidden="hidden" value="' . $fund['id'] . '" type="text">';
                            echo '<input name="amount-' . $key . '" min="1" max="5" data-amount="' . $fund['amount'] . '" class="amount" value="0" type="text">';
                            echo "</li>";

                        } ?>
                        <li style="font-weight: 700">Jumlah Sumbangan :
                            <input name="sum" class="sum" value="0" type="text"/>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="text-left">
                <button type="submit" class="btn btn-info btn-fill btn-wd">Save</button>
            </div>
            <div class="clearfix"></div>
            <?php echo form_close(); ?>
            </form>
        </div>
    </div>
</div>