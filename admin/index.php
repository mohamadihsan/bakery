<?php
// route untuk manage user pegawai

session_start();

$jabatan = strtolower(isset($_SESSION['jabatan']) ? $_SESSION['jabatan'] : '');
//$jabatan 	= 'pemilik';
$menu 		= isset($_GET['menu']) ? $_GET['menu']: '';
$sub 		= isset($_GET['sub']) ? $_GET['sub']: '';
$base_url 	= 'http://127.0.0.1/bakery/';
$url_api 	= 'http://127.0.0.1/bakery/action/';

if ($jabatan!='') {
	// load _header
	include_once '../users/_header.php';
}

switch ($jabatan) {

	case 'kepala produksi':
			include_once '../users/kepala-produksi/_sidebar.php';
			// load content
			switch ($menu) {
				case 'bahan-baku':
					include_once '../users/kepala-produksi/bahan_baku.php';
					break;

				case 'detail_komposisi':
					include_once '../users/kepala-produksi/detail_komposisi.php';
					break;

				case 'produk':
					include_once '../users/kepala-produksi/produk.php';
					break;

				case 'komposisi':
					include_once '../users/kepala-produksi/komposisi.php';
					break;

				case 'peramalan':
					include_once '../users/kepala-produksi/peramalan.php';
					break;

				case 'profil':
					include_once '../users/general-pages/profil.php';
					break;

				default:
					include_once '../users/kepala-produksi/beranda.php';
					break;
			}
		break;

	case 'kepala gudang dan pengadaan':
			include_once '../users/kepala-gudang-dan-pengadaan/_sidebar.php';
			// load content
			switch ($menu) {
				case 'barang-masuk':
					include_once '../users/kepala-gudang-dan-pengadaan/barang_masuk.php';
					break;

					case 'barang-keluar':
						include_once '../users/kepala-gudang-dan-pengadaan/barang_keluar.php';
						break;

				case 'bahan-baku':
					include_once '../users/kepala-gudang-dan-pengadaan/bahan_baku.php';
					break;

				case 'produk':
					include_once '../users/kepala-gudang-dan-pengadaan/produk.php';
					break;

				case 'supplier':
					include_once '../users/kepala-gudang-dan-pengadaan/supplier.php';
					break;

				case 'peramalan':
					include_once '../users/kepala-gudang-dan-pengadaan/peramalan.php';
					break;

				case 'pemesanan':
					include_once '../users/kepala-gudang-dan-pengadaan/pemesanan_bahan_baku.php';
					break;

				case 'laporan':
					include_once '../users/kepala-gudang-dan-pengadaan/laporan.php';
					break;

				case 'profil':
					include_once '../users/general-pages/profil.php';
					break;

				default:
					include_once '../users/kepala-gudang-dan-pengadaan/beranda.php';
					break;
			}
		break;

	case 'staff gudang':
			include_once '../users/staff-gudang/_sidebar.php';
			// load content
			switch ($menu) {
				case 'bahan-baku':
					include_once '../users/staff-gudang/bahan_baku.php';
					break;

				case 'produk':
					include_once '../users/staff-gudang/produk.php';
					break;

				case 'barang-masuk':
					include_once '../users/staff-gudang/barang_masuk.php';
					break;

				case 'barang-keluar':
					include_once '../users/staff-gudang/barang_keluar.php';
					break;

				case 'profil':
					include_once '../users/general-pages/profil.php';
					break;

				default:
					include_once '../users/staff-gudang/beranda.php';
					break;
			}
		break;

	case 'kepala pemasaran':
			include_once '../users/kepala-pemasaran/_sidebar.php';
			// load content
			switch ($menu) {
				case 'produk':
					include_once '../users/kepala-pemasaran/produk.php';
					break;

				case 'distribusi':
					include_once '../users/kepala-pemasaran/distribusi.php';
					break;

				case 'kendaraan':
					include_once '../users/kepala-gudang-dan-pengadaan/kendaraan.php';
					break;

				case 'pemesanan':
					include_once '../users/kepala-pemasaran/pemesanan_produk.php';
					break;

				case 'profil':
					include_once '../users/general-pages/profil.php';
					break;

				default:
					include_once '../users/kepala-pemasaran/beranda.php';
					break;
			}
		break;

	default:
			include_once '../users/general-pages/login_pegawai.php';
		break;
}

if ($jabatan!='') {
	// load footer
	include_once '../users/_footer.php';
}

?>
