<?php
// buka koneksi
require_once '../config/connection.php';

$plat_nomor_kendaraan         = strtoupper(mysqli_escape_string($conn, trim($_POST['plat_nomor_kendaraan'])));
$plat_nomor_kendaraan_lama    = strtoupper($_POST['plat_nomor_kendaraan_lama']);
if(mysqli_escape_string($conn, trim($_POST['hapus']))=='0'){
    $jenis_kendaraan   = mysqli_escape_string($conn, trim($_POST['jenis_kendaraan']));
    $nama_kendaraan    = mysqli_escape_string($conn, trim($_POST['nama_kendaraan']));
    $kapasitas         = mysqli_escape_string($conn, trim($_POST['kapasitas']));
    $tujuan            = mysqli_escape_string($conn, trim($_POST['tujuan']));
}

if ($plat_nomor_kendaraan_lama=='' AND empty(mysqli_escape_string($conn, trim($_POST['hapus'])))) {

    // simpan data
    $sql = "INSERT INTO kendaraan (plat_nomor_kendaraan, jenis_kendaraan, nama_kendaraan, kapasitas, tujuan)
            VALUES ('$plat_nomor_kendaraan', '$jenis_kendaraan', '$nama_kendaraan', '$kapasitas', '$tujuan')";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil disimpan";
    }else{
        $pesan_gagal = "Data gagal disimpan";
    }
}else if($plat_nomor_kendaraan_lama!='' AND empty(mysqli_escape_string($conn, trim($_POST['hapus'])))){
    // perbaharui data
    $sql = "UPDATE kendaraan
            SET plat_nomor_kendaraan='$plat_nomor_kendaraan', jenis_kendaraan='$jenis_kendaraan', nama_kendaraan='$nama_kendaraan', kapasitas='$kapasitas', tujuan='$tujuan'
            WHERE plat_nomor_kendaraan='$plat_nomor_kendaraan_lama'";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil diperbaharui";
    }else{
        $pesan_gagal = "Data gagal diperbaharui";
    }
}else if(mysqli_escape_string($conn, trim($_POST['hapus']))=='1'){
    // hapus data
    $sql = "DELETE FROM kendaraan
            WHERE plat_nomor_kendaraan='$plat_nomor_kendaraan'";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil dihapus";
    }else{
        $pesan_gagal = "Data gagal dihapus";
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
