<?php
//halaman untuk menghapus data
include ('DBconnection.php'); ?>

<?php

    if(isset($_GET['id'])){
        $id = $_GET['id'];


    $query = "delete from `barang` where `idbarang` = '$id'";

    $result = mysqli_query($dbconn, $query);

    if(!$result){
        die("Query gagal". mysqli_error());
    }else {
        header('location:index.php?delete_msg=Data telah dihapus.');
    }
    }
?>
