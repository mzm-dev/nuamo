<?= doctype('html5'); ?>
<html lang="en">
<head>
    <?= link_tag('assets/img/apple-icon.png', 'apple-touch-icon'); ?>
    <?= link_tag('assets/img/favicon.png', 'shortcut icon', 'image/png'); ?>
    <?php
    $meta = array(
        array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge,chrome=1'),
        array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'),
        array('name' => 'robots', 'content' => 'no-cache'),
        array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
    );
    echo meta($meta);
    ?>

    <title>KESATUAN KEBANGSAAAN PENOLONG PEGAWAI PERUBATAN SEMENANJUNG MALAYSIA</title>

    <!-- Bootstrap core CSS     -->
    <?= link_tag('assets/css/bootstrap.min.css'); ?>

    <!-- Animation library for notifications   -->
    <?= link_tag('assets/css/animate.min.css'); ?>

    <!--  Date Picker -->
    <?= link_tag('assets/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css'); ?>
    <!--  Paper Dashboard core CSS    -->
    <!--    --><? //= link_tag('assets/css/paper-dashboard.css'); ?>
    <?= link_tag('assets/css/paper-dashboard.css'); ?>

    <!--  Fonts and icons     -->
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <?= link_tag('assets/font-awesome/css/font-awesome.min.css'); ?>
    <?= link_tag('assets/css/themify-icons.css'); ?>
    <script type="text/javascript">
        var site_url = '<?= base_url(); ?>';
    </script>
    <style>
        .guest.semak {
            padding-top: 20vh;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="row">
    <div class="container-fluid">

        <div class="col-md-9">
            <?php
            $message = $this->session->flashdata('item');
            echo(!empty($message) ? '<div class="alert alert-' . $message['class'] . '" role="alert" id="infoMessage"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><span>' . $message['message'] . '</span></div>' : '');
            ?>
            <?php $this->load->view($main); ?>

        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p>Ini adalah pautan capaian ke fungsi pengunjung yang akan di wujudkan di Laman Web Persatuan</p>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <a href="<?= base_url("guests/"); ?>" class="list-group-item">Laman Utama</a>
                        <a href="<?= base_url("guests/ahli_daftar"); ?>" class="list-group-item">Daftar Ahli</a>
                        <a href="<?= base_url("guests/ahli_semak"); ?>" class="list-group-item">Semak Status
                            Keahlian</a>
                        <a href="<?= base_url("guests/bantuan_daftar"); ?>" class="list-group-item">Mohon Tabung
                            Kebajikan</a>
                        <a href="<?= base_url("guests/bantuan_semak"); ?>" class="list-group-item">Semak Status
                            Permohonan</a>

                </div>
            </div>
        </div>


    </div>
</div>
</div>
<!-- /#wrapper -->
<!--   Core JS Files   -->
<script src="<?= base_url() . 'assets/js/jquery-1.10.2.js'; ?>" type="text/javascript"></script>
<script src="<?= base_url() . 'assets/js/bootstrap.min.js'; ?>" type="text/javascript"></script>

<!--  Moment -->
<script src="<?= base_url() . 'assets/moment/min/moment.min.js'; ?>" type="text/javascript"></script>

<!--  datetime Picker -->
<script src="<?= base_url() . 'assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'; ?>"
        type="text/javascript"></script>

<!--  Notifications Plugin    -->
<script src="<?= base_url() . 'assets/js/bootstrap-notify.js'; ?>" type="text/javascript"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="<?= base_url() . 'assets/js/paper-dashboard.js'; ?>" type="text/javascript"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="<?= base_url() . 'assets/js/demo.js'; ?>" type="text/javascript"></script>
<script src="<?= base_url() . 'assets/js/apps.js'; ?>" type="text/javascript"></script>

</body>

</html>