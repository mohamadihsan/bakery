<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-cubes cubes-icon"></i>
                    <a href="./">Produk</a>
                </li>
                <li class="active">Faktur Pembelian</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="well">

                        <?php
                        // retrieve data dari API
                        $file = file_get_contents($url_api."tampilkan_data_detail_pemesanan_produk.php?nomor_faktur=".$_GET['id']);
                        $json = json_decode($file, true);


                        $nomor_faktur       = $json['data'][0]['nomor_faktur'];
                        $id_pelanggan       = $json['data'][0]['id_pelanggan'];
                        $id_pegawai         = $json['data'][0]['id_pegawai'];
                        $status_pemesanan   = $json['data'][0]['status_pemesanan'];
                        $status_pembayaran  = $json['data'][0]['status_pembayaran'];
                        $tanggal_pemesanan  = $json['data'][0]['tanggal_pemesanan'];
                        $tanggal_pembayaran = $json['data'][0]['tanggal_pembayaran'];
                        $nama_pelanggan     = $json['data'][0]['nama_pelanggan'];
                        $alamat             = $json['data'][0]['alamat'];
                        $no_telp            = $json['data'][0]['no_telp'];
                        $email              = $json['data'][0]['email'];
                        $jumlahRecord       = $json['jumlahRecord'];

                        ?>

                        <div class="space-6"></div>

                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="widget-box transparent">
                                    <div class="widget-header widget-header-large">
                                        <h3 class="widget-title grey lighter">
                                            <i class="ace-icon fa fa-leaf green"></i>
                                            Detail Pemesanan
                                        </h3>

                                        <div class="widget-toolbar no-border invoice-info">
                                            <span class="invoice-info-label">No Faktur:</span>
                                            <span class="red"><?= $nomor_faktur ?></span>

                                            <br />
                                            <span class="invoice-info-label">Tanggal:</span>
                                            <span class="blue"><?= $tanggal_pemesanan ?></span>
                                        </div>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main padding-24">
                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
                                                            <b>Informasi Pelanggan & Alamat Pengiriman</b>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <ul class="list-unstyled  spaced">
                                                            <li>
                                                                <i class="ace-icon fa fa-caret-right green"></i>Pelanggan : <?= $id_pelanggan.' - '.$nama_pelanggan ?>
                                                            </li>

                                                            <li>
                                                                <i class="ace-icon fa fa-caret-right green"></i>Alamat : <?= $alamat ?>
                                                            </li>

                                                            <li>
                                                                <i class="ace-icon fa fa-caret-right green"></i>No Telp : <?= $no_telp ?>
                                                            </li>

                                                            <li class="divider"></li>

                                                            <li>
                                                                <i class="ace-icon fa fa-file-text-o green"></i>Detail Pemesanan
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div><!-- /.col -->
                                            </div><!-- /.row -->

                                            <div>

                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">#</th>
                                                            <th width="40%">Produk</th>
                                                            <th class="hidden-xs">Jumlah</th>
                                                            <th class="hidden-480">Harga</th>
                                                            <th>Sub Total</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $sub_total = 0;
                                                        $total = 0;
                                                        for ($i=0; $i < $jumlahRecord; $i++) {

                                                          $no                 = $json['data'][$i]['no'];
                                                          $jumlah_pemesanan   = $json['data'][$i]['jumlah_pemesanan'];
                                                          $id_produk          = $json['data'][$i]['id_produk'];
                                                          $nama_produk        = $json['data'][$i]['nama_produk'];
                                                          $harga_produk       = $json['data'][$i]['harga_produk'];

                                                            $sub_total = $harga_produk * $jumlah_pemesanan;
                                                            $total = $total + $sub_total;
                                                            ?>
                                                            <tr>
                                                                <td class="center">
                                                                    <?= $no++ ?>
                                                                </td>

                                                                <td>
                                                                    <a href="#"><?= $nama_produk ?></a>
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?= $jumlah_pemesanan ?> bal
                                                                </td>
                                                                <td class="hidden-480">
                                                                    <?= 'Rp.'.Rupiah($harga_produk) ?></td>
                                                                <td>
                                                                    <?= 'Rp.'.Rupiah($sub_total) ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="hr hr8 hr-double hr-dotted"></div>

                                            <div class="row">
                                                <div class="col-sm-5 pull-right">
                                                    <h4 class="pull-right">
                                                        Total Pemesanan :
                                                        <span class="red"><?= 'Rp.'.Rupiah($total) ?></span>
                                                    </h4>
                                                </div>
                                            </div>

                                            <div class="space-6"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
