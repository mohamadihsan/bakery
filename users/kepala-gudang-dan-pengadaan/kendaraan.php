<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="./">Beranda</a>
                </li>
                <li class="active">Kendaraan</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Kendaraan
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Pengolahan Data
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <button data-toggle="collapse" data-target=".tampil" class="btn btn-sm"><i class="ace-icon fa fa-plus bigger-110"></i> Form</button>

                    <div id="" class="collapse tampil">
                        <div class="well">
                            <form action="../action/kendaraan.php" method="post" class="myform">

                                <!-- hidden status hapus false -->
                                <input type="hidden" name="hapus" value="0" class="form-control" placeholder="" readonly>
                                <input type="text" name="plat_nomor_kendaraan_lama" value="" class="" placeholder="" readonly hidden="">

                                <table class="table table-renponsive">
                                    <caption>Masukkan Data Kendaraan :</caption>
                                    <tr>
                                        <td width="15%">Plat Nomor</td>
                                        <td><input type="text" name="plat_nomor_kendaraan" value="" class="form-control" placeholder=""></td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Jenis Kendaraan</td>
                                        <td>
                                            <select class="form-control" name="jenis_kendaraan">
                                                <option value="Mobil">Mobil</option>
                                                <option value="Motor">Motor</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Nama Kendaraan</td>
                                        <td><input type="text" name="nama_kendaraan" value="" class="form-control" placeholder="" required></td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Kapasitas</td>
                                        <td><input type="number" name="kapasitas" value="" class="form-control" placeholder="" required></td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Tujuan</td>
                                        <td><input type="text" name="tujuan" value="" class="form-control" placeholder="" required></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-save bigger-120"></i> Simpan</button>
                                                <button type="reset" class="btn btn-sm btn-default"><i class="ace-icon fa fa-refresh bigger-120"></i> Reset</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>

                    <!-- loading -->
                    <center><div id="loading"></div></center>
                    <div id="result"></div>

                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header">
                        Daftar data "Kendaraan"
                    </div>
                    <!-- div.table-responsive -->

                    <!-- div.dataTables_borderWrap -->
                    <div class="table table-responsive">
                        <table id="mytable" class="display" width="100%" cellspacing="0">
                            <thead>
                                <tr class="">
                                    <th width="7%" class="text-center">No</th>
                                    <th width="15%" class="text-left">Plat Nomor</th>
                                    <th width="15%" class="text-left">Jenis</th>
                                    <th width="15%" class="text-left">Nama</th>
                                    <th width="15%" class="text-left">Kapasitas (buah)</th>
                                    <th width="15%" class="text-center">Tujuan</th>
                                    <th width="20%" class="text-center"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!-- Modal Hapus -->
<div class="modal fade" id="hapus" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Data</h4>
            </div>
            <form method="post" action="../action/kendaraan.php" class="myform">
                <div class="modal-body">
                    <input type="hidden" name="hapus" value="1" readonly>
                    <input type="hidden" name="plat_nomor_kendaraan" readonly>
                    <input type="hidden" name="plat_nomor_kendaraan_lama" readonly>
                    <p>Apakah anda akan menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function ubah(plat_nomor_kendaraan_lama, plat_nomor_kendaraan, jenis_kendaraan, nama_kendaraan, kapasitas, tujuan){
        $('.well input[name=plat_nomor_kendaraan_lama]').val(plat_nomor_kendaraan_lama);
        $('.well input[name=plat_nomor_kendaraan]').val(plat_nomor_kendaraan);
        $('.well select[name=jenis_kendaraan]').val(jenis_kendaraan);
        $('.well input[name=nama_kendaraan]').val(nama_kendaraan);
        $('.well input[name=kapasitas]').val(kapasitas);
        $('.well input[name=tujuan]').val(tujuan);
    }

    function hapus(plat_nomor_kendaraan){
        $('.modal-body input[name=plat_nomor_kendaraan]').val(plat_nomor_kendaraan);
    }

    // LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA
    $(document).ready(function(){

        $('#mytable').DataTable({
                    "bProcessing": true,
                    "sAjaxSource": "<?php echo $base_url.'action/tampilkan_data_kendaraan.php' ?>",
                    "deferRender": true,
                    "select": true,
                    //"dom": 'Bfrtip',
                    //"scrollY": "300",
                    //"order": [[ 4, "desc" ]],
                     "aoColumns": [
                            { mData: 'no' } ,
                            { mData: 'plat_nomor_kendaraan' } ,
                            { mData: 'jenis_kendaraan' } ,
                            { mData: 'nama_kendaraan' } ,
                            { mData: 'kapasitas' },
                            { mData: 'tujuan' },
                            { mData: 'action'}
                    ],
                    "aoColumnDefs": [
                        { sClass: "dt-center", "aTargets": [0,3,4,5] },
                        { sClass: "dt-nowrap", "aTargets": [0,1,2] }
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
                    $("#hapus").modal('hide');
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
