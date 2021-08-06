<?php
if (isset($_GET['id'])) {

    include_once "database/database.php";
    $database = new Database();
    $db = $database->getConnection();

    if (isset($_POST['btnSimpan'])) {

        $updateSql = "UPDATE jenisbarang SET namajenisbarang = ? WHERE id = ?";
        $stmt = $db->prepare($updateSql);
        $stmt->bindParam(1, $_POST['namajenisbarang']);
        $stmt->bindParam(2, $_POST['id']);
        if ($stmt->execute()) {
            $_SESSION['hasil_update'] = true;
        } else {
            $_SESSION['hasil_update'] = false;
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=jenisbarangread'>";
    }

    $id = $_GET['id'];
    $findSql = "SELECT * FROM jenisbarang WHERE id = ?";
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
                        <h1>Jenis Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                            <li class="breadcrumb-item"><a href="?page=jenisbarangread">Jenis Barang</a></li>
                            <li class="breadcrumb-item active">Ubah Data</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ubah Jenis Barang</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="namajenisbarang">Nama Jenis Barang</label>
                            <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                            <input type="text" class="form-control" name="namajenisbarang" value="<?php echo $row['namajenisbarang'] ?>">
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