<?php
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
