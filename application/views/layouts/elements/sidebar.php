<!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->
<?php
$controller = $this->uri->segment(1);
$action = $this->uri->segment(2);
?>
<div class="sidebar" data-background-color="white" data-active-color="danger">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="<?= base_url() ?>" class="simple-text">
                <img src="<?= base_url() . 'assets/img/apple-icon.png'; ?>" width="40" alt="Logo"/> NUAMO
            </a>
        </div>

        <ul class="nav">
            <li class="<?= (!$controller && !$action ? 'active' : '') ?>">
                <a href="<?= base_url(); ?>">
                    <i class="ti-panel"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <!-- Menu Keahlian-->
            <?php $memberController = array("members");
            $memberAction = array(null, "index", "add", "edit", "view","newer","in_active"); ?>
            <?php $class = ((in_array($controller, $memberController)) && (in_array($action, $memberAction)) ? 'active' : ''); ?>
            <li class="<?= $class ?>">
                <a data-toggle="collapse" href="#members" aria-expanded="<?= ($class == 'active' ? 'true' : 'false') ?>">
                    <i class="ti-user"></i>
                    <p>Ahli<b class="caret"></b></p>
                </a>
                <div class="collapse <?= ($class == 'active' ? 'in' : '') ?>" id="members">
                    <ul class="nav">
                        <li><a href="<?= base_url("members/newer"); ?>">Senarai Permohonan</a></li>
                        <li><a href="<?= base_url("members/add"); ?>">Daftar Ahli</a></li>
                        <li><a href="<?= base_url("members/"); ?>">Senarai Ahli</a></li>
                        <li><a href="<?= base_url("members/in_active"); ?>">Senarai Ahli Luput</a></li>
                    </ul>
                </div>
            </li>
            <!-- ./Menu Keahlian-->

            <!-- Menu Bantuan-->
            <?php $memberController = array("claims","funds");
            $memberAction = array(null, "index", "add", "edit", "view"); ?>
            <?php $class = ((in_array($controller, $memberController)) && (in_array($action, $memberAction)) ? 'active' : ''); ?>
            <li class="<?= $class ?>">
                <a data-toggle="collapse" href="#funds" aria-expanded="<?= ($class == 'active' ? 'true' : 'false') ?>">
                    <i class="ti-gift"></i>
                    <p>Tabung Bantuan <b class="caret"></b></p>
                </a>
                <div class="collapse <?= ($class == 'active' ? 'in' : '') ?>" id="funds">
                    <ul class="nav">
                        <li><a href="<?= base_url("funds/"); ?>">Jenis Tututan</a></li>
                        <li><a href="<?= base_url("claims/"); ?>">Senarai Permohonan</a></li>
                    </ul>
                </div>
            </li>
            <!-- ./Menu Bantuan-->

            <!-- Menu Admin-->
            <?php $adminController = array("admins");
            $adminAction = array(null, "index", "add", "edit", "view"); ?>
            <?php $class = ((in_array($controller, $adminController)) && (in_array($action, $adminAction)) ? 'active' : ''); ?>
            <li class="<?= $class ?>">
                <a data-toggle="collapse" href="#admins" aria-expanded="<?= ($class == 'active' ? 'true' : 'false') ?>">
                    <i class="ti-settings"></i>
                    <p>Pentadbiran <b class="caret"></b></p>
                </a>
                <div class="collapse <?= ($class == 'active' ? 'in' : '') ?>" id="admins">
                    <ul class="nav">
                        <li><a href="<?= base_url("users/"); ?>">Senarai Pengguna</a></li>
                        <li><a href="<?= base_url("users/add"); ?>">Daftar Pengguna</a></li>
                    </ul>
                </div>
            </li>
            <!-- ./Menu Admin-->
        </ul>

    </div>
</div>