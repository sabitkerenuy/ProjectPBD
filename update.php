<?php include ('DBconnection.php'); ?>
<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 id="main_title"> Toko Merchandise </h1>
    <div class="container">
    </div>

    <?php
    // Ganti 'idbarang' menjadi 'id' sesuai parameter di URL
    if(isset($_GET['id'])){
        $idbarang =$_GET['id'];

        $query = "SELECT * FROM `barang` where `idbarang` = '$idbarang'";
        $result = mysqli_query($dbconn,$query);

        if(!$result){
            die("query failed". mysqli_error($dbconn));
        }else{
            $row = mysqli_fetch_assoc($result);
        }
    }
    ?>

    <?php
        if(isset($_POST['update_merchandise'])){

            if(isset($_GET['id_new'])){
                $idnew =$_GET['id_new'];
            }

            $j_barang =$_POST['j_barang'];
            $nama =$_POST['nama'];
            $s_barang =$_POST['s_barang'];
            $h_barang =$_POST['h_barang'];
            $satuan =$_POST['satuan'];

            $query = "update `barang` set `jenis` = '$j_barang', `nama` = '$nama',
            `status` = '$s_barang', `harga` = '$h_barang', `idsatuan` = '$satuan' where `idbarang` = '$idnew' ";

            // FIX 2: Eksekusi query update-nya di sini
            $result_update = mysqli_query($dbconn,$query);

            if(!$result_update){
                die("query gagal".mysqli_error($dbconn));
            }else{
                header('location:index.php?update_msg=Data berhasil terupdate.');
            }
        }
    ?>

    <form action="update.php?id_new=<?php echo $idbarang; ?>" method="post">
    <div class="modal-body">
          <div class="form-group">
              <label for="j_barang">Jenis Barang</label>
              <input type="text" name="j_barang" class="form-control" value="<?php echo $row['jenis'] ?>">
          </div>
          <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" name="nama" class="form-control" value="<?php echo $row['nama'] ?>">
          </div>
          <div class="form-group">
              <label for="s_barang">Status Barang</label>
              <input type="text" name="s_barang" class="form-control" value="<?php echo $row['status'] ?>">
          </div>
          <div class="form-group">
              <label for="h_barang">Harga Barang</label>
              <input type="text" name="h_barang" class="form-control" value="<?php echo $row['harga'] ?>">
          </div>
          <div class="form-group">
              <label for="satuan">idsatuan</label>
              <input type="text" name="satuan" class="form-control" value="<?php echo $row['idsatuan'] ?>">
          </div>
    </div>
    <!-- FIX 3: Tambah tanda > di akhir tag input -->
    <input type="submit" class="btn btn-primary" name="update_merchandise" value="UPDATE">
    </form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
