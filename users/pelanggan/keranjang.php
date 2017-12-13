<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-cubes cubes-icon"></i>
                    <a href="./">Produk</a>
                </li>
                <li class="active">keranjang belanja</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Keranjang Belanja
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Riki Bakery Produk
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <!-- Keranjang Belanja -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php
                    if (!isset($_GET['data'])) { ?>

                        <div class="well">
                            <form action="./index.php?menu=keranjang&data=konfirmasi" method="post" class="">
                                <table class="table table-renponsive">
                                    <caption>KERANJANG BELANJA :</caption>

                                    <?php
                                    if (isset($_SESSION['id_produk']) AND count($_SESSION['id_produk']) != 0) { ?>

                                      <tr>
                                          <td>Nama Produk</td>
                                          <td width="15%">Qty (/bal)</td>
                                          <td width="15%">Harga (/bal)</td>
                                          <!-- <td width="20%">Sub Total</td> -->
                                          <td width="5%"></td>
                                      </tr>
                                      <?php
                                      // buka koneksi
                                      require_once 'config/connection.php';

                                      for ($i=0; $i < count($_SESSION['id_produk']); $i++){

                                          $id[$i] = $_SESSION['id_produk'][$i];

                                          // retrieve data produk
                                          $sql = "SELECT id_produk, nama_produk, harga FROM produk WHERE id_produk = '$id[$i]'";
                                          $result = mysqli_query($conn, $sql);
                                          $row = mysqli_fetch_assoc($result);
                                          $id_produk[$i] = $row['id_produk'];
                                          $nama_produk[$i] = $row['nama_produk'];
                                          $harga[$i] = $row['harga'] * 10;
                                          ?>

                                          <tr>
                                              <td>
                                                  <input type="text" name="id_produk[]" value="<?= $id_produk[$i]; ?>" class="" placeholder="" hidden>
                                                  <input type="text" name="nama_produk[]" value="<?= $nama_produk[$i]; ?>" class="form-control" placeholder="" readonly>
                                              </td>
                                              <td><input type="number" name="jumlah_pemesanan[]" value="1" class="form-control" placeholder="" min="1" autofocus></td>
                                              <td>
                                                  <input type="number" name="harga[]" value="<?= $harga[$i] ?>" class="" placeholder="" min="0"  hidden>
                                                  <input type="text" value="<?= 'Rp.'.Rupiah($harga[$i]) ?>" class="form-control" placeholder="" min="0" readonly>
                                              </td>
                                              <!-- <td><input type="number" name="subtotal[]" id="subtotal[<?= $i ?>]" class="form-control" placeholder="" min="0" readonly></td> -->
                                              <td class="text-center"><a href="action/hapus_produk_di_keranjang.php?id=<?= $id_produk[$i]; ?>" title="hapus"><i class="fa fa-trash text-danger"></i></a></td>
                                          </tr>
                                          <?php
                                      }
                                    }else{ ?>
                                      <tr>
                                        <td colspan="5" class="text-danger">keranjang belanja masih kosong <a href="./">Pesan Produk</a> </td>
                                      </tr>
                                      <?php
                                    }
                                    ?>
                                    <tr>
                                        <td><a href="./" class="btn btn-sm btn-default"><i class="fa fa-plus"></i> Tambahkan pemesanan</a></td>
                                        <td colspan="2" class="text-right">
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class=""></i> Selesai & Lanjutkan
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>

                        <?php
                    }else{ ?>

                      <div class="well">

                          <?php
                          // retrieve data dari API
                          $file = file_get_contents($url_api."tampilkan_data_pelanggan.php?id=".$_SESSION['id_pelanggan']);
                          $json = json_decode($file, true);
                          $id_pelanggan   = $json['data'][0]['id_pelanggan'];
                          $nama_pelanggan = $json['data'][0]['nama_pelanggan'];
                          $alamat         = $json['data'][0]['alamat'];
                          $no_telp        = $json['data'][0]['no_telp'];
                          $email          = $json['data'][0]['email'];
                          ?>

                          <form action="./action/checkout.php" method="post" class="">
                              <div class="space-6"></div>

                              <div class="row">
                                  <div class="col-sm-10 col-sm-offset-1">
                                      <div class="widget-box transparent">
                                          <div class="widget-header widget-header-large">
                                              <h3 class="widget-title grey lighter">
                                                  <i class="ace-icon fa fa-leaf green"></i>
                                                  Detail Pembelian
                                              </h3>

                                              <div class="widget-toolbar no-border invoice-info">

                                                  <br />
                                                  <span class="invoice-info-label">Tanggal:</span>
                                                  <span class="blue"><?= date('d/m/Y') ?></span>
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
                                                                      <i class="ace-icon fa fa-file-text-o green"></i>Detail Pembelian
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
                                                              $total = 0;
                                                              $sub_total = 0;
                                                              for ($i=0; $i < count($_POST['id_produk']); $i++) {

                                                                  $sub_total = $_POST['harga'][$i] * $_POST['jumlah_pemesanan'][$i];
                                                                  $total = $total + $sub_total;
                                                                  ?>
                                                                  <tr>
                                                                      <td class="center">
                                                                          <?= $no++ ?>
                                                                          <input type="text" name="id_pelanggan" value="<?= $id_pelanggan ?>" hidden required>
                                                                      </td>

                                                                      <td>
                                                                          <a href="#"><?= $_POST['nama_produk'][$i] ?></a>
                                                                          <input type="text" name="id_produk[]" value="<?= $_POST['id_produk'][$i] ?>" hidden required>
                                                                      </td>
                                                                      <td class="hidden-xs">
                                                                          <?= $_POST['jumlah_pemesanan'][$i] ?> bal
                                                                          <input type="text" name="jumlah_pemesanan[]" value="<?= $_POST['jumlah_pemesanan'][$i] * 10 ?>" hidden required>
                                                                      </td>
                                                                      <td class="hidden-480">
                                                                          <?= 'Rp.'.Rupiah($_POST['harga'][$i]) ?>
                                                                          <input type="text" name="harga_produk[]" value="<?= $_POST['harga'][$i] / 10 ?>" hidden required>
                                                                      </td>
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
                                                              Total Pembelian :
                                                              <span class="red"><?= 'Rp.'.Rupiah($total) ?></span>
                                                          </h4>
                                                      </div>
                                                      <div class="col-sm-7 pull-left"> Informasi Tambahan </div>
                                                  </div>

                                                  <div class="space-6"></div>
                                                  <div class="well">
                                                      Terima kasih telah memesan produk di toko kami.
                                                  </div>
                                                  <div class="text-right">
                                                      <button type="submit" class="btn btn-sm btn-primary">
                                                          <i class="fa fa-money"></i> Checkout
                                                      </button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </form>
                      </div>
                      <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
