<?php
include ('DBconnection.php');
// halaman untuk input data baru
if(isset($_POST['add_merchandise'])){

    $j_barang = $_POST['j_barang'];
    $nama = $_POST['nama'];
    $s_barang = $_POST['s_barang'];
    $h_barang = $_POST['h_barang'];
    $satuan = $_POST['satuan'];

    if($j_barang == "" || empty($j_barang)){
        header('location:index.php?message=Tolong masukkan jenis barang');
    }

    else {

        $query = "INSERT INTO barang(jenis, nama, status, harga, idsatuan) VALUES
        ('$j_barang', '$nama', '$s_barang', '$h_barang', '$satuan')";

        $result = mysqli_query($dbconn, $query);

        if(!$result){
            die("query gagal". mysqli_error());
        }else{
            header('location:index.php?insert_msg=Data telah berhasil masuk');
        }
    }
}

?>
