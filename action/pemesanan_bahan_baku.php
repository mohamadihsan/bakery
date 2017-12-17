<?php
error_reporting(0);
// buka koneksi
require_once '../config/connection.php';
session_start();

if(mysqli_escape_string($conn, trim($_POST['hapus']))=='1'){
    $nomor_faktur       = mysqli_escape_string($conn, trim($_POST['nomor_faktur']));
    $status_pemesanan   = 'DK';

    // perbaharui data
    $sql = "UPDATE pemesanan_bahan_baku
            SET status_pemesanan='$status_pemesanan'
            WHERE nomor_faktur='$nomor_faktur'";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Pemesanan telah diterima";
    }else{
        $pesan_gagal = "Gagal terhubung dengan server";
    }
}else{
    $nomor_faktur = '171217FAK00002P';
    $id_supplier  = $_POST['id_supplier'];
    $id_bahan_baku  = $_POST['id_bahan_baku'];
    $jumlah_pemesanan  = $_POST['jumlah_pemesanan'];
    $id_pegawai  = $_SESSION['id_pegawai'];
    $status_pemesanan = 'SP';
    $status_pembayaran = '1';

    for ($i=0; $i < count($id_supplier); $i++) {
        if ($id_supplier[$i] != '') {
            // insert data master pemesanan
            if ($id_supplier[$i] != $id_supplier[$i-1]) {
                $sql = "INSERT INTO pemesanan_bahan_baku(nomor_faktur, id_supplier, id_pegawai, status_pemesanan, status_pembayaran)
                        VALUES('$nomor_faktur','$id_supplier[$i]','$id_pegawai','$status_pemesanan','$status_pembayaran')";
                mysqli_query($conn, $sql);

                $sql = "SELECT nomor_faktur FROM pemesanan_bahan_baku ORDER BY nomor_faktur DESC LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $nomor_faktur = $row['nomor_faktur'];
            }

            // retirieve harga barang
            $sql = "SELECT harga FROM detail_supplier WHERE id_bahan_baku='$id_bahan_baku[$i]' AND id_supplier='$id_supplier[$i]'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result)>0) {
                $row = mysqli_fetch_assoc($result);
                $harga_bahan_baku[$i] = $row['harga'];
            }else{
                $harga_bahan_baku[$i] = 0;
            }

            // insert data detail pemesanan
            $sql = "INSERT INTO detail_pemesanan_bahan_baku(nomor_faktur, id_bahan_baku, jumlah_pemesanan, harga_bahan_baku)
                    VALUES('$nomor_faktur','$id_bahan_baku[$i]','$jumlah_pemesanan[$i]','$harga_bahan_baku[$i]')";
            if(mysqli_query($conn, $sql)){
                $pesan_berhasil = "Data berhasil disimpan";
            }else{
                $pesan_gagal = "Data gagal disimpan";
            }
        }else{
            $pesan_gagal = "Data gagal disimpan";
        }
    }

}

if (isset($pesan_berhasil)) {
    ?>
    <script type="text/javascript">
        $(function(){
            $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Sukses!',
                // (string | mandatory) the text inside the notification
                text: '<?= $pesan_berhasil ?>',
                // (string | optional) the image to display on the left
                image: '../assets/images/berhasil.png',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: ''
            });
        });
    </script>
    <?php
}else if(isset($pesan_gagal)){
    ?>
    <script type="text/javascript">
	    $(function(){
            $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Gagal!',
                // (string | mandatory) the text inside the notification
                text: '<?= $pesan_gagal ?>',
                // (string | optional) the image to display on the left
                image: '../assets/images/gagal.png',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: ''
	        });
        });
	</script>
    <?php
}
?>
