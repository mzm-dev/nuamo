<style>
    .content-view label {
        color: #808080;
        font-size: 16px;
        font-weight: 400;
    }

    .content-view .form-group {
        border-bottom: 1px solid #333;
        font-weight: 600;
    }
</style>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Butiran Ahli</h4>
        </div>
        <div class="content content-view">
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <div class="form-group">
                        <label for="MemberDate" class="control-label">Tarikh Mohon :</label>
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ParamStatus" class="control-label">Status Permohonan:</label>
                        <?= $status_name[$member['status']]; ?>
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
    </div>
</div>