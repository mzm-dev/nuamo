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
</head>
<body onload="window.print();">
<!--<body>-->

    <?php //echo $authUser['username'] ?>
    <?php $this->load->view($main); ?>

<!-- /#wrapper -->
<!--   Core JS Files   -->
<script src="<?= base_url() . 'assets/js/jquery-1.10.2.js'; ?>" type="text/javascript"></script>
<script src="<?= base_url() . 'assets/js/bootstrap.min.js'; ?>" type="text/javascript"></script>

</body>

</html>