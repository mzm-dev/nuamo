<style>
    .content-view{
        position: relative;
        background: #fff;
        border: 1px solid #f4f4f4;
        padding: 20px;
    }
    .content-view label {
        color: #808080;
        font-size: 16px;
        font-weight: 400;
    }

    .content-view .form-group {
        font-weight: 600;
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background: #fff;
        background-image: none;
        border: 1px solid #9a9a9a;
        border-radius: 1px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s
    }
</style>

<div class="content content-view">
    <div class="row no-print">
        <div class="col-md-12">
            <a onclick='linkopen();' href='#'
               class="btn btn-primary btn-flat pull-right">
                <i class="fa fa-print"></i> Print</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <div class="form-group">
                <label for="MemberDate" class="control-label">Tarikh Mohon :</label>
                <span><?= date("d-m-Y", strtotime($member['date_register'])) ?></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="MemberName" class="control-label">Nama Penuh :</label>
                <span><?= $member['name'] ?></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="MemberEmail" class="control-label">Alamat E-mel :</label>
                <?= $member['email'] ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="MemberNric" class="control-label">No Kad Pengenalan :</label>
                <?= $member['nric'] ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="MemberPhone" class="control-label">No Telefon :</label>
                <?= $member['phone'] ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="MemberTelephone" class="control-label">No Telefon Bimbit:</label>
                <?= $member['telephone'] ?>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-2 col-xs-6">
            <div class="form-group">
                <label for="MemberAge" class="control-label">Umur :</label>
                <?= $member['age'] ?>
            </div>
        </div>
        <div class="col-md-2 col-xs-6">
            <div class="form-group">
                <label for="MemberYear" class="control-label">Tahun :</label>
                <?= $member['year'] ?>
            </div>
        </div>
        <div class="col-md-4 col-xs-6">
            <div class="form-group">
                <label for="MemberDob" class="control-label">Tarikh Lahir :</label>
                <?= $member['dob'] ?>
            </div>
        </div>
        <div class="col-md-4 col-xs-6">
            <div class="form-group">
                <label for="MemberDop" class="control-label">Tarikh Lantikan :</label>
                <?= $member['dop'] ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="MemberAddOffice" class="control-label">Negeri Tempat Bertugas :</label>
                <?= $member['states'] ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="MemberAddOffice" class="control-label">Alamat Tempat Bertugas :</label>
                <?= $member['add_office'] ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="MemberAddress" class="control-label">Alamat Rumah :</label>
                <?= $member['address'] ?>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6 col-xs-6">
            <div class="form-group">
                <label for="MemberDate" class="control-label">Tarikh Borang Permohonan Diterima :</label>
                <span><?= ($member['date_received'] ? date("d-m-Y", strtotime($member['date_received'])) : '-') ?></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xs-6">
            <div class="form-group">
                <label for="MemberDate" class="control-label">Tarikh Permohonan Diluluskan :</label>
                <span><?= ($member['date_approved'] ? date("d-m-Y", strtotime($member['date_approved'])) : '-') ?></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xs-6">
            <div class="form-group">
                <label for="MemberDate" class="control-label">Permohonan Diberitahu Pada :</label>
                <span><?= ($member['date_notified'] ? date("d-m-Y", strtotime($member['date_notified'])) : '-') ?></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="ParamStatus" class="control-label">No.Resit:</label>
                <?= $member['nom_receipt']; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="ParamActive" class="control-label">Tarikh Dikeluarkan:</label>
                <span><?= ($member['date_receipt'] ? date("d-m-Y", strtotime($member['date_receipt'])) : '-') ?></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="ParamStatus" class="control-label">Status Permohonan:</label>
                <?= $member['status_name']; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="ParamActive" class="control-label">Status Keahlian:</label>
                <?= $status[$member['is_active']]; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="MemberComment" class="control-label">Komen & Catatan :</label>
                <?= $member['comment']; ?>
            </div>
        </div>
    </div>
</div>
<script>
    function linkopen() {
        window.open("<?= base_url("members/cetak/" . $member['id']); ?>", "_blank", "location=no ,toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=795, height=500px");
    }
</script>