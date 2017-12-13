<?php
// buka koneksi
require_once '../config/connection.php';

// sql statement
$sql = "SELECT plat_nomor_kendaraan, jenis_kendaraan, nama_kendaraan, kapasitas, tujuan
        FROM kendaraan
        ORDER BY plat_nomor_kendaraan ASC";
$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']                    = $no++;
    $sub_array['plat_nomor_kendaraan']  = $row['plat_nomor_kendaraan'];
    $sub_array['jenis_kendaraan']       = $row['jenis_kendaraan'];
    $sub_array['nama_kendaraan']        = $row['nama_kendaraan'];
    $sub_array['kapasitas']             = $row['kapasitas'];
    $sub_array['tujuan']                = $row['tujuan'];
	  $sub_array['action']		            = ' <button type="button" class="btn btn-warning btn-xs" data-toggle="collapse" data-target=".tampil" onclick="return ubah(\''.$row['plat_nomor_kendaraan'].'\',\''.$row['plat_nomor_kendaraan'].'\',\''.$row['jenis_kendaraan'].'\',\''.$row['nama_kendaraan'].'\',\''.$row['kapasitas'].'\',\''.$row['tujuan'].'\')"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i> Ubah</button>
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" onclick="return hapus(\''.$row['plat_nomor_kendaraan'].'\')"><i class="ace-icon fa fa-trash-o bigger-120"></i> Hapus</button>';

    $data[] = $sub_array;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
