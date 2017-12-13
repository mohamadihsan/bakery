<?php
// route untuk manage user pegawai
session_start();
$session_id_pelanggan = isset($_SESSION['id_pelanggan']) ? $_SESSION['id_pelanggan'] : '';
$menu       = isset($_GET['menu']) ? $_GET['menu']: '';
$sub        = isset($_GET['sub']) ? $_GET['sub']: '';
$base_url   = 'http://127.0.0.1/bakery/';
$url_api    = 'http://127.0.0.1/bakery/action/';

if ($session_id_pelanggan!='') {

    // load _header
    include_once '_header.php';

    // load content
    switch ($menu) {

        case 'faktur':
            include_once 'users/pelanggan/faktur.php';
        break;

        case 'keranjang':
            include_once 'users/pelanggan/keranjang.php';
        break;

        case 'konfirmasi':
            include_once 'users/pelanggan/konfirmasi_pembayaran.php';
            break;

        case 'profil':
            include_once 'users/general-pages/profil.php';
            break;

        default:
            include_once 'users/pelanggan/pemesanan_produk.php';
            break;
    }

    // load footer
    include_once '_footer.php';

}else{

    // load content
    switch ($menu) {
        case 'login':
            include_once 'users/general-pages/login.php';
            break;

        default:
            // load _header
            include_once '_header.php';
            // load content
            include_once 'users/pelanggan/pemesanan_produk.php';
            // load footer
            include_once '_footer.php';
            break;
    }

}



?>
