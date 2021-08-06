<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case '':
            if (file_exists('pages/home.php')) {
                include 'pages/home.php';
            } else {
                include "pages/404.php";
            }
            break;
        case 'home':
            if (file_exists('pages/home.php')) {
                include 'pages/home.php';
            } else {
                include "pages/404.php";
            }
            break;
        case 'tes':
            if (file_exists('pages/tes.php')) {
                include 'pages/tes.php';
            } else {
                include "pages/404.php";
            }
            break;
        case 'jenisbarangread':
            if (file_exists('pages/admin/jenisbarang/jenisbarangread.php')) {
                include 'pages/admin/jenisbarang/jenisbarangread.php';
            } else {
                include "pages/404.php";
            }
            break;
        case 'jenisbarangcreate':
            if (file_exists('pages/admin/jenisbarang/jenisbarangcreate.php')) {
                include 'pages/admin/jenisbarang/jenisbarangcreate.php';
            } else {
                include "pages/404.php";
            }
            break;
        case 'jenisbarangupdate':
            if (file_exists('pages/admin/jenisbarang/jenisbarangupdate.php')) {
                include 'pages/admin/jenisbarang/jenisbarangupdate.php';
            } else {
                include "pages/404.php";
            }
            break;
        case 'jenisbarangdelete':
            if (file_exists('pages/admin/jenisbarang/jenisbarangdelete.php')) {
                include 'pages/admin/jenisbarang/jenisbarangdelete.php';
            } else {
                include "pages/404.php";
            }
            break;

        case 'barangread':
            if (file_exists('pages/admin/barang/barangread.php')) {
                include 'pages/admin/barang/barangread.php';
            } else {
                include "pages/404.php";
            }
            break;

        case 'barangcreate':
            if (file_exists('pages/admin/barang/barangcreate.php')) {
                include 'pages/admin/barang/barangcreate.php';
            } else {
                include "pages/404.php";
            }
            break;
        case 'barangupdate':
            if (file_exists('pages/admin/barang/barangupdate.php')) {
                include 'pages/admin/barang/barangupdate.php';
            } else {
                include "pages/404.php";
            }
            break;
        case 'barangdelete':
            if (file_exists('pages/admin/barang/barangdelete.php')) {
                include 'pages/admin/barang/barangdelete.php';
            } else {
                include "pages/404.php";
            }
            break;

            case 'penggunaread':
            if (file_exists('pages/admin/pengguna/penggunaread.php')) {
                include 'pages/admin/pengguna/penggunaread.php';
            } else {
                include "pages/404.php";
            }
            break;

        case 'penggunacreate':
            if (file_exists('pages/admin/pengguna/penggunacreate.php')) {
                include 'pages/admin/pengguna/penggunacreate.php';
            } else {
                include "pages/404.php";
            }
            break;
        case 'penggunaupdate':
            if (file_exists('pages/admin/pengguna/penggunaupdate.php')) {
                include 'pages/admin/pengguna/penggunaupdate.php';
            } else {
                include "pages/404.php";
            }
            break;
        case 'penggunadelete':
            if (file_exists('pages/admin/pengguna/penggunadelete.php')) {
                include 'pages/admin/pengguna/penggunadelete.php';
            } else {
                include "pages/404.php";
            }
            break;
        case 'keranjangbelanja':
          if (file_exists('pages/kasir/keranjangbelanja/keranjangbelanja.php')) {
              include 'pages/kasir/keranjangbelanja/keranjangbelanja.php';
          } else {
              include "pages/404.php";
          }
          break;
        default:
            include "pages/404.php";
            break;
    }
} else {
    include "pages/home.php";
}
