<?php
if (isset($_GET['id'])) {

    include_once "database/database.php";
    $database = new Database();
    $db = $database->getConnection();

    if (isset($_POST['btnSimpan'])) {

        $updateSql = "UPDATE barang SET namabarang = ?, harga=?, idjenisbarang=? WHERE id = ?";
        $stmt = $db->prepare($updateSql);
        $stmt->bindParam(1, $_POST['namabarang']);
        $stmt->bindParam(2, $_POST['harga']);
        $stmt->bindParam(3, $_POST['idjenisbarang']);
        $stmt->bindParam(4, $_POST['id']);
        if ($stmt->execute()) {
            $_SESSION['hasil_update'] = true;
        } else {
            $_SESSION['hasil_update'] = false;
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=barangread'>";
    }

    $id = $_GET['id'];
    $findSql = "SELECT * FROM barang WHERE id = ?";
    $stmt = $db->prepare($findSql);
    $stmt->bindParam(1, $_GET['id']);
    $stmt->execute();
    $row = $stmt->fetch();
    if (isset($row['id'])) {
?>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                            <li class="breadcrumb-item"><a href="?page=barangread">Barang</a></li>
                            <li class="breadcrumb-item active">Ubah Data</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ubah Barang</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="namajenisbarang">Nama Jenis Barang</label>
                            <select class="form-control" name="idjenisbarang">
                                <?php
                                include_once "database/database.php";
                                $database = new Database();
                                $db = $database->getConnection();

                                $selectSQL = "SELECT * FROM jenisbarang";
                                $stmt = $db->prepare($selectSQL);
                                $stmt->execute();

                                while ($rowSelect = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $selected = "";
                                    if($row["idjenisbarang"] == $rowSelect["id"]){
                                        $selected = " selected";
                                    }
                                    echo "<option value=\"" . $rowSelect["id"] . "\"  $selected>" . $rowSelect["namajenisbarang"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="namajenisbarang">Nama Barang</label>
                            <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                            <input type="text" class="form-control" name="namabarang" value="<?php echo $row['namabarang'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="namajenisbarang">Harga</label>
                            <input type="number" class="form-control" name="harga" value="<?php echo $row['harga'] ?>">
                        </div>
                        <a href="?page=jenisbarangread" class="btn btn-danger btn-sm float-right"><i class="fa fa-times"></i> Batal</a>
                        <button type="submit" name="btnSimpan" class="btn btn-success btn-sm float-right"><i class="fa fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
    <?php
    } else {
        $_SESSION['hasil_update'] = false;
        echo "<meta http-equiv='refresh' content='0;url=?page=jenisbarangread'>";
    }
} else {
    $_SESSION['hasil_update'] = false;
    echo "<meta http-equiv='refresh' content='0;url=?page=jenisbarangread'>";
}
    ?>

    <?php include_once "components/scripts.php" ?>