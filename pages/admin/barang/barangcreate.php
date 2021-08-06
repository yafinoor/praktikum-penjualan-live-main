<?php
if (isset($_POST['btnSimpan'])) {
    include_once "database/database.php";
    $database = new Database();
    $db = $database->getConnection();

    $insertSql = "INSERT INTO barang (idjenisbarang,namabarang,harga) VALUES (?,?,?)";
    $stmt = $db->prepare($insertSql);
    $stmt->bindParam(1, $_POST['idjenisbarang']);
    $stmt->bindParam(2, $_POST['namabarang']);
    $stmt->bindParam(3, $_POST['harga']);
    if ($stmt->execute()) {
        $_SESSION['hasil_create'] = true;
    } else {
        $_SESSION['hasil_create'] = false;
    }
    echo "<meta http-equiv='refresh' content='0;url=?page=barangread'>";
}
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
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Barang</h3>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="namajenisbarang">Jenis Barang</label>
                    <select class="form-control" name="idjenisbarang">
                        <?php
                        include_once "database/database.php";
                        $database = new Database();
                        $db = $database->getConnection();

                        $selectSQL = "SELECT * FROM jenisbarang";
                        $stmt = $db->prepare($selectSQL);
                        $stmt->execute();

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"".$row["id"]."\">" . $row["namajenisbarang"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="namajenisbarang">Nama Barang</label>
                    <input type="text" class="form-control" name="namabarang">
                </div>
                <div class="form-group">
                    <label for="namajenisbarang">Harga Barang</label>
                    <input type="number" class="form-control" name="harga">
                </div>
                <a href="?page=jenisbarangread" class="btn btn-danger btn-sm float-right"><i class="fa fa-times"></i> Batal</a>
                <button type="submit" name="btnSimpan" class="btn btn-success btn-sm float-right"><i class="fa fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</section>

<?php include_once "components/scripts.php" ?>