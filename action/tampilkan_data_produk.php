<?php
// buka koneksi
require_once '../config/connection.php';

function Rupiah($rupiah) {
    //format rupiah
    $jumlah_desimal = "0";
    $pemisah_desimal = ",";
    $pemisah_ribuan = ".";

    $hasil = number_format($rupiah, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
    return 'Rp.'.($hasil);
}

$id_produk = isset($_GET['id']) ? $_GET['id']: '';

if ($id_produk=='') {
  // sql statement
  $sql = "SELECT id_produk, nama_produk, jenis_produk, kemasan, harga, gambar_produk, stok_produk
          FROM produk
          ORDER BY id_produk ASC";
}else{
  // sql statement
  $sql = "SELECT id_produk, nama_produk, jenis_produk, kemasan, harga, gambar_produk, stok_produk
          FROM produk
          WHERE id_produk = '$id_produk'";
}

$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']            = $no++;
    $sub_array['id_produk']     = $row['id_produk'];
    $sub_array['nama_produk']   = $row['nama_produk'];
    $sub_array['jenis_produk']  = $row['jenis_produk'];
    $sub_array['kemasan']       = $row['kemasan'];
    $sub_array['harga']         = Rupiah($row['harga']);
    $sub_array['harga_non_format']     = $row['harga'];
    $sub_array['stok_produk']          = $row['stok_produk'].' buah';
    $sub_array['gambar_produk'] = '<img src="../assets/images/'.$row['gambar_produk'].'" alt="produk" class="img-responsive" width="80px" height="80px" >';
    $sub_array['nama_file_gambar'] = $row['gambar_produk'];
	  $sub_array['action']	    = ' <button type="button" class="btn btn-warning btn-xs" data-toggle="collapse" data-target=".tampil" onclick="return ubah(\''.$row['id_produk'].'\',\''.$row['nama_produk'].'\',\''.$row['jenis_produk'].'\',\''.$row['kemasan'].'\',\''.$row['harga'].'\')"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i> Ubah</button>
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" onclick="return hapus(\''.$row['id_produk'].'\')"><i class="ace-icon fa fa-trash-o bigger-120"></i> Hapus</button>';
    $sub_array['komposisi']	    = ' <a class="btn btn-warning btn-xs" href="./index.php?id='.$row['id_produk'].'&menu=detail_komposisi"><i class="ace-icon fa fa-file-text-o bigger-120"></i> Komposisi</a>
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" onclick="return hapus(\''.$row['id_produk'].'\')"><i class="ace-icon fa fa-trash-o bigger-120"></i> Hapus</button>';
    $sub_array['update_stok']	    = ' <button type="button" class="btn btn-warning btn-xs" data-toggle="collapse" data-target=".tampil" onclick="return ubah(\''.$row['id_produk'].'\',\''.$row['nama_produk'].'\',\''.$row['jenis_produk'].'\',\''.$row['kemasan'].'\',\''.$row['harga'].'\',\''.$row['stok_produk'].'\')"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i> Ubah Stok</button>';

    $data[] = $sub_array;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
