<?php
include "read-cart.php";
include "add-cart.php";
include "delete-cart.php";
include "save-cart.php";
include "display-pinjam.php";

//$fitur = $_GET['fitur'];
$fitur = isset($_GET['fitur']) ? $_GET['fitur'] : 'read';
switch ($fitur) {
    case 'add':
        $idbuku = $_GET['idbuku'];
        $judul = $_GET['judul'];
        add($idbuku,$judul);
        header('location:pinjam.php?fitur=read');
        break;
    case 'delete':
        $idbuku = $_GET['idbuku'];
        delete($idbuku);
        header('location:pinjam.php?fitur=read');
        break;
    case 'save':
        save();
        header('location:pinjam.php?fitur=display');
        break;
    case 'display':
        displayPinjam();
        break;
    case 'read':
    default:
        read();
        break;
}

?>