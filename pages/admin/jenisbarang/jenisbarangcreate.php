<?php
if (isset($_POST['btnSimpan'])) {
    include_once "database/database.php";
    $database = new Database();
    $db = $database->getConnection();

    $insertSql = "INSERT INTO jenisbarang (namajenisbarang) VALUES (?)";
    $stmt = $db->prepare($insertSql);
    $stmt->bindParam(1, $_POST['namajenisbarang']);
    if ($stmt->execute()) {
        $_SESSION['hasil_create'] = true;
    } else {
        $_SESSION['hasil_create'] = false;
    }
    echo "<meta http-equiv='refresh' content='0;url=?page=jenisbarangread'>";
}
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
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Jenis Barang</h3>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="namajenisbarang">Nama Jenis Barang</label>
                    <input type="text" class="form-control" name="namajenisbarang">
                </div>
                <a href="?page=jenisbarangread" class="btn btn-danger btn-sm float-right"><i class="fa fa-times"></i> Batal</a>
                <button type="submit" name="btnSimpan" class="btn btn-success btn-sm float-right"><i class="fa fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</section>

<?php include_once "components/scripts.php" ?>