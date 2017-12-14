<?php
// buka koneksi
require_once '../config/connection.php';


$peramalan      = $_GET['peramalan'];
if($peramalan=='true'){

    $periode      = $_GET['periode'];

    // jumlah peramalan
    $sql = "SELECT id_produk, hasil_peramalan
            FROM peramalan
            WHERE DATE_FORMAT(periode,'%m-%Y') = '$periode'";
    $result = mysqli_query($conn, $sql);
    $data = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $sub_array['id_produk']         = $row['id_produk'];
            $sub_array['hasil_peramalan']   = $row['hasil_peramalan'];

            $data[] = $sub_array;
        }
    }else{
        $sub_array['id_produk']       = 0;
        $sub_array['hasil_peramalan'] = 0;

        $data[] = $sub_array;
    }

    $results = array(
        "sEcho" => 1,
            "jumlahRecord" => count($data),
            "jumlahRecordDitampilkan" => count($data),
            "data"=>$data);

    echo json_encode($results);

} ?>
