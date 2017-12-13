<?php
// buka koneksi
require_once '../config/connection.php';

// sql statement
$sql = "SELECT bk.id_barang_keluar, bk.id_bahan_baku, bk.jumlah, bk.tanggal, bb.nama_bahan_baku, bb.satuan
        FROM barang_keluar bk
        LEFT JOIN bahan_baku bb ON bb.id_bahan_baku=bk.id_bahan_baku
        ORDER BY bk.id_barang_keluar ASC";
$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']                = $no++;
    $sub_array['id_barang_keluar']  = $row['id_barang_keluar'];
    $sub_array['id_bahan_baku']     = $row['id_bahan_baku'];
    $sub_array['jumlah']            = $row['jumlah'].' '.$row['satuan'];
    $sub_array['tanggal']           = $row['tanggal'];
    $sub_array['nama_bahan_baku']   = $row['nama_bahan_baku'];
	$sub_array['action']		    = ' <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" onclick="return hapus(\''.$row['id_barang_keluar'].'\')"><i class="ace-icon fa fa-trash-o bigger-120"></i> Hapus</button>';

    $data[] = $sub_array;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
