<style>
    .view {
        position: relative;
        background: #fff;
        border: 1px solid #f4f4f4;
        padding: 20px;
    }

    .header {
        margin-top: 20px
    }

    .header h5 {
        margin: 0
    }

    .header > img.logo {
        left: 10px;
        position: absolute;
        top: -10px;
        /*border: 1px solid rgba(0, 0, 0, 0.3);*/
        /*box-shadow: 0 0 5px 1px rgba(0, 0, 0, 0.10);*/
    }

    .text-justify {
        text-align: justify;
        text-justify: inter-word;
    }

    .view-info span.value {
        padding: 0 30px;
        border-bottom: 2px dotted #66615b;
        font-weight: 700;
    }

    span.sum {
        position: absolute;
        right: 25% !important;
        width: 40px;
        text-align: center;
        padding: 1px;
        border: 1px solid #66615b;
    }

    .btn-trash {
        position: absolute;
        left: 55% !important;
    }
</style>
<section class="view">
    <div class="row no-print">
        <div class="col-md-12">
            <a onclick='linkopen();' href='#'
               class="btn btn-primary btn-flat pull-right">
                <i class="fa fa-print"></i> Print</a>
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

    <div class="row view-info">
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
                        <li style='margin: 10px'>
                            <a href="<?= base_url("uploads/" . $attach['file_name']) ?>"><?= $attach['title'] ?></a>
                            <?= "[" . $attach['file_size'] . " MB]" ?>
                            <span class="btn-trash">

                                <a href="<?= base_url("claims/del_file/" . $attach['id']); ?>"
                                   onclick="return confirm('Are you sure you want to delete this item? <?= $attach['title'] ?>');"
                                   class="btn btn-icon btn-xs btn-danger"><i class="fa fa-remove"></i></a></span>

                        </li>
                    <?php endforeach; ?>

                </ol>

            <?php else: ?>
                <p class="text-muted well well-sm no-shadow">
                    <small>Dokumen sokongan tidak disertakan.</small>
                </p>
            <?php endif; ?>
        </div>


    </div>
</section>
<script>
    function linkopen() {
        window.open("<?= base_url("claims/cetak/" . $claim['id']); ?>", "_blank", "location=no ,toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=795, height=500px");
    }
</script>