<?php
// buka koneksi
require_once '../config/connection.php';

// sql statement
// $sql = "SELECT
//         	k.id_bahan_baku,
//         	bb.satuan,
//         	bb.nama_bahan_baku,
//             bb.stok,
//         	SUM(takaran) as takaran
//         FROM
//         	komposisi k
//         LEFT JOIN
//         	bahan_baku bb ON k.id_bahan_baku=bb.id_bahan_baku
//         WHERE k.id_produk IN ()
//         GROUP BY
//         	k.id_bahan_baku";
$sql = "SELECT
        	*
        FROM
        	(
        		SELECT
        			k.id_bahan_baku,
        			bb.satuan,
        			bb.nama_bahan_baku,
        			bb.stok,
        			SUM(takaran) AS takaran
        		FROM
        			komposisi k
        		LEFT JOIN bahan_baku bb ON k.id_bahan_baku = bb.id_bahan_baku
        		WHERE
        			k.id_produk IN (
        				SELECT
        					id_produk
        				FROM
        					peramalan
        				WHERE
        					DATE_FORMAT(periode, '%m-%Y') = '11-2017'
        			)
        		GROUP BY
        			k.id_bahan_baku
        	) AS tabel_komposisi,
        	(
        		SELECT
        			id_produk,
        			hasil_peramalan
        		FROM
        			peramalan
        		WHERE
        			DATE_FORMAT(periode, '%m-%Y') = '11-2017'
        	) AS tabel_peramalan"
$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']                = $no++;
    $sub_array['id_bahan_baku']     = $row['id_bahan_baku'];
    $sub_array['nama_bahan_baku']   = $row['nama_bahan_baku'];
    $sub_array['satuan']            = $row['satuan'];
    $sub_array['stok']              = $row['stok'];
    $sub_array['takaran']           = $row['takaran'];
    $sub_array['jumlah_beli']       = $row['stok'] - $row['takaran'];

    $data[] = $sub_array;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
