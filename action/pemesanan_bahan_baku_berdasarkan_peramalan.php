<?php
// buka koneksi
require_once '../config/connection.php';


$peramalan      = $_GET['peramalan'];
if($peramalan=='true'){

    $periode      = $_GET['periode'];

    // jumlah peramalan
    $sql = "SELECT
            	y.id_bahan_baku,
            	y.nama_bahan_baku,
                y.satuan,
            	SUM(y.jml) AS hasil_peramalan
            FROM
            	(
            		SELECT
            			x.id_bahan_baku,
            			x.nama_bahan_baku,
                        x.satuan,
            			(
            				x.hasil_peramalan * x.takaran
            			) AS jml
            		FROM
            			(
            				SELECT
            					p.id_produk,
            					p.hasil_peramalan,
            					k.takaran,
            					k.id_bahan_baku,
            					b.nama_bahan_baku,
                                b.satuan
            				FROM
            					peramalan p
            				LEFT JOIN komposisi k ON k.id_produk = p.id_peramalan
            				LEFT JOIN bahan_baku b ON b.id_bahan_baku = k.id_bahan_baku
            				WHERE
            					DATE_FORMAT(periode,'%m-%Y') = '$periode'
            				ORDER BY
            					k.id_bahan_baku
            			) AS x
            	) AS y
            GROUP BY
            	1";
    $result = mysqli_query($conn, $sql);
    $data = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $sub_array['id_bahan_baku']         = $row['id_bahan_baku'];
            $sub_array['nama_bahan_baku']       = $row['nama_bahan_baku'];
            $sub_array['satuan']                = $row['satuan'];
            $sub_array['hasil_peramalan']       = $row['hasil_peramalan'];

            $data[] = $sub_array;
        }
    }else{
        $sub_array['id_bahan_baku']     = '';
        $sub_array['nama_bahan_baku']   = '';
        $sub_array['satuan']            = '';
        $sub_array['hasil_peramalan']   = 0;

        $data[] = $sub_array;
    }

    $results = array(
        "sEcho" => 1,
            "jumlahRecord" => count($data),
            "jumlahRecordDitampilkan" => count($data),
            "data"=>$data);

    echo json_encode($results);

} ?>
