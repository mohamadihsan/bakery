<?php
// buka koneksi
require_once '../config/connection.php';

function Tanggal($tanggal) {
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $tahun = substr($tanggal, 0, 4);
    $bulan = substr($tanggal, 5, 2);
    $tgl = substr($tanggal, 8, 2);

    $hasil = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
    return ($hasil);
}

$id_distribusi = isset($_GET['id']) ? $_GET['id']: '';
$id_distribusi = trim($id_distribusi);

// sql statement
if($id_distribusi==''){
    $sql = "SELECT id_distribusi, nomor_faktur, plat_nomor_kendaraan, tanggal_pengiriman, status_pengiriman
            FROM distribusi
            ORDER BY tanggal_pengiriman DESC";
}else{
    $sql = "SELECT id_distribusi, nomor_faktur, plat_nomor_kendaraan, tanggal_pengiriman, status_pengiriman
    FROM distribusi
    WHERE id_distribusi = '$id_distribusi'
    ORDER BY tanggal_pengiriman DESC";
}
$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']                    = $no++;
    $sub_array['id_distribusi']         = $row['id_distribusi'];
    $sub_array['nomor_faktur']          = $row['nomor_faktur'];
    $sub_array['plat_nomor_kendaraan']  = $row['plat_nomor_kendaraan'];
    $sub_array['tanggal_pengiriman']    = $row['tanggal_pengiriman'];
    $sub_array['status_pengiriman']     = $row['status_pengiriman'];
    $sub_array['action']	              = ' <a href="./index.php?menu=pemesanan&faktur='.$row['nomor_faktur'].'" class="btn btn-warning btn-xs"><i class="ace-icon fa fa-file-text-o bigger-120"></i> Detail</button>';

    // ubah tampilan data

    if ($sub_array['status_pengiriman'] == 0) {
        $sub_array['status_pengiriman'] = '<span class="label label-warning label-white middle">
                                                <i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>
                                                belum diterima
                                            </span>';
    }else{
        $sub_array['status_pengiriman'] = '<span class="label label-success label-white middle">
                                                <i class="ace-icon fa fa-check-square bigger-120"></i>
                                                sudah diterima
                                            </span>';
    }

    if ($sub_array['tanggal_pengiriman'] != NULL) {
        $sub_array['tanggal_pengiriman'] = Tanggal($sub_array['tanggal_pengiriman']);
    }

    $data[] = $sub_array;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
