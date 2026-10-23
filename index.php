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
        <div class="box1">
        <h2>ALL MERCHANDISES</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD MERCHANDISE</button>
        </div>
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jenis Barang</th>
                    <th>Nama</th>
                    <th>Status Barang</th>
                    <th>Harga Barang</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $query = "SELECT * FROM `barang`";

                $result = mysqli_query($dbconn, $query);

                if(!$result){
                    die("query failed". mysqli_error());
                }else{

                    while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td><?php echo $row['idbarang'] ?></td>
                            <td><?php echo $row['jenis'] ?></td>
                            <td><?php echo $row['nama'] ?></td>
                            <td><?php echo $row['status'] ?></td>
                            <td><?php echo $row['harga'] ?></td>
                            <td><a href="update.php?id=<?php echo $row['idbarang'] ?>" class="btn btn-success">Update</a></td>
                            <td><a href="delete.php?id=<?php echo $row['idbarang'] ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                        <?php
                    }
                }

                ?>
            </tbody>
        </table>
        <?php

            if(isset($_GET['message'])){
                echo "<h6>".$_GET['message']."</h6>";
            }

        ?>

        <?php

            if(isset($_GET['insert_msg'])){
                echo "<h7>".$_GET['insert_msg']."</h7>";
            }

        ?>

        <?php

            if(isset($_GET['update_msg'])){
                echo "<h7>".$_GET['update_msg']."</h7>";
            }

        ?>

        <?php

            if(isset($_GET['delete_msg'])){
                echo "<h7>".$_GET['delete_msg']."</h7>";
            }

        ?>

    </div>

    <form action="create.php" method="post">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Merchandise</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                <div class="form-group">
                    <label for="j_barang">Jenis Barang</label>
                    <input type="text" name="j_barang" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control">
                </div>
                <div class="form-group">
                    <label for="s_barang">Status Barang</label>
                    <input type="text" name="s_barang" class="form-control">
                </div>
                <div class="form-group">
                    <label for="h_barang">Harga Barang</label>
                    <input type="text" name="h_barang" class="form-control">
                </div>
                <div class="form-group">
                    <label for="satuan">idsatuan</label>
                    <input type="text" name="satuan" class="form-control">
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" name="add_merchandise" value="ADD"
          </div>
        </div>
      </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
