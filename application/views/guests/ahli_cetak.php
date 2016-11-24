<style>
    .print-view {
        max-width: 900px;
        background-color: #ffffff;
        padding: 20px;
    }

    .print-view .header h5, .print-view .header p {
        font-weight: 700;
        color: #66615b;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
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
    .print-view p, table {
        color: #66615b;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
        font-size: 12px !important;
    }

    .print-view label {
        color: #808080;
        font-size: 14px;
        font-weight: 400;
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
    }

    .head-up {
        position: relative;
        right: 45%;
    }
</style>

<div class="print-view">
    <div class="row">
        <div class="col-md-12 header-meta">
            <p class="status">
                <small>Status Permohonan : <?= $member['status_name'] ?></small>
            </p>
            <p class="pull-right">
                <small>Tarikh Mohon : <?= date('d/m/Y', strtotime($member['created'])) ?></small>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="header col-md-12">
            <!--            <img src="-->
            <? //= base_url() . 'assets/img/logo.jpg'; ?><!--" width="120" alt="Logo" class="logo img-circle"/>-->
            <h5 class="text-center">
                KESATUAN KEBANGSAAN PENOLONG PEGAWAI PERUBATAN<br/>
                SEMENANJUNG MALAYSIA<br/>
                (NATIONAL UNION OF ASSSISSTANTS MEDICAL OFFICER WEST MALAYSIA)
            </h5>
            <p style="margin-bottom: 32px" class="text-center">Bilangan pendaftaran :248</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <table style="line-height: 2">
                    <tbody>
                    <tr>
                        <td width="80px">Nama</td>
                        <td width="5px">:</td>
                        <td width="250px"
                            style="border-bottom: 1px dotted #333; padding:0 10px"><?= $member['name'] ?></td>
                    </tr>
                    <tr>
                        <td width="80px">Tarikh</td>
                        <td width="5px">:</td>
                        <td width="250px"
                            style="border-bottom: 1px dotted #333; padding:0 10px"><?= ($member['date_register'] ? date("d-m-Y", strtotime($member['date_register'])) : '-') ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p><strong>SETIAUSAHA AGUNG</strong></p>
            <p>Kesatuan Kebangsaan Penolong Pegawai Perubatan Semenanjung Malaysia</p>
            <br/>
            <p><u><strong>Permohonan Menjadi Ahli Kesatuan kebangsaan Penolong Pegawai Perubatan Semenanjung
                        (NUAMO)</strong></u></p>
            <br/>
            <p>Adalah Saya Dengan Segala Hormatnya Adalah Seperti Berikut :</p>
            <style>
                .butiran {
                    counter-reset: foo;
                }

                .butiran li {
                    list-style-type: none;
                }

                .butiran li::before {
                    counter-increment: butiran;
                    content: "2." counter(butiran) " ";
                }
            </style>
            <table style="line-height: 2; margin-left:40px">
                <tbody>
                <tr>
                    <td>2.1</td>
                    <td style="padding:0 10px">Nama Penuh</td>
                    <td width="5px">:</td>
                    <td  width="400px" style="border-bottom: 1px dotted #333; padding:0 10px"><?= $member['name'] ?></td>
                </tr>
                <tr>
                    <td>2.2</td>
                    <td style="padding:0 10px">Umur</td>
                    <td width="5px">:</td>
                    <td  width="400px" style="border-bottom: 1px dotted #333; padding:0 10px"><?= $member['age'] ?></td>
                </tr>
                <tr>
                    <td>2.3</td>
                    <td style="padding:0 10px">No Kad Pengenalan</td>
                    <td width="5px">:</td>
                    <td  width="400px" style="border-bottom: 1px dotted #333; padding:0 10px"><?= $member['nric'] ?></td>
                </tr>
                <tr>
                    <td>2.4</td>
                    <td style="padding:0 10px">Tarikh Lahir</td>
                    <td width="5px">:</td>
                    <td width="250px"
                        style="border-bottom: 1px dotted #333; padding:0 10px"><?= $member['address'] ?></td>
                </tr>
                <tr>
                    <td>2.5</td>
                    <td style="padding:0 10px">Tarikh Lantikan Dalam Jawatan</td>
                    <td width="5px">:</td>
                    <td width="250px"
                        style="border-bottom: 1px dotted #333; padding:0 10px"><?= ($member['dop'] ? date("d-m-Y", strtotime($member['dop'])) : '-') ?></td>
                </tr>
                <tr>
                    <td>2.6</td>
                    <td style="padding:0 10px">Negeri Bertugas</td>
                    <td width="5px">:</td>
                    <td width="250px"
                        style="border-bottom: 1px dotted #333; padding:0 10px"><?= $member['states'] ?></td>
                </tr>
                <tr>
                    <td valign="top">2.7</td>
                    <td valign="top" style="padding:0 10px">Alamat Tempat Bertugas</td>
                    <td valign="top" width="5px">:</td>
                    <td width="250px"
                        style="border-bottom: 1px dotted #333; padding:0 10px"><?= $member['add_office'] ?></td>
                </tr>

                <tr>
                    <td valign="top">2.8</td>
                    <td valign="top" style="padding:0 10px">Alamat Rumah</td>
                    <td valign="top" width="5px">:</td>
                    <td width="250px"
                        style="border-bottom: 1px dotted #333; padding:0 10px"><?= $member['address'] ?><?= $member['address'] ?><?= $member['address'] ?><?= $member['address'] ?><?= $member['address'] ?></td>
                </tr>
                <tr class="no-print">
                    <td>2.9</td>
                    <td style="padding:0 10px">Email</td>
                    <td width="5px">:</td>
                    <td width="250px"
                        style="border-bottom: 1px dotted #333; padding:0 10px"><?= $member['email'] ?></td>
                </tr>
                <tr class="no-print">
                    <td>2.10</td>
                    <td style="padding:0 10px">No Telefon</td>
                    <td width="5px">:</td>
                    <td width="250px"
                        style="border-bottom: 1px dotted #333; padding:0 10px"><?= $member['phone'] ?></td>
                </tr>
                <tr class="no-print">
                    <td>2.11</td>
                    <td style="padding:0 10px">No Telefon Bimbit</td>
                    <td width="5px">:</td>
                    <td width="250px"
                        style="border-bottom: 1px dotted #333; padding:0 10px"><?= $member['telephone'] ?></td>
                </tr>
                </tbody>
            </table>
            <p style="margin: 20px 0">3. <span style="padding-left: 20px;">Saya Mengaku Akan Patuh Kepada Peraturan Serta Perlembagaan Kesatuan Dan Sebarang Pindaan Yang Akan Dibuat Padanya Dari Masa Ke Semasa</span>
            </p>
            <div class="row">
                <div class="col-xs-6">
                    <table style="line-height: 2">
                        <tbody>
                        <tr>
                            <td  width="400px" style="border-bottom: 1px dotted #333; padding:20px"></td>
                        </tr>
                        <tr>
                            <td class="text-center">Tandatangan Pemohon</td>
                        </tr>
                        <tr>
                            <td  width="400px" style="border-bottom: 1px dotted #333; padding:20px"></td>
                        </tr>
                        <tr>
                            <td class="text-center">Tandatangan Pencadang</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-6">
                    <table style="line-height: 2">
                        <tbody>
                        <tr>
                            <td  width="400px" style="padding:20px"></td>
                        </tr>
                        <tr>
                            <td class="text-center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td  width="400px" style="border-bottom: 1px dotted #333; padding:20px"></td>
                        </tr>
                        <tr>
                            <td class="text-center">Tandatangan Penyokong</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <table style="margin: 20px 0">
                <tbody>
                <tr>
                    <td width="50%">Yuran Masuk</td>
                    <td>RM 2.00</td>
                </tr>
                <tr>
                    <td width="50%">Yuran Bulanan</td>
                    <td>RM 7.00 (Melalui Potongan biro ANGKASA)</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-12">
            <p class="text-center"><strong>UNTUK KEGUNAAN PEJABAT</strong></p>
            <table style="line-height: 2">
                <tbody>
                <tr>
                    <td width="250px">Tarikh Borang Permohonan Diterima</td>
                    <td width="5px">:</td>
                    <td  width="400px" style="border-bottom: 1px dotted #333; padding:0 10px"></td>
                </tr>
                <tr>
                    <td width="250px">Tarikh Permohonan Diluluskan</td>
                    <td width="5px">:</td>
                    <td  width="400px" style="border-bottom: 1px dotted #333; padding:0 10px"></td>
                </tr>
                <tr>
                    <td width="250px">Permohonan Diberitahu Pada</td>
                    <td width="5px">:</td>
                    <td  width="400px" style="border-bottom: 1px dotted #333; padding:0 10px"></td>
                </tr>
                <tr>
                    <td width="250px">No.Resit Dan Tarikh Dikelurkan</td>
                    <td width="5px">:</td>
                    <td  width="400px" style="border-bottom: 1px dotted #333; padding:0 10px"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>