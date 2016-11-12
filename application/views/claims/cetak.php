<style>

    .print-view {
        max-width: 900px;
        background-color: #ffffff;
        padding: 20px;
    }

    .print-view .header h5, .print-view .header p {
        font-weight: 700;
        color: #66615b;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 16px !important;
    }

    .print-view p, .tuntutan {
        color: #66615b;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px !important;
    }

    .print-view .header-meta {
        position: absolute;
        top: 0;
        height: 70px;
        width: 100%;
        font-size: 10px !important;
    }

    .print-view .header-meta p.status {
        left: 0;
        position: absolute;
    }

    .header {
        margin-top: 20px
    }

    .header > img.logo {
        left: 10px;
        position: absolute;
        top: -10px;
        /*border:1px solid rgba(0,0,0,0.3);*/
        /*box-shadow: 0 0 5px 1px rgba(0,0,0,0.10);*/
    }

    .text-justify {
        text-align: justify;
        text-justify: inter-word;
    }

    .print-info span.value {
        padding: 0 30px;
        border-bottom: 2px dotted #66615b;
        font-weight: 700;
    }

    .tuntutan {
        margin: 40px 0
    }

    .tuntutan li {
        margin: 10px 0;
    }

    span.sum {
        position: absolute;
        right: 12% !important;
        width: 40px;
        text-align: center;
        padding: 1px;
        border: 1px solid #66615b;
    }
</style>
<section class="print-view">
    <div class="row">
        <div class="col-md-12 header-meta">
            <p class="status">
                <small>Status Permohonan : <?= $claim['status_name'] ?></small>
            </p>
            <p class="pull-right">
                <small>Tarikh Mohon : <?= date('d/m/Y', strtotime($claim['created'])) ?></small>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="header col-md-12">
            <img src="<?= base_url() . 'assets/img/logo.jpg'; ?>" width="120" alt="Logo" class="logo img-circle"/>
            <h5 class="text-center">
                KESATUAN KEBANGSAAN PENOLONG PEGAWAI PERUBATAN<br/>SEMENANJUNG MALAYSIA<br/>(NO PENDAFTARAN : 248)
            </h5>
            <p style="margin-bottom: 32px" class="text-center"><u>BORANG TUNTUTAN TABUNG KEBAJIKAN</u></p>
        </div>
    </div>

    <div class="row print-info">
        <div class="col-md-12">
            <p class="text-justify">Adalah saya / wakil saya seperti nama : <span
                    class="value"><?= $claim['member_name'] ?></span>
            </p>
            <p class="text-justify">Ahli Kesatuan Penolong Pegawai Perubatan Semenanjung Malaysia</p>
            <p class="text-justify">Cawangan <span class="value"><?= $claim['branch'] ?></span> menerima sumbangan
                sebanyak
                <span class="value">RM <?= $claim['sum'] ?></span> bagi tuntutan :</p>
        </div>
        <div class="col-md-12">
            <ul class="tuntutan" type="i">
                <?php
                foreach ($funds as $key => $fund) {
                    echo "<li style='margin: 10px;padding: 1px;'>";
                    echo $fund['name'] . " <span>- RM " . $fund['amount'] . "</span>";
                    echo '<span class="sum">' . ($fund['qty'] ? $fund['qty'] : '&nbsp;') . '</span>';
                    echo "</li>";
                }
                ?>
            </ul>
        </div>
        <div class="col-md-12">
            <p>Bersama-sama ini disertakan dokumen sokongan permohonan seperti tertera di atas.</p>
            <?php if (isset($attaches) && !empty($attaches)): ?>
                <ol class="tuntutan">
                    <?php
                    foreach ($attaches as $key => $attach): ?>
                        <li><a href="<?= base_url("uploads/" . $attach['file_name']) ?>"><?= $attach['title'] ?></a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            <?php else: ?>
                <p class="text-muted well well-sm no-shadow">
                    <small>Dokumen sokongan tidak disertakan.</small>
                </p>
            <?php endif; ?>
        </div>
        <div class="col-md-12">
            <table style="line-height: 2">
                <tbody>
                <tr>
                    <td width="200px">Tandatangan Penerima</td>
                    <td width="10px">:</td>
                    <td width="300px">…………………………………………</td>
                </tr>
                <tr>
                    <td width="200px">Nama</td>
                    <td width="10px">:</td>
                    <td width="300px"><?= $claim['member_name'] ?></td>
                </tr>
                <tr>
                    <td width="200px">No Kad Pengenalan</td>
                    <td width="10px">:</td>
                    <td width="300px"><?= $claim['member_nric'] ?></td>
                </tr>
                <tr>
                    <td width="200px">NO Akaun Bank</td>
                    <td width="10px">:</td>
                    <td width="300px"><?= $claim['num_account'] ?></td>
                </tr>
                </tbody>
            </table>
            <br/>
            <br/>
            <table style="line-height: 2">
                <tbody>
                <tr>
                    <td width="200px">Tandatangan Saksi</td>
                    <td width="10px">:</td>
                    <td width="300px">…………………………………………</td>
                </tr>
                <tr>
                    <td width="200px">Nama</td>
                    <td width="10px">:</td>
                    <td width="300px"></td>
                </tr>
                <tr>
                    <td width="200px">No Kad Pengenalan</td>
                    <td width="10px">:</td>
                    <td width="300px"></td>
                </tr>
                <tr>
                    <td width="200px">Cek bernombor</td>
                    <td width="10px">:</td>
                    <td width="300px">…………………………………………</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>