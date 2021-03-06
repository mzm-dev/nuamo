<?= doctype('html5'); ?>
<html lang="en">
<head>
    <?= link_tag('assets/img/apple-icon.png', 'apple-touch-icon'); ?>
    <?= link_tag('assets/img/favicon.png', 'shortcut icon', 'image/png'); ?>
    <?php
    $meta = array(
        array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge,chrome=1'),
        array('name' => 'viewport','content' => 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'),
        array('name' => 'robots','content' => 'no-cache'),
        array('name' => 'Content-type','content' => 'text/html; charset=utf-8', 'type' => 'equiv')
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
<!--    --><?//= link_tag('assets/css/paper-dashboard.css'); ?>
    <?= link_tag('assets/css/paper-dashboard.css'); ?>

    <!--  Fonts and icons     -->
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <?= link_tag('assets/font-awesome/css/font-awesome.min.css'); ?>
    <?= link_tag('assets/css/themify-icons.css'); ?>
    <script type="text/javascript">
        var site_url='<?= base_url(); ?>';
    </script>
</head>
<body>
<div class="wrapper">
    <?php $this->load->view('layouts/elements/sidebar'); ?>
    <div class="main-panel">
        <?php $this->load->view('layouts/elements/nav-bar'); ?>
        <div class="content">
            <div class="container-fluid">
                <?php
                $message = $this->session->flashdata('item');
                echo (!empty($message) ? '<div class="alert alert-' . $message['class'] . '" role="alert" id="infoMessage"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><span>' . $message['message'] . '</span></div>' : '');
                ?>
                <?php //echo $authUser['username'] ?>
                <?php $this->load->view($main); ?>
            </div>
            <!-- /#content -->
        </div>
        <!-- /#container-fluid -->
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="http://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="http://www.creative-tim.com/license">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; <?php echo date('Y') ?>,
                    Page rendered in <strong>{elapsed_time}</strong> seconds
                    , <?php echo (ENVIRONMENT === 'development') ? 'CI Ver. <strong>' . CI_VERSION . '</strong>' : '' ?></a>
                </div>
            </div>
        </footer>
    </div>
    <!-- /#main-panel -->
</div>
<!-- /#wrapper -->
<!--   Core JS Files   -->
<script src="<?= base_url() . 'assets/js/jquery-1.10.2.js'; ?>" type="text/javascript"></script>
<script src="<?= base_url() . 'assets/js/bootstrap.min.js'; ?>" type="text/javascript"></script>

<!--  Moment -->
<script src="<?= base_url() . 'assets/moment/min/moment.min.js'; ?>" type="text/javascript"></script>

<!--  datetime Picker -->
<script src="<?= base_url() . 'assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'; ?>" type="text/javascript"></script>

<!--  Notifications Plugin    -->
<script src="<?= base_url() . 'assets/js/bootstrap-notify.js'; ?>" type="text/javascript"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="<?= base_url() . 'assets/js/paper-dashboard.js'; ?>" type="text/javascript"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="<?= base_url() . 'assets/js/demo.js'; ?>" type="text/javascript"></script>
<script src="<?= base_url() . 'assets/js/apps.js'; ?>" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
        //demo.initChartist();
    });
</script>
</body>

</html>