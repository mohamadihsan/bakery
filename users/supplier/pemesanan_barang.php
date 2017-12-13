<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="./">Beranda</a>
                </li>
                <li class="active">Pemesanan Barang</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Pemesanan Barang
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Pengolahan Data
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <?php
                    if (isset($_GET['faktur'])) { ?>

                      <div class="well">

                          <?php
                          // retrieve data dari API
                          $file = file_get_contents($url_api."tampilkan_data_detail_pemesanan_bahan_baku.php?nomor_faktur=".$_GET['faktur']);
                          $json = json_decode($file, true);


                          $nomor_faktur       = $json['data'][0]['nomor_faktur'];
                          $id_supplier        = $json['data'][0]['id_supplier'];
                          $id_pegawai         = $json['data'][0]['id_pegawai'];
                          $status_pemesanan   = $json['data'][0]['status_pemesanan'];
                          $status_pembayaran  = $json['data'][0]['status_pembayaran'];
                          $tanggal_pemesanan  = $json['data'][0]['tanggal_pemesanan'];
                          $nama_supplier      = $json['data'][0]['nama_supplier'];
                          $alamat             = $json['data'][0]['alamat'];
                          $no_telp            = $json['data'][0]['no_telp'];
                          $email              = $json['data'][0]['email'];
                          $waktu_pengiriman   = $json['data'][0]['waktu_pengiriman'];
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
                                                              <b>Informasi Supplier</b>
                                                          </div>
                                                      </div>

                                                      <div>
                                                          <ul class="list-unstyled  spaced">
                                                              <li>
                                                                  <i class="ace-icon fa fa-caret-right green"></i>Supplier : <?= $id_supplier.' - '.$nama_supplier ?>
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
                                                              <th width="40%">Barang</th>
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
                                                          for ($i=0; $i < $jumlahRecord; $i++) {

                                                            $no                 = $json['data'][$i]['no'];
                                                            $jumlah_pemesanan   = $json['data'][$i]['jumlah_pemesanan'];
                                                            $id_bahan_baku      = $json['data'][$i]['id_bahan_baku'];
                                                            $nama_bahan_baku    = $json['data'][$i]['nama_bahan_baku'];
                                                            $harga_bahan_baku   = $json['data'][$i]['harga_bahan_baku'];
                                                            $satuan             = $json['data'][$i]['satuan'];

                                                              $sub_total = $harga_bahan_baku * $jumlah_pemesanan;
                                                              $total = $total + $sub_total;
                                                              ?>
                                                              <tr>
                                                                  <td class="center">
                                                                      <?= $no++ ?>
                                                                  </td>

                                                                  <td>
                                                                      <a href="#"><?= $nama_bahan_baku ?></a>
                                                                  </td>
                                                                  <td class="hidden-xs">
                                                                      <?= $jumlah_pemesanan.' '.$satuan ?>
                                                                  </td>
                                                                  <td class="hidden-480">
                                                                      <?= 'Rp.'.Rupiah($harga_bahan_baku) ?></td>
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
                      <?php
                    }else{
                    ?>

                        <div class="clearfix">
                            <div class="pull-right tableTools-container"></div>
                        </div>
                        <div class="table-header">
                            Daftar data "Pemesanan Barang"
                        </div>
                        <!-- div.table-responsive -->

                        <!-- div.dataTables_borderWrap -->
                        <div class="table table-responsive">
                            <table id="mytable" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="">
                                        <th width="5%" class="text-center">No</th>
                                        <th width="15%" class="text-left">Nomor Faktur</th>
                                        <th width="10%" class="text-left">Pemesan</th>
                                        <th width="12%" class="text-center">Status Pemesanan</th>
                                        <th width="15%" class="text-center">Tanggal</th>
                                        <th width="5%" class="text-center"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <?php
                    } ?>

                    <!-- loading -->
                    <center><div id="loading"></div></center>
                    <div id="result"></div>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!-- Modal Terima -->
<div class="modal fade" id="terima" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-check-square"></i> Konfirmasi Pengiriman</h4>
            </div>
            <form method="post" action="../action/pemesanan_bahan_baku.php" class="myform">
                <div class="modal-body">
                    <input type="hidden" name="hapus" value="1" readonly>
                    <input type="hidden" name="nomor_faktur" readonly>
                    <p>Konfirmasi barang pesanan telah siap dikirim?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check-square"></i> Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function detail(nomor_faktur){

    }

    function terima(nomor_faktur){
        $('.modal-body input[name=nomor_faktur]').val(nomor_faktur);
    }

    // LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA
    $(document).ready(function(){

        $('#mytable').DataTable({
                    "bProcessing": true,
                    "sAjaxSource": "<?php echo $base_url.'action/tampilkan_data_pemesanan_bahan_baku.php?id='.$_SESSION['id_supplier'] ?>",
                    "deferRender": true,
                    "select": true,
                    //"dom": 'Bfrtip',
                    //"scrollY": "300",
                    //"order": [[ 4, "desc" ]],
                     "aoColumns": [
                            { mData: 'no' } ,
                            { mData: 'nomor_faktur' } ,
                            { mData: 'id_pegawai' },
                            { mData: 'status_pemesanan' },
                            { mData: 'tanggal_pemesanan' },
                            { mData: 'action_diterima' }
                    ]
        });

        //Callback handler for form submit event
        $(".myform").submit(function(e)
        {

        var formObj = $(this);
        var formURL = formObj.attr("action");
        var formData = new FormData(this);
        $.ajax({
            url: formURL,
            type: 'POST',
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function (){
                       $("#loading").show(1000).html("<img src='../assets/images/loading.gif' height='100'>");
                       },
            success: function(data, textStatus, jqXHR){
                    $("#result").html(data);
                    $("#loading").hide();
                    $("#terima").modal('hide');
                    $('#mytable').DataTable().ajax.reload();
            },
                error: function(jqXHR, textStatus, errorThrown){
         }
        });
            e.preventDefault(); //Prevent Default action.
            e.unbind();
        });

    });
</script>
